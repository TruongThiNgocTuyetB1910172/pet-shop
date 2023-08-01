<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class UserController extends Controller
{
    public int $itemPerPage = 10;

    public function index(): View
    {
        $users= User::query()->orderByDesc('created_at')->paginate($this->itemPerPage);

        return view('admin.users.index',compact('users'));
    }

    public function create(): View
    {
        return view('admin.users.create');
    }

    public function store(CreateUserRequest $request): RedirectResponse
    {
        $data = $request->validated();

        User::query()->create([
            'name'=> $data['name'] ,
            'email'=> $data['email'] ,
            'phone'=> $data['phone'] ,
            'password'=> Hash::make($data['password']),
            'is_admin'=> $data['is_admin'],
            'status' => $data['status'],
        ]);

        toast('Create new user profile success','success');

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

        if ($user->is_root == 1) {
            toast('This is a root account you can not updated!','warning');

            return redirect('users');
        }

        $data = $request->validated();

        $user->update([
            'name' => $data['name'] ,
            'phone' => $data['phone'] ,
            'is_admin' => $data['is_admin'],
            'status' => $data['status'],
        ]);

        toast('Update user profile success','success');

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

        toast('Update user password success','success');

        return redirect('users');
    }
}
