<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Traits\ImageTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductController extends Controller
{
    use ImageTrait;
    public int $itemPerPage = 10;
    public function index(): View
    {
        $products = Product::query()->orderByDesc('created_at')->paginate($this->itemPerPage);
        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::all();
       return view('admin.products.create', compact('categories') );
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['image'] = $this->uploadImage($request, 'image', 'images');
        Product::query()->create([
            'name' => $data['name'],
            'description' => $data['description'],
            'stock' => $data['stock'],
            'original_price' => $data['original_price'],
            'selling_price' => $data['selling_price'],
            'sku' => $data['sku'],
            'category_id' => $data['category_id'],
        ]);
        return redirect('products')->with('status', 'Product Added Successfully');
    }

    public function edit(string $id): View
    {
        $product = Product::getProductById($id);

        $categories = Category::all();

        return view('admin.products.edit',compact('product','categories'));
    }

    public function update(UpdateProductRequest $request, string $id): RedirectResponse
    {
        $data = $request->validated();

        $product = Product::getProductById($id);

        $data['image'] = $this->uploadImage($request, 'image', 'images');

        $product->update([
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

                ProductImage::query()->update([
                    'product_id' => $product->id,
                    'image' => 'images/' . $fileName,
                ]);
            }
        }

        return redirect('products')->with('status', 'Product update Successfully');
    }
    public function destroy(string $id): RedirectResponse
    {
        $product = Product::getProductById($id);

        $product->delete();

        return redirect('products')->with('status', 'Category deleted successfully');
    }

}
