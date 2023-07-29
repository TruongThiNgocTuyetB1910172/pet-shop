<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public int $itemPerPage = 10;

    public function index(): View
    {
        $categories = Category::query()->orderByDesc('created_at')->paginate($this->itemPerPage);

        return view('admin.categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.categories.create');
    }

    public function store(CategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();

        Category::query()->create([
            'name' => $data['name'],
        ]);
        return redirect('categories')->with('status', 'Category Added Successfully');
    }

    public function edit(string $id): View
    {
        $categories = Category::getCategoryById($id);
        return view('admin.categories.edit', compact('categories'));
    }

    public function update(CategoryRequest $request, string $id): RedirectResponse
    {
        $data = $request->validated();

        $categories = Category::getCategoryById($id);

        $categories->update([
            'name' => $data['name'],
        ]);

        return redirect('categories')->with('status', 'Category updated successfully');
    }

    public function destroy(string $id): RedirectResponse
    {
        $category = Category::getCategoryById($id);

        $category->delete();

        return redirect('categories')->with('status', 'Category deleted successfully');
    }
}
