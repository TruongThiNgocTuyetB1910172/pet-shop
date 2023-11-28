<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;
use Livewire\Component;

class ListProduct extends Component
{
    public $searchTerm = '';

    public $selectedCategory;

    public $sortOrder;

    public $categories;

    public $products;

    public function mount()
    {
        $this->categories = Category::all();
        $this->sortOrder = 'asc';
    }

    public function render(): View
    {
        $query = Product::query();

        $product = Product::all();

        if ($this->searchTerm) {
            $query->where('name', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('selling_price', 'like', '%' . $this->searchTerm . '%');
        }

        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        $query->orderBy('selling_price', $this->sortOrder);

        $this->products = $query->get();

        return view('livewire.list-product');
    }
}
