<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnimalDeatil\CreateAnimalDetailRequest;
use App\Http\Requests\AnimalDeatil\UpdateAnimalDetailRequest;
use App\Models\Animal;
use App\Models\AnimalDetail;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AnimalDetailController extends Controller
{
    public int $itemPerPage = 10;

    public function index(): View
    {
        $animal_details = AnimalDetail::query()->orderByDesc('created_at')->paginate($this->itemPerPage);

        return view('admin.animalDetails.index',compact('animal_details'));
    }

    public function create(): View
    {
        $animals = Animal::all();

        return view('admin.animalDetails.create',compact('animals'));
    }

    public function store(CreateAnimalDetailRequest $request): RedirectResponse
    {
        $data = $request->validated();

        AnimalDetail::create([
            'weight' => $data['weight'],
            'animal_id' => $data['animal_id'],
        ]);

        toast('Thêm thành công' ,'success');

        return  redirect('animal-details');
    }

    public function edit(string $id): View
    {
        $animalDetails = AnimalDetail::getAnimalDetailById($id);

        $animals = Animal::all();

        return view('admin.animalDetails.edit',compact('animalDetails','animals'));

    }

    public function update(UpdateAnimalDetailRequest $request, string $id): RedirectResponse
    {
        $data = $request->validated();

        $animalDetail = AnimalDetail::getAnimalDetailById($id);

        $animalDetail->update([
            'weight' => $data['weight'],
            'animal_id' => $data['animal_id'],
        ]);
        toast('Cập nhật thành công' ,'success');

        return  redirect('animal-details');
    }

    public function destroy(string $id): RedirectResponse
    {
        $animalDetail = AnimalDetail::getAnimalDetailById($id);

        $animalDetail->delete();

        toast('Xóa thành công' ,'success');

        return  redirect('animal-details');
    }
}
