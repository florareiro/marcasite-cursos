<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use App\Models\Product;
use Illuminate\Validation\Rule;

class Edit extends Component
{
    public User $user;
   

    public $userId;
    public $name = '';
    public $email = '';
    public $password ='';
    public $cpf = '';
    public $cel = '';
    public $tel = '';
    public $company = '';
    public $subsType = '';
    public $productId = '';
    public $address = '';

    protected function rules ()
    {
        return [         
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'cpf' => 'nullable|min:8',
            'cel' => 'nullable|min:8',
            'tel' => 'nullable|min:8',
            'company' => 'nullable|min:8',
            'subsType' => 'nullable|min:8',
            'productId' => 'nullable',
            'address' => 'nullable',
        ];
    
    }
    
    public function render()
    {
        return view('livewire.users.edit', [
            'products' => Product::all(),
        ]);
    }

    public function mount(User $user)
    {
        $this->user = $user;
        $this->userId = $user->id;
        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->password = $this->user->password;
        $this->cpf = $this->user->cpf;
        $this->address = $this->user->address;
        $this->tel = $this->user->tel;
        $this->cel = $this->user->cel;
        $this->company = $this->user->company;
        $this->subsType = $this->user->subs_type;
        $this->productId = $this->user->product_id;
    }

    public function update()
    {
        $this->validate();

        $this->user->update([
            'name' => $this->name,
            'product_id' => $this->productId,
            'email' => $this->email,
            'password' => $this->password,
            'cpf' => $this->cpf,
            'address' => $this->address,
            'tel' => $this->tel,
            'cel' => $this->cel,
            'company' => $this->company,
            'subs_type' => $this->subsType,
        ]);
        $this->reset(['name', 'productId','email', 'password', 'cpf', 'address', 'tel', 'cel','company','subsType', ]);

        session()->flash('success', 'Usuário atualizado com sucesso!');
        return redirect()->route('livewire.users.users');
    }
}
