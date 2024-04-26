<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Component;
use App\Models\Product;

class Create extends Component
{


    public User $user;
  

    #[Rule(['name'=>'required|min:3'], message: ['required' => ':attribute é necessário.'], attribute: ['name' => 'O nome'])]
    public $name;

    #[Rule('required|email|unique:users', message: ':attribute é obrigatório!', attribute: ['email'=> 'O e-mail'])]
    public $email;

    #[Rule('required|min:8', message: ':a senha é obrigatória!', as: 'A senha')]
    public $password;


    #[Rule('nullable|min:8')]
    public $cpf = '';
    
    #[Rule('nullable|min:8')]
    public $cel  = '';
    
    #[Rule('nullable|min:8')]
    public $tel  = '';
    
    #[Rule('nullable|min:8')]
    public $company  = '';
    
    #[Rule('nullable|min:8')]
    public $subsType  = '';
    
    #[Rule('nullable', message: 'Precisa selecionar uma disciplina.')]
    public $productId = '';

    #[Rule('nullable|min:8')]
    public string $address  = '';




    public function render()
    {
        return view('livewire.users.create', [
            'products' => Product::all(),
        ]);
    }


    public function save(){

        $this->validate();

        $user = User::create([
            'name'      => $this->name,
            'product_id' =>$this->productId,
            'email'     => $this->email,
            'password'  => $this->password,
            'cpf'  => $this->cpf,
            'address'  => $this->address,
            'tel'  => $this->tel,
            'cel'  => $this->cel,
            'company'  => $this->company,
            'subs_type'  => $this->subsType,

        ]);

        $this->reset(['name', 'productId','email', 'password', 'cpf', 'address', 'tel', 'cel','company','subsType', ]);

        session()->flash('success', 'Usuário criado com sucesso!');

        $this->dispatch('user-created', $user);
       return redirect()->with('success', 'Usuário criado com sucesso!');
    }
}
