<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use Illuminate\Http\RedirectResponse;
use App\Traits\ImageTrait;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\View\View;

class ProductController extends Controller
{
    use ImageTrait;

    public int $itemPerPage = 10;

    public function index(): View
    {
        $products = Product::query()
            ->orderByDesc('created_at')
            ->paginate($this->itemPerPage);
        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::all();

        return view('admin.products.create', compact('categories'));
    }

    public function store(CreateProductRequest $request): RedirectResponse
    {

        $data = $request->validated();

        $data['image'] = $this->uploadImage($request, 'image', 'images');

        $product=Product::query()->create([
            'name' => $data['name'],
            'description' => $data['description'],
            'stock' => $data['stock'],
            'original_price' => $data['original_price'],
            'selling_price' => $data['selling_price'],
            'sku' => $data['sku'],
            'category_id' => $data['category_id'],
            'image' => $data['image'],
        ]);

        if (isset($data['product_image'])) {
            $images = $data['product_image'];

            foreach ($images as $image) {
                $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('images/', $fileName);

                ProductImage::query()->create([
                    'product_id' => $product->id,
                    'image' => 'images/' . $fileName,
                ]);
            }
        }

        return redirect('products')->with('status', 'Product Added Successfully');
    }

    public function edit(string $id): View
    {
        $product = Product::getProductById($id);

        $categories = Category::all();

        return view('admin.products.edit', compact('product','categories'));
    }

    public function update(UpdateProductRequest $request,string $id): RedirectResponse
    {
        $data = $request->validated();

        $product = Product::getProductById($id);

        $data['image'] = $this->uploadImage($request, 'image', 'images');

        $product->update([
            'name' => $data['name'],
            'stock' => $data['stock'],
            'sku' => $data['sku'],
            'description' => $data['description'],
            'category_id' => $data['category_id'],
            'image' => $data['image'],
            'original_price' => $data['original_price'],
            'selling_price' => $data['selling_price'],
        ]);

        if (isset($data['product_image'])) {
            $images = $data['product_image'];

            foreach ($images as $image) {
                $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('images/', $fileName);

                ProductImage::query()->update([
                    'product_id' => $product->id,
                    'image' => 'images/' . $fileName,
                ]);
            }
        }

        return redirect('products')->with('status','Product update successfully');
    }

    public function destroy(string $id): RedirectResponse
    {
        $product = Product::getProductById($id);

        $product->delete();

        return redirect('products')->with('status','Product delete successfully');
    }


}
