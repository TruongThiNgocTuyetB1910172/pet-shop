<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use App\Traits\ImageTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    use ImageTrait;
    public int $itemPerPage = 10;

    public function index(): View
    {
        $users= User::query()->orderByDesc('created_at')->paginate($this->itemPerPage);

        return view('admin.users.index', compact('users'));
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(CreateUserRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['image'] = $this->uploadImage($request, 'image', 'images');

        User::query()->create([
            'name'=> $data['name'] ,
            'email'=> $data['email'] ,
            'gender' => $data['gender'],
            'phone'=> $data['phone'] ,
            'password'=> Hash::make($data['password']),
            'status' => $data['status'],
            'image' => $data['image'],
        ]);

        toast('Tạo mới người dùng thành công', 'success');

        return redirect('users');
    }

    public function edit(string $id): View
    {
        $user = User::getUserById($id);

        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, string $id): RedirectResponse
    {
        $user = User::getUserById($id);

        $data = $request->validated();
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
            'status' => $data['status'],
            'image' => $data['image'],
            'gender' => $data['gender'],
        ]);

        toast('Cập nhật hồ sơ người dùng thành công', 'success');

        return redirect('users');
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
