<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Banner\CreateBannerRequest;
use App\Http\Requests\Banner\UpdateBannerRequest;
use App\Models\Banner;
use App\Traits\ImageTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BannerController extends Controller
{
    use ImageTrait;
    public int $itemPerPage = 10;

    public function index(): View
    {
        $banners = Banner::query()->orderByDesc('created_at')->paginate($this->itemPerPage);
        return view('admin.banners.index', compact('banners'));
    }

    public function create(): View
    {
        return view('admin.banners.create');
    }

    public function store(CreateBannerRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $data['image'] = $this->uploadImage($request, 'image', 'images');

        Banner::query()->create([
           'status' => $data['status'],
           'image' => $data['image'],
        ]);
        toast('Tạo mới banner thành công', 'success');

        return redirect('banners');
    }

    public function edit(string $id): View
    {
        $banner = Banner::getBannerById($id);

        return view('admin.banners.edit', compact('banner'));
    }

    public function update(UpdateBannerRequest $request, string $id): RedirectResponse
    {
        $data = $request->validated();

        $banner = Banner::getBannerById($id);

        if (! $request->hasFile('image')) {
            $data['image'] = $banner->image;
        }

        if ($request->hasFile('image')) {
            $oldImage = 'storage/' . $banner->image;

            $this->deleteImage($oldImage);

            $data['image'] = $this->uploadImage($request, 'image', 'images');
        }

        $banner->update([
            'status' => $data['status'],
            'image' => $data['image'],
        ]);

        toast('Cập nhật banner thành công', 'success');

        return redirect('banners');
    }

    public function destroy(string $id): RedirectResponse
    {
        $banner = Banner::getBannerById($id);

        $image = 'storage/' . $banner->image;

        $this->deleteImage($image);

        $banner->delete();

        toast('Xóa banner thành công', 'success');

        return redirect('banners');
    }
}
