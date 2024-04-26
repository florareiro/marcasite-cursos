<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreStudant;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;


class UserController extends Controller
{
    public function index()
    {
        return view('admin.user.users');
    }

    public function create()
    {
        // Fetch all products for selection
        $products = Product::all();
        return view('admin.user.create', compact('products'));
    }

    public function store(StoreUser $request)
    {
        // Create the user
        $user = User::create($request->validated());

        // Associate the user with a product
        $product = Product::find($request->input('product_id'));
        $product->users()->save($user);

        // Store user image
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('public/files/users/users');
            $user->update(['image' => $imagePath]);
        }

        return redirect()->route('users.index')->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('livewire.users.edit', compact('user'));
    }

    public function pdf(Request $request){

        // Recuperar os registros do banco dados
        $users = User::orderByDesc('created_at')->get();
    
        // Carregar a string com o HTML/conteúdo e determinar a orientação e o tamanho do arquivo
        $pdf = PDF::loadView('livewire.users.pdf', ['users' => $users])->setPaper('a4', 'portrait');
    
        // Fazer o download do arquivo
        return $pdf->download('listar_users.pdf');
        
    }


    public function excel() {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

}
