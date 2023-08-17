<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VariantService\CreateVariantServiceRequest;
use App\Models\AnimalDetail;
use App\Models\Service;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VariantServiceController extends Controller
{
    public function index(): View
    {
        $animalDetails = AnimalDetail::all();
        return view('admin.variantServices.index',compact('animalDetails'));

    }

    public function create(): View
    {
        $services = Service::all();

        $animalDetails = AnimalDetail::all();

        return view('admin.variantServices.create', compact('services','animalDetails' ));

    }

    public function store(CreateVariantServiceRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $service = Service::find($data['service_id']);

        $service->animalDetail()->attach(
            $data['animal_detail_id'],
            ['price' => $data['price'] ,

        ]);

        toast('Them thanh cong', 'success');

        return redirect()->back();

    }

    public function edit()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
