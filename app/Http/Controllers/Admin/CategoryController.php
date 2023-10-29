<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public int $itemPerPage = 10;

    public function index(): View
    {
        $searchTerm = request()->query('searchTerm') ?? '';

        if (is_array($searchTerm)) {
            $searchTerm = '';
        }
        $search = '%' . $searchTerm . '%';

        $categories = Category::where(function ($query) use ($search) {
            $query->where('name', 'like', $search);
        })->orderByDesc('created_at')
            ->with('products')
            ->paginate($this->itemPerPage);


        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $categories = Category::query()->create([
            'name' => $data['name'],
        ]);
        toast('Tạo mới danh mục ' . $categories->name . ' thành công', 'success');

        return redirect('categories');
    }

    public function edit(string $id): View
    {
        $category = Category::getCategoryById($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(CategoryRequest $request, string $id): RedirectResponse
    {
        $data = $request->validated();

        $categories = Category::getCategoryById($id);

        $categories->update([
            'name' => $data['name'],
        ]);

        toast('Cập nhật danh mục ' . $categories->name . ' thành công', 'success');

        return redirect('categories');
    }

    public function destroy(string $id): RedirectResponse
    {
        $category = Category::getCategoryById($id);

        if ($category->products->count() > 0) {

            toast('Xóa sản phẩm thuộc danh mục trước khi xóa danh mục !', 'warning');

            return redirect('categories');
        }

        $category->delete();

        toast('Xóa danh mục ' . $category->name . ' thành công', 'success');

        return redirect('categories');
    }
}
