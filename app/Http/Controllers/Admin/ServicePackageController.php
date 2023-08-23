<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServicePackage\CreateServicePackage;
use App\Http\Requests\ServicePackage\UpdateServicePackage;
use App\Models\Service;
use App\Models\ServicePackage;
use App\Traits\ImageTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ServicePackageController extends Controller
{
    use ImageTrait;

    public int $itemPerPage = 10;

    public function index(): View
    {
        $servicePackages = ServicePackage::query()->orderByDesc('created_at')->paginate($this->itemPerPage);

        return view('admin.service-packages.index', compact('servicePackages'));
    }

    public function create(): View|RedirectResponse
    {
        $services = Service::all();

        if ($services->count() === 0) {
            toast('Vui lòng thêm dịch vụ trước khi thêm mới gói dịch vụ');

            return redirect()->route('service.create');
        }

        return view('admin.service-packages.create', compact('services'));
    }

    public function store(CreateServicePackage $request): RedirectResponse
    {
        $data = $request->validated();

        $data['image'] = $this->uploadImage($request, 'image', 'images');

        if (! empty($request->input('selling_price'))) {
            $data['selling_price'] = $request->input('selling_price');
        } else {
            foreach ($data['service_ids'] as $id) {
                $service = Service::getServiceById($id);
                $data['selling_price'] += $service->selling_price;
            }
        }

        if (! empty($request->input('original_price'))) {
            $data['original_price'] = $request->input('original_price');
        } else {
            foreach ($data['service_ids'] as $id) {
                $service = Service::getServiceById($id);
                $data['original_price'] += $service->original_price;
            }
        }

        $servicePackage = ServicePackage::query()->create([
            'name' => $data['name'],
            'image' => $data['image'],
            'description' => $data['description'],
            'original_price' => $data['original_price'],
            'selling_price' => $data['selling_price'],
        ]);

        $servicePackage->services()->sync($data['service_ids']);

        toast('Thêm mới gói dịch vụ ' . $servicePackage->name . ' thành công', 'success');

        return redirect('package-services');
    }

    public function edit(string $id): View
    {
        $services = Service::all();

        $servicePackage = ServicePackage::getServicePackageById($id);

        return view('admin.service-packages.edit', compact('services', 'servicePackage'));
    }

    public function update(UpdateServicePackage $request, string $id): RedirectResponse
    {
        $data = $request->validated();

        $servicePackage = ServicePackage::getServicePackageById($id);

        if (! $request->hasFile('image')) {
            $data['image'] = $servicePackage->image;
        }

        if ($request->hasFile('image')) {
            $oldImage = 'storage/' . $servicePackage->image;

            $this->deleteImage($oldImage);

            $data['image'] = $this->uploadImage($request, 'image', 'images');
        }

        if (!empty($request->input('selling_price'))) {
            $data['selling_price'] = $request->input('selling_price');
        } else {
            foreach ($data['service_ids'] as $id) {
                $service = Service::getServiceById($id);
                $data['selling_price'] += $service->selling_price;
            }
        }

        if (! empty($request->input('original_price'))) {
            $data['original_price'] = $request->input('original_price');
        } else {
            foreach ($data['service_ids'] as $id) {
                $service = Service::getServiceById($id);
                $data['original_price'] += $service->original_price;
            }
        }

        $servicePackage->update([
            'name' => $data['name'],
            'image' => $data['image'],
            'description' => $data['description'],
            'original_price' => $data['original_price'],
            'selling_price' => $data['selling_price'],
        ]);

        $servicePackage->services()->sync($data['service_ids']);

        toast('Cập nhật gói dịch vụ ' . $servicePackage->name . ' thành công', 'success');

        return redirect('package-services');

    }
    public function destroy(string $id): RedirectResponse
    {
        $servicePackage = ServicePackage::getServicePackageById($id);

        $image = 'storage/' . $servicePackage->image;

        $this->deleteImage($image);

        $servicePackage->delete();

        toast('Xóa sản phẩm ' . $servicePackage->name . ' thành công', 'success');

        return redirect('package-services');
    }
}
