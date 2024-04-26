@extends('admin.master.layout')

@section('content')

  <div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
      Cadastro de estudante
    </h2>

  


    <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
      Informações do estudante
    </h4>

    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">


      <livewire:student.create/>
    </div>
  </div>
@endsection