<?php

namespace App\Http\Controllers\Shipper;

use App\Http\Controllers\Controller;
use App\Models\Shipper;
use App\Traits\ImageTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ShipperProfileController extends Controller
{
    use ImageTrait;

    public function index(string $id): View
    {

        $shipper = Shipper::getShipperById($id);

        return view('shipper.shipper-profile.index', compact('shipper'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        $shipper = Shipper::getShipperById($id);


        $data = $request->validate([
            'name' => 'nullable',
            'phone' => 'nullable',
            'gender' => 'nullable',
            'image' => 'nullable',
        ]);

        if (! $request->hasFile('image')) {
            $data['image'] = $shipper->image;
        }

        if ($request->hasFile('image')) {
            $oldImage = 'storage/' . $shipper->image;

            $this->deleteImage($oldImage);

            $data['image'] = $this->uploadImage($request, 'image', 'images');
        }

        $shipper->update([
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

        $shipper = Shipper::getShipperById($id);

        $data = $request->validate([
            'password_old' => 'required',
            'password' => ['required', 'string', 'min:8', 'max:32'],
            'new_password_confirmation' => ['required','same:password'],
        ]);

        if(!Hash::check($request->password_old, $shipper->password)) {
            toast('Mật khẩu cũ không chính xác', 'warning');
            return redirect()->back();
        }

        $shipper->update([
            'password' => Hash::make($data['password']),
        ]);

        toast('Cập nhật mật khẩu người dùng ' . $shipper->name  . ' thành công', 'success');

        return redirect()->back();

    }
}
