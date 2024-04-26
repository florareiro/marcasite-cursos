<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Livewire\Attributes\Rule;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */



     #[Rule('nullable|min:8')]
     public $cpf = '';
        
     #[Rule('nullable')]
     public $productId = '';
     
     #[Rule('nullable|min:8')]
     public $cel  = '';
     
     #[Rule('nullable|min:8')]
     public $tel  = '';
     
     #[Rule('nullable|min:8')]
     public $company  = '';
     
     #[Rule('nullable|min:8')]
     public $subsType  = '';
     
     #[Rule('nullable')]
     public string $address = '';
   

 
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'cpf'  => $this->cpf,
            'address'  => $this->address,
            'tel'  => $this->tel,
            'cel'  => $this->cel,
            'company'  => $this->company,
            'subs_type'  => $this->subsType,

        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
