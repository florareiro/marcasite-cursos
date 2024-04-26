<?php

namespace App\Livewire\Gallery;

use App\Models\Product;
use App\Models\Student;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Computed;

class Create extends Component
{
    use WithFileUploads;

    public string $name = '';
    public string $desc = '';
    public $price = '';
    public $startDate = '';
    public string $finalDate = '';
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
        return view('livewire.gallery.create');
    }

    public function save()
    {
        $this->validate();

        $startDate = $this->startDate ? date('Y-m-d', strtotime($this->startDate)) : null;
        $finalDate = $this->finalDate ? date('Y-m-d', strtotime($this->finalDate)) : null;

        $data = [
            'name' => $this->name,
            'desc' => $this->desc,
            'price' => $this->price,
            'start_date' => $startDate,
            'final_date' => $finalDate,
            'subs_max' => $this->subsMax,
            'file' => $this->file ? Str::replaceFirst('public/', '', $this->file->store('public/products')) : null,
        ];

        Product::create($data);

        $this->reset('name', 'desc', 'price', 'startDate', 'finalDate', 'subsMax', 'file');

        session()->flash('status', 'Produto cadastrado com sucesso!');

        return redirect(route('gallerys.index'));
    }
}