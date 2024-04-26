@extends('admin.master.layout')

@section('content')


<div class="container px-6 mx-auto grid">
    <h2 class="my-6 text-2xl font-semibold text-gray-700 dark:text-gray-200">
      Dashboard
    </h2>

    {{-- CTA #Lazy loading: https://livewire.laravel.com/docs/lazy --}}
    <livewire:adm.painel-button lazy/>

    {{-- USERS TABLES/CREATE --}}
    @livewire('users.users')


    {{-- STUDENTS TABLES --}}
    @livewire('gallery.index')


</div>

@endsection
