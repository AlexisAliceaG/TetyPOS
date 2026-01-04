<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Marca') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('brands.store') }}">
                    @csrf
                    <div>
                        <x-input-label for="name" :value="__('Nombre de la Marca')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" required autofocus />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('brands.index') }}" class="mr-4 text-sm text-gray-600 underline hover:text-gray-900">Cancelar</a>
                        <x-primary-button>Guardar Marca</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>