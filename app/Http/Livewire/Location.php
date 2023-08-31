<?php

namespace App\Http\Livewire;

use App\Models\Address;
use App\Models\District;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;


class Location extends Component
{
    public string $provinceId = '';
    public string $districtId = '';
    public string $wardId = '';
    public $districts = [];
    public $wards = [];
    public $email;
    public $userName;
    public $phoneNumber;
    public $houseNumber;


    protected $rules = [
        'userName' => 'required|min:6',
        'email' => 'required|email',
        'phoneNumber' => 'required',
        'houseNumber' => 'required',
        'provinceId' => 'required',
        'districtId' => 'required',
        'wardId' => 'required',
    ];

    protected $messages = [
        'userName.required' => 'Vui lòng nhập họ tên.',
        'userName.max:36' => 'Họ tên không vượt quá 36 kí tự',
        'houseNumber.required' => 'Vui lòng nhập địa chỉ cụ thể.',
        'houseNumber.max:255' => 'Địa chỉ cụ thể không vượt quá 255 kí tự',
        'provinceId.required' => 'Vui lòng chọn tỉnh thành phố.',
        'districtId.required' => 'Vui lòng nhập huyện.',
        'wardId.required' => 'Vui lòng chọn xã phường.',
        'email.required' => 'Vui lòng nhập email',
        'phoneNumber' => 'Vui lòng nhập số điện thoại',
    ];
    public function addNew(): void
    {

        $validatedData = $this->validate();

        if (Auth::user()->addresses()->count() < 3){
            Address::create([
                'user_id' => Auth::user()->id,
                'user_name' => $validatedData['userName'],
                'house_number' => $validatedData['houseNumber'],
                'email' => $validatedData['email'],
                'phone_number' => $validatedData['phoneNumber'],
                'province_id' => $validatedData['provinceId'],
                'district_id' => $validatedData['districtId'],
                'ward_id' => $validatedData['wardId'],
            ]);

            toast('thêm địa chỉ thành công','success');
            redirect('checkout');
        }
        else
        {
           toast('Mỗi người không được quá 3 địa chỉ', 'warning');
           redirect('checkout');
        }

    }

    public function render()
    {
        $provinces = Province::all();

        if (! empty($this->provinceId)) {
            $this->districts = District::where('province_id', $this->provinceId)->get();
        }
        if (! empty($this->districtId)) {
            $this->wards = Ward::where('district_id', $this->districtId)->get();
        }

        return view('livewire.location', [
            'provinces' => $provinces,
        ]);
    }
}
