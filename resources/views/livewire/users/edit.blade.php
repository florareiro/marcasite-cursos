<div>
    <div class="min-w-0 p-4 bg-white rounded-lg shadow-xs dark:bg-gray-800">
        @if(session('success'))
            <h4 class="mb-4 text-lg font-semibold text-gray-600 dark:text-gray-300">
                {{session('success')}}
            </h4>
        @else
            <h4 class="mb-4 font-semibold text-gray-800 dark:text-gray-300">
                Form update user
            </h4>
        @endif

        {{-- WIRE SUBMIT --}}
        <form wire:submit="update({{$user->id}})">
            @if (session('status'))
                <div class="min-w-0 p-3 mb-2 text-white text-sm bg-green-600 rounded-lg shadow-xs">
                    {{ session('status') }}
                </div>
            @endif

            <div class="grid grid-cols-2 gap-4">
                {{-- WIRE NAME --}}
                <label class="text-sm w-full">
                    <span class="text-gray-700 dark:text-gray-400">Name</span>
                    <input wire:model.defer="name" class="w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Informe nome"/>
                    <div class="text-red-500">@error('name') <span class="error">{{ $message }}</span> @enderror</div>
                </label>

                {{-- WIRE EMAIL --}}
                <label class=" text-sm w-full">
                    <span class="text-gray-700 dark:text-gray-400">E-mail</span>
                    <input wire:model.defer="email" class="w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Email"/>
                    <div class="text-red-500">@error('email') <span class="error">{{ $message }}</span> @enderror</div>
                </label>
            </div>

            <div class="grid grid-cols-2 gap-4">
                {{-- WIRE PASSWORD --}}
                <label class="mt-4 text-sm w-full">
                    <span class="text-gray-700 dark:text-gray-400">Senha</span>
                    <input wire:model.defer="password" class="w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Senha" type="password"/>
                    <div class="text-red-500">@error('password') <span class="error">{{ $message }}</span> @enderror</div>
                </label>
                <label class="mt-4 text-sm w-full">
                    <span class="text-gray-700 dark:text-gray-400">CPF</span>
                    <input wire:model.defer="cpf" class="w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="CPF" type="text"/>
                    <div class="text-red-500">@error('cpf') <span class="error">{{ $message }}</span> @enderror</div>
                </label>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <label class="mt-4 text-sm w-full">
                    <span class="text-gray-700 dark:text-gray-400">Endereço</span>
                    <input wire:model.defer="address" class="w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Endereço" type="text"/>
                    <div class="text-red-500">@error('address') <span class="error">{{ $message }}</span> @enderror</div>
                </label>
                <label class="mt-4 text-sm w-full">
                    <span class="text-gray-700 dark:text-gray-400">Tel</span>
                    <input wire:model.defer="tel" class="w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Tel" type="tel"/>
                    <div class="text-red-500">@error('tel') <span class="error">{{ $message }}</span> @enderror</div>
                </label>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <label class="mt-4 text-sm w-full">
                    <span class="text-gray-700 dark:text-gray-400">Cel</span>
                    <input wire:model.defer="cel" class="w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Cel" type="text"/>
                    <div class="text-red-500">@error('cel') <span class="error">{{ $message }}</span> @enderror</div>
                </label>
                <label class="mt-4 text-sm w-full">
                    <span class="text-gray-700 dark:text-gray-400">Tipo de Usuário</span>
                    <input wire:model.defer="subsType" class="w-full mt-1 text-sm dark:border-gray-600 dark:bg-gray-700 focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:text-gray-300 dark:focus:shadow-outline-gray form-input" placeholder="Empresa" type="text"/>
                    <div class="text-red-500">@error('subsType') <span class="error">{{ $message }}</span> @enderror</div>
                </label>
            </div>

    {{-- <div class="grid grid-cols-1 gap-4"> --}}
      
           {{-- Curso --}}
        {{-- <label class="block mt-4 text-sm">
            <span class="text-gray-700 dark:text-gray-400">
                Curso
            </span>
            <select wire:model="productId" id="productId" class="block w-full mt-1 text-sm dark:text-gray-300 text-gray-800 dark:border-gray-600 dark:bg-gray-700 form-select focus:border-purple-400 focus:outline-none focus:shadow-outline-purple dark:focus:shadow-outline-gray">
                <option value={{}}>Selecione um Curso</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
            <div class="text-red-500">
                @error('productId') <span class="error">{{ $message }}</span> @enderror
            </div>
        </label>
         --}}
           {{-- Hidden input for product ID --}}
           {{-- <input type="hidden" wire:model.defer="productId"> --}}

    {{-- </div> --}}

            <div class="flex justify-center mt-4 text-sm">
                <button wire:confirm.prompt="Você quer realmente criar o usuário? \n Para confirmar  digite CONFIRME to confirm |CONFIRM" type="submit" class="flex w-full items-center justify-between px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                    <span>Atualizar Usuário</span>
                    <i class="text-2xl ri-save-line"></i>
                </button>
            </div>
        </form>
    </div>
</div>
