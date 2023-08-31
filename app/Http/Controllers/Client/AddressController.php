<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Address\CreateAddressRequest;
use App\Http\Requests\Client\CreateClientRequest;
use App\Models\Address;
use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AddressController extends Controller
{
    public function index(): View
    {
        $provinces = Province::all();
        return view('client.address.index', compact('provinces'));
    }
    public function getDistrict(Request $request): JsonResponse
    {

        $province_id = $request->get('province_id');
        $districts= District::where('province_id',$province_id)->get();
        $html='<option value="">Chọn huyện</option>';
        foreach ($districts as $district){
            $html.='<option value="'.$district->id.'">'.$district->name.'</option>' ;
        }
        return response()->json($html);


    }
    public function getWard(Request $request): JsonResponse
    {

        $district_id = $request->get('district_id');
        $wards= Ward::where('district_id',$district_id)->get();
        $html='<option value="">Chọn xã</option>';
        foreach ($wards as $ward){
            $html.='<option value="'.$ward->id.'">'.$ward->name.'</option>' ;
        }
        return response()->json($html);
    }

    public function Store(CreateAddressRequest $request): RedirectResponse
    {
            $data = $request->validate();

             Address::create([
                 'user_id' =>Auth::user()->id,
                 'user_name' => $data['user_name'],
                 'house_number' => $data['house_number'],
                 'email' => $data['email'],
                 'ward_id' => $data['ward_id'],
                 'district_id' => $data['district_id'],
                 'province_id' => $data['province_id'],
                 'phone_number' => $data['phone_number'],
             ]);
            toast('tao moi dia chi thanh cong', 'success');

            return redirect()->back();

    }

}
