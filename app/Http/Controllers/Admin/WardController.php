<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Ward\CreateWardRequest;
use App\Models\District;
use App\Models\Ward;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;


class WardController extends Controller
{
    public int $itemPerPage = 10;

    public function index(): View
    {
        $wards = Ward::query()->orderByDesc('created_at')->paginate($this->itemPerPage);
        return view('admin.wards.index',compact('wards'));
    }

    public function create(): View
    {
        $districts = District::all();
        return view('admin.wards.create',compact('districts'));
    }

    public function store(CreateWardRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Ward::query()->create([
           'name' => $data ['name'],
            'district_id' => $data ['district_id'],
        ]);
        return redirect('wards')->with('status','Ward Added Successfully');
    }

    public function edit(string $id): View
    {
        $ward = Ward::getWardById($id);
        $districts = District::all();
        return view('admin.wards.edit',compact('ward','districts'));
    }

    public function update(CreateWardRequest $request,string $id): RedirectResponse
    {
        $data = $request->validated();
        $ward = Ward::getWardById($id);
        $ward->update([
            'name' => $data ['name'],
            'district_id' => $data ['district_id'],
        ]);
        return redirect('wards')->with('status','Ward Update Successfully');
    }

    public function destroy($id): RedirectResponse
    {
        $ward = Ward::getWardById($id);

        $ward->delete();

        return redirect('wards')->with('status','Ward delete Successfully');
    }
}
