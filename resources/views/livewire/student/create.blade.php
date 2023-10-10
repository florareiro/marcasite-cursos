{{-- WIRE SUBMIT --}}
<form wire:submit="save" class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800" enctype="multipart/form-data">
    @csrf

    @if (session('status'))
        <div class="min-w-0 p-3 mb-2 text-white text-sm bg-green-600 rounded-lg shadow-xs">
            {{ session('status') }}
        </div>
    @endif

    {{-- WIRE NAME --}}
    <label class="block text-sm">
        <span class="text-gray-700 dark:text-gray-400">Name</span>
        <input wire:model.lazy="form.name" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
               placeholder="Informe seu nome"/>
        <div class="text-red-500">
            @error('form.name') <span class="error">{{ $message }}</span> @enderror
        </div>
    </label>

    {{-- WIRE EMAIL --}}
    <label class="mt-4 block text-sm">
        <span class="text-gray-700 dark:text-gray-400">E-mail</span>
        <input wire:model.live="form.email" class="block w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input"
               placeholder="Informe seu e-mail"/>
        <div class="text-red-500">
            @error('form.email') <span class="error">{{ $message }}</span> @enderror
        </div>
    </label>



        {{-- IMAGE --}}
        <label for="prd-img" class="mt-4 block text-sm">
            <span class="text-gray-700 dark:text-gray-400">Image</span>


            <div x-data="{ uploading: false, progress: 0}"
                 x-on:livewire-upload-start="uploading = true"
                 x-on:livewire-upload-finish="uploading = false"
                 x-on:livewire-upload-error="uploading = false"
                 x-on:livewire-upload-progress="progress = $event.detail.progress">

                {{-- INPUT IMAGE --}}
                <div class="flex justify-center align-middle mt-1">

                    @if($form->image)
                        <div class="flex justify-between text-sm mr-3">
                            <img class="object-cover rounded-full" src="{{$form->image->temporaryUrl()}}" alt="" width="50"/>
                        </div>
                    @endif

                    <input class="lock w-full mt-1 text-sm dark:text-gray-800 dark:border-gray-600 dark:bg-gray-700 shadow-sm rounded-md focus:z-10 focus:border-blue-500 focus:ring-blue-500 dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 file:bg-transparent file:border-0 file:bg-gray-100 file:mr-4 file:py-3 file:px-4 dark:focus:shadow-outline-gray dark:file:text-gray-400"
                           wire:model="form.image"
                           type="file"
                           id="prd-img">
                </div>


                <div class="m-8" x-show="uploading" class="h-1 w-full bg-neutral-200 dark:bg-neutral-600 bg-red-600">
                    <div wire:loading.duration.200ms wire:target="form.image" class="text-white text-sm">
                        baixando image...
                    </div>
                    <progress class="h-4 bg-red-600" max="100" x-bind:value="progress" style="width: 100%; background-color: red;"></progress>
                </div>

            </div>

            <div class="text-red-500 mt-2">
                @error('form.image') <span class="error">{{ $message }}</span> @enderror
            </div>
        </label>

    <div class="grid grid-cols-2 gap-4">
        {{-- DISCIPLINA --}}
        <label class="block mt-4 text-sm">
        <span class="text-gray-700 dark:text-gray-400">
          Disciplina
        </span>
            <select wire:model.live="class_id" id="class_id" class="block w-full mt-1 text-sm dark:text-gray-300 text-gray-800 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                <option value="">Selecione uma disciplina</option>
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}">
                        {{ $class->name }}
                    </option>
                @endforeach
            </select>
            <div class="text-red-500">
                @error('class_id') <span class="error">{{ $message }}</span> @enderror
            </div>
        </label>

        {{-- TURMA --}}
        <label class="block mt-4 text-sm">
        <span class="text-gray-700 dark:text-gray-400">
          Turma
        </span>
            <select wire:model="form.section_id" id="section_id" class="block w-full mt-1 text-sm dark:text-gray-300 text-gray-800 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                <option value="">Selecione uma turma</option>
                @foreach ($sections as $section)
                    <option value="{{ $section->id }}">
                        {{ $section->name }} - {{ $section->class->name }}
                    </option>
                @endforeach
            </select>
            <div class="text-red-500">
                @error('form.section_id') <span class="error">{{ $message }}</span> @enderror
            </div>
        </label>
    </div>

    {{-- MESSAGE LOADING --}}
    <div class="w-full min-w-0 p-3 mb-1 mt-2 text-red-900 text-sm bg-purple-400 rounded-lg shadow-xs"
         wire:loading
         wire:target="save" wire:loading.class="bg-green-600">
        Analisando a solicitação de cadastro novo...
    </div>

    <div class="flex justify-between mt-4 text-sm" wire:loading.attr="disabled">
        <a href="{{ route('students.index') }}" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            <span>Cancelar</span>
            <svg class="w-4 h-4 ml-2 -mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12.0007 10.5865L16.9504 5.63672L18.3646 7.05093L13.4149 12.0007L18.3646 16.9504L16.9504 18.3646L12.0007 13.4149L7.05093 18.3646L5.63672 16.9504L10.5865 12.0007L5.63672 7.05093L7.05093 5.63672L12.0007 10.5865Z"></path></svg>
        </a>
        <button type="submit" class="flex items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
            <span>Salvar</span>
            <svg class="w-4 h-4 ml-2 -mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5 5V19H19V7.82843L16.1716 5H5ZM4 3H17L20.7071 6.70711C20.8946 6.89464 21 7.149 21 7.41421V20C21 20.5523 20.5523 21 20 21H4C3.44772 21 3 20.5523 3 20V4C3 3.44772 3.44772 3 4 3ZM12 18C10.3431 18 9 16.6569 9 15C9 13.3431 10.3431 12 12 12C13.6569 12 15 13.3431 15 15C15 16.6569 13.6569 18 12 18ZM6 6H15V10H6V6Z"></path></svg>
        </button>
    </div>
</form>
