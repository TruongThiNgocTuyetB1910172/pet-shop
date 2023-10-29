<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\CreateAccountRequest;
use App\Http\Requests\Account\UpdateAccountRequest;
use App\Models\Admin;
use App\Traits\ImageTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AccountController extends Controller
{
    use ImageTrait;

    public int $itemPerPage = 10;

    public function index(): View
    {
        $searchTerm = request()->query('searchTerm') ?? '';

        if (is_array($searchTerm)) {
            $searchTerm = '';
        }
        $search = '%' . $searchTerm . '%';

        $accounts = Admin::where(function ($query) use ($search) {
            $query->where('name', 'like', $search)
            ->orwhere('email', 'like', $search);
        })->orderByDesc('created_at')
            ->paginate($this->itemPerPage);

        return view('admin.account.index', compact('accounts'));
    }

    public function create(): View
    {
        return view('admin.account.create');
    }

    public function store(CreateAccountRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['image'] = $this->uploadImage($request, 'image', 'images');

        Admin::query()->create([
            'name' => $data['name'] ,
            'email' => $data['email'] ,
            'gender' => $data['gender'],
            'phone' => $data['phone'] ,
            'password' => Hash::make($data['password']),
            'status' => $data['status'],
            'image' => $data['image'],
            'role' => $data['role'],
        ]);

        toast('Tạo mới tài khoản thành công', 'success');

        return redirect('account');
    }

    public function edit(string $id): View
    {
        $account = Admin::getAccountById($id);

        return view('admin.account.edit', compact('account'));
    }

    public function update(UpdateAccountRequest $request, string $id): RedirectResponse
    {
        $account = Admin::getAccountById($id);

        $data = $request->validated();

        if (! $request->hasFile('image')) {
            $data['image'] = $account->image;
        }

        if ($request->hasFile('image')) {
            $oldImage = 'storage/' . $account->image;

            $this->deleteImage($oldImage);

            $data['image'] = $this->uploadImage($request, 'image', 'images');
        }

        $account->update([
            'name' => $data['name'] ,
            'phone' => $data['phone'] ,
            'status' => $data['status'],
            'image' => $data['image'],
            'gender' => $data['gender'],
            'role' => $data['role'],
        ]);

        toast('Cập nhật ' .$account->name. ' thành công', 'success');

        return redirect('account');
    }
}
