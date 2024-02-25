<?php

namespace App\Livewire;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class Eloquent extends Component
{
    use WithPagination;

    public string $query = '';
    public function getProduct()
    {
        return Product::query()
            ->where('name_product', 'LIKE', '%' . $this->query . '%')
            ->paginate(8);
    }

    public function updatingQuery()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.eloquent', [
            'getProduct' => $this->getProduct()
        ]);
    }
}
