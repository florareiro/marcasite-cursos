@extends('admin.master.layout')

@section('content')

  <div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
      Cadastro de Cursos
    </h2>

    {{-- Formulário de cadastro --}}
    <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
      Cadastro
    </h4>

    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-700">
      {{-- COMPONENT LIVEWIRE CREATE --}}
      <livewire:users.edit />
    </div>
  </div>
@endsection
