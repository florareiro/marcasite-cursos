<?php

namespace App\Livewire\Users;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Computed;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

class Users extends Component
{
    use WithPagination;


    #[Url(as: 'busca', keep: true, history: true)]
    public $search = '';


    // #[On('user-created')]
    // public function updateList($user = null)
    // {
    //     session()->flash('success', 'Atualizando lista...');
    // }

 
    public function render()
    {
        
            $users = User::query()
                ->when($this->search, fn ($query)=> $query->where('name', 'like', '%'.$this->search.'%'))
                ->paginate(10);
    
            return view('livewire.users.users',[
                'users' => $users
            ]);
        
    }


    public function pdf(Request $request){

        // Recuperar os registros do banco dados
        $users = User::orderByDesc('created_at')->get();
    
        // Carregar a string com o HTML/conteúdo e determinar a orientação e o tamanho do arquivo
        $pdf = Pdf::loadView('livewire.users.pdf', ['users' => $users])->setPaper('a4', 'portrait');
    
        // Fazer o download do arquivo
        return $pdf->download('listar_users.pdf');
        
    }


    public function excel() {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function delete(User $user)
    {
       
        $user->delete();

        return redirect()->route('livewire.users.users')
            ->with('status', 'User deletado com sucesso!');
    }


    /**
     *
     */
    #[Computed]
    public function users()
    {
        return User::all();
    }
}
