<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\CreateUserRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
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
            'is_admin'=> $data['is_admin']
        ]);
        return redirect('users')->with('status','User added Successfully');
    }

    public function edit(string $id): View
    {
        $user = User::getUserById($id);
        return view('admin.users.edit',compact('user'));
    }

    public function destroy(string $id): RedirectResponse
    {
        $user = User::getUserById($id);

        $user->delete();

        return redirect('users')->with('status','User delete Successfully');
    }

}
