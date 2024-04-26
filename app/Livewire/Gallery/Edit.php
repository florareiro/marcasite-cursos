<?php

namespace App\Livewire\Gallery;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public Product $product;


    public $productId;
    public string $name = '';
    public string $desc = '';
    public $price = '';
    public $startDate = '';
    public $finalDate = '';
    public $subsMax = '';
    public $file; 

    protected function rules()
    {
            return [
                'name' => ['required', 'min:3', 'max:300'],
                'desc' => ['nullable', 'min:3', 'max:2000'],
                'price' => ['nullable', 'numeric'],
                'startDate' => ['nullable', 'date'],
                'finalDate' => ['nullable', 'date'],
                'subsMax' => ['nullable', 'numeric'],
                'file' => ['nullable', 'file', 'mimes:pdf,doc, docx', 'max:2048'],
            ];
        
    }

    public function render()
    {
        return view('livewire.gallery.edit');
    }

    public function mount(Product $product)
    {

        
        $this->product = $product;
        $this->productId = $product->id;
        $this->name = $this->product->name;
        $this->desc = $this->product->desc;
        $this->price = $this->product->price;
        $this->startDate = $this->product->start_date;
        $this->finalDate = $this->product->final_date;
        $this->subsMax = $this->product->subs_max;
        $this->file = $this->product->file;
    }

    public function update(Product $product)
    {
        sleep(3);

        if ($this->productId) {
            // Check if a new file is uploaded
            if ($this->file instanceof UploadedFile) {
                if ($this->product->file && $this->product->file != 'storage/default.jpg') {
                    // Delete the old file
                    if (Storage::exists('public/' . $this->product->file)) {
                        Storage::delete('public/' . $this->product->file);
                    }
                }
                // Save the new file
                $this->product->file = $this->file->store('public/products');
                // Remove the "public/" prefix from the file path
                $this->product->file = Str::replaceFirst('public/', '', $this->product->file);
            }
    
            $this->product->update([
                'name' => $this->name,
                'desc' => $this->desc,
                'price' => $this->price,
                'start_date' => $this->startDate, // Corrected property name
                'final_date' => $this->finalDate, // Corrected property name
                'subs_max' => $this->subsMax,
                'file' => $this->product->file, // Keep the existing file if not updated
            ]);
    
            $this->reset('name', 'desc', 'price', 'startDate', 'finalDate', 'subsMax', 'file');
    
            return redirect()->route('gallerys.index')
                ->with('status', 'Produto atualizado com sucesso!');
        }
    }
}
