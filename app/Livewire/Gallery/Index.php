<?php

namespace App\Livewire\Gallery;

use App\Models\Product;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;

class Index extends Component
{
    #[Url(as: 'busca', keep: true)]
    public $search = '';

    public function render()
    {
        return view('livewire.gallery.index',[
            'products' => Product::paginate(3)
        ]);
    }

    public function delete(Product $product)
    {
        if ($product->image && $product->image != 'storage/default.jpg') {
            // Verifique se o arquivo de imagem existe antes de tentar excluí-lo
            if (Storage::exists('public/'.$product->image)) {
                Storage::delete('public/'.$product->image);
            }
        }

        $product->delete();

        return redirect()->route('students.index')
            ->with('status', 'Product deletado com sucesso!');
    }

    #[Computed]
    public function products()
    {
        return Product::all();
    }
}
