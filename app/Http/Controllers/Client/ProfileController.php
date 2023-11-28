<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Models\User;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProfileController extends Controller
{
    use ImageTrait;

    public function edit(string $id): View
    {
        $user = User::getUserById($id);

        return view('client.profile.edit', compact('user'));
    }

    public function update(UpdateProfileRequest $request, string $id): RedirectResponse
    {

        $data = $request->validated();

        $user = User::getUserById($id);

        if (! $request->hasFile('image')) {
            $data['image'] = $user->image;
        }

        if ($request->hasFile('image')) {
            $oldImage = 'storage/' . $user->image;

            $this->deleteImage($oldImage);

            $data['image'] = $this->uploadImage($request, 'image', 'images');
        }

        $user->update([
            'name' => $data['name'] ,
            'phone' => $data['phone'] ,
            'image' => $data['image'],
            'gender' => $data['gender'],
        ]);

        toast('Cập nhật hồ sơ người dùng thành công', 'success');

        return redirect('location');
    }

    public function updatePassword(Request $request, string $id): RedirectResponse
    {

        $user = User::getUserById($id);

        $data = $request->validate([
            'password_old' => 'required',
            'password' => ['required', 'string', 'min:8', 'max:32'],
            'new_password_confirmation' => ['required','same:password'],
        ]);

        if(!Hash::check($request->password_old, $user->password)) {
            toast('Mật khẩu cũ không chính xác', 'warning');
            return redirect()->back();
        }

        $user->update([
            'password' => Hash::make($data['password']),
        ]);

        toast('Cập nhật mật khẩu người dùng ' . $user->name  . ' thành công', 'success');

        return redirect()->back();

    }

}
