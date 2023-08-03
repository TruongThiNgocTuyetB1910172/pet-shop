<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Service\CreateServiceRequest;
use App\Http\Requests\Service\UpdateServiceRequest;
use App\Models\Service;
use App\Traits\ImageTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServiceController extends Controller
{
    use ImageTrait;
    public int $itemPerPage = 10;

    public function index(): View
    {
        $services = Service::query()
            ->orderByDesc('created_at')
            ->paginate($this->itemPerPage);
        return view('admin.services.index', compact('services'));
    }

    public function create(): View
    {
        return view('admin.services.create');
    }

    public function store(CreateServiceRequest $request): RedirectResponse
    {

        $data = $request->validated();

        $data['image'] = $this->uploadImage($request, 'image', 'images');

        $services = Service::query()->create([
            'name' => $data['name'],
            'description' => $data['description'],
            'original_price' => $data['original_price'],
            'selling_price' => $data['selling_price'],
            'image' => $data['image'],
        ]);

        toast('Thêm mới dịch vụ ' . $services->name .' thành công','success');

        return redirect('services');
    }

    public function edit(string $id): View
    {
        $service = Service::getServiceById($id);

        return view('admin.services.edit',compact('service'));
    }

    public function update(UpdateServiceRequest $request,string $id): RedirectResponse
    {
        $data = $request->validated();

        $service = Service::getServiceById($id);

        if (! $request->hasFile('image')) {
            $data['image'] = $service->image;
        }

        if ($request->hasFile('image')) {
            $oldImage = 'storage/' . $service->image;

            $this->deleteImage($oldImage);

            $data['image'] = $this->uploadImage($request, 'image', 'images');
        }

        $service->update([
            'name' => $data['name'],
            'description' => $data['description'],
            'image' => $data['image'],
            'original_price' => $data['original_price'],
            'selling_price' => $data['selling_price'],
        ]);

        toast('Cập nhật dịch vụ' . $service->name . ' thành công','success');

        return redirect('services');
    }

    public function destroy(string $id): RedirectResponse
    {
        $service = Service::getServiceById($id);

        $image = 'storage/' . $service->image;

        $this->deleteImage($image);

        $service->delete();

        toast('Xóa dịch vụ ' . $service->name . ' thành công','success');

        return redirect('services');
    }
}
