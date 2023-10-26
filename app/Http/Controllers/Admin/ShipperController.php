<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\UpdateAccountRequest;
use App\Http\Requests\Shipper\CreateShipperRequest;
use App\Http\Requests\Shipper\UpdateShipperRequest;
use App\Models\Admin;
use App\Models\Shipper;
use App\Models\User;
use App\Traits\ImageTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class ShipperController extends Controller
{
    use ImageTrait;

    public int $itemPerPage = 10;

    public function index(): View
    {
        $shippers = Shipper::query()->orderByDesc('created_at')->paginate($this->itemPerPage);
        return view('admin.shippers.index',compact('shippers'));
    }

    public function create(): View
    {
        return view('admin.shippers.create');
    }

    public function store(CreateShipperRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['image'] = $this->uploadImage($request, 'image', 'images');

        Shipper::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'status' => $data['status'],
            'gender' => $data['gender'],
            'image' => $data['image'],
            'password' => Hash::make($data['password']),
        ]);

        toast('Tạo mới tài khoản thành công', 'success');

        return redirect('shipper');
    }

    public function edit(string $id): View
    {
        $shipper = Shipper::getShipperById($id);

        return view('admin.shippers.edit', compact('shipper'));
    }

    public function update(UpdateShipperRequest $request, string $id): RedirectResponse
    {
        $shipper = Shipper::getShipperById($id);

        $data = $request->validated();

        if (! $request->hasFile('image')) {
            $data['image'] = $shipper->image;
        }

        if ($request->hasFile('image')) {
            $oldImage = 'storage/' . $shipper->image;

            $this->deleteImage($oldImage);

            $data['image'] = $this->uploadImage($request, 'image', 'images');
        }

        $shipper->update([
            'name' => $data['name'] ,
            'phone' => $data['phone'] ,
            'status' => $data['status'],
            'image' => $data['image'],
            'gender' => $data['gender'],
        ]);

        toast('Cập nhật ' .$shipper->name. ' thành công', 'success');

        return redirect('shipper');
    }

    public function updatePassword(Request $request, string $id): RedirectResponse
    {
        $data = $request->validate([
            'password' => ['required', 'string', 'min:8', 'max:32'],
        ]);

        $user = User::getUserById($id);

        $user->update([
            'password' => Hash::make($data['password']),
        ]);

        toast('Cập nhật mật khẩu mới thành công', 'success');

        return redirect('users');
    }
}
