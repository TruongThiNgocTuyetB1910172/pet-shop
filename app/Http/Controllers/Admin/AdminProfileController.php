<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Traits\ImageTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AdminProfileController extends Controller
{
    use ImageTrait;

    public function index(string $id): View
    {

        $admin = Admin::getAccountById($id);

        return view('admin.admin-profile.index', compact('admin'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {

        $admin  = Admin::getAccountById($id);

        $data = $request->validate([
            'name' => 'nullable',
            'phone' => 'nullable',
            'gender' => 'nullable',
            'image' => 'nullable',
        ]);

        if (! $request->hasFile('image')) {
            $data['image'] = $admin->image;
        }

        if ($request->hasFile('image')) {
            $oldImage = 'storage/' . $admin->image;

            $this->deleteImage($oldImage);

            $data['image'] = $this->uploadImage($request, 'image', 'images');
        }

        $admin->update([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'image' => $data['image'],
        ]);

        toast('Cập nhật profile thành công', 'success');

        return redirect()->back();
    }

    public function updatePassword(Request $request, string $id): RedirectResponse
    {

        $admin = Admin::getAccountById($id);

        $data = $request->validate([
            'password_old' => 'required',
            'password' => ['required', 'string', 'min:8', 'max:32'],
            'new_password_confirmation' => ['required','same:password'],
        ]);

        if(!Hash::check($request->password_old, $admin->password)) {
            toast('Mật khẩu cũ không chính xác', 'warning');
            return redirect()->back();
        }

        $admin->update([
            'password' => Hash::make($data['password']),
        ]);

        toast('Cập nhật mật khẩu người dùng ' . $admin->name  . ' thành công', 'success');

        return redirect()->back();

    }
}
