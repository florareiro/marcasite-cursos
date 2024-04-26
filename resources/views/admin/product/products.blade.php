@extends('admin.master.layout')

@section('content')

  <div class="container grid px-6 mx-auto">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
      Tabela de Cursos
    </h2>


    @livewire('gallery.index')
  </div>

@endsection

