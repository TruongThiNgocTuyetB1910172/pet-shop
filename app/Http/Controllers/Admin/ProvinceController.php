<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Province\CreateProvinceRequest;
use App\Models\Province;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProvinceController extends Controller
{
    public int $itemPerPage = 10;

    public function index(): View
    {
        $provinces = Province::query()->orderByDesc('created_at')->paginate($this->itemPerPage);
        return view('admin.provinces.index',compact('provinces'));
    }

    public function create(): View
    {
        return view('admin.provinces.create');
    }

    public function store(CreateProvinceRequest $request): RedirectResponse
    {
        $data = $request->validated();

        Province::query()->create([
            'name' => $data['name'],
        ]);
        return redirect('provinces')->with('status', 'Province Added Successfully');

    }

    public function edit(string $id): View
    {
        $province = Province::getProvinceById($id);
        return view('admin.provinces.edit',compact('province'));
    }

    public function update(ProvinceRequest $request, string $id): RedirectResponse
    {
        $data = $request->validated();

        $province = Province::getProvinceById($id);

        $province->update([
            'name' => $data['name'],
        ]);

        return redirect('provinces')->with('status', 'Province updated successfully');
    }

    public function destroy(string $id): RedirectResponse
    {
        $province = Province::getProvinceById($id);

        $province->delete();

        return redirect('provinces')->with('status', 'Province deleted successfully');
    }
}
