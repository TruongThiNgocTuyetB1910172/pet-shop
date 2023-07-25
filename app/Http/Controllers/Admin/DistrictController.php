<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\District\CreateDistrictRequest;
use App\Models\District;
use App\Models\Province;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DistrictController extends Controller
{
    public int $itemPerPage = 10;

    public function index(): View
    {
        $districts = District::query()->orderByDesc('created_at')->paginate($this->itemPerPage);
        return view('admin.districts.index',compact('districts'));
    }

    public function create(): View
    {
     $provinces = Province::all();
     return view('admin.districts.create',compact('provinces'));
    }

    public function store(CreateDistrictRequest $request): RedirectResponse
    {
        $data = $request->validated();

        District::query()->create([
           'name' => $data['name'],
           'province_id' => $data['province_id']
        ]);
        return redirect('districts')->with('status','District Add Successfully ');
    }

    public function edit(string $id): View
    {
        $district = District::getDistrictById($id);
        $provinces = Province::all();
        return view('admin.districts.edit',compact('district','provinces'));
    }

    public function update(CreateDistrictRequest $request, string $id): RedirectResponse
    {
        $data = $request->validated();

        $district = District::getDistrictById($id);

        $district->update([
            'name' => $data['name'],
            'province_id' => $data['province_id']
        ]);
        return redirect('districts')->with('status','District update Successfully ');
    }

    public function destroy(string $id): RedirectResponse
    {
        $district = District::getDistrictById($id);

        $district->delete();

        return redirect('districts')->with('status','District delete Successfully ');
    }
}
