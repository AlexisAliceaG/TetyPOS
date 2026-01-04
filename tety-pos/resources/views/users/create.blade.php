<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Registrar Nuevo Usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <form method="POST" action="{{ route('users.store') }}" autocomplete="off">
                    @csrf

                    <input autocomplete="false" name="hidden" type="text" style="display:none;">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="name" value="Nombre Completo" />
                            <x-text-input id="name" name="name" type="text" class="w-full mt-1" :value="old('name')" required autofocus autocomplete="off" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="email" value="Correo Electrónico" />
                            <x-text-input id="email" name="email" type="email" class="w-full mt-1" :value="old('email')" required autocomplete="new-email" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="password" value="Contraseña" />
                            <x-text-input id="password" name="password" type="password" class="w-full mt-1" required autocomplete="new-password" />
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="password_confirmation" value="Confirmar Contraseña" />
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="w-full mt-1" required autocomplete="new-password" />
                        </div>

                        <div>
                            <x-input-label for="role" value="Rol del Sistema" />
                            <select name="role" id="role" class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('role')" class="mt-2" />
                        </div>

                        <div class="md:col-span-2 border-t pt-6">
                            <h3 class="text-sm font-bold text-gray-700 mb-4 uppercase tracking-wider">Asignar Permisos Especiales Directos</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                @foreach($permissions as $permission)
                                    <label class="relative flex items-start p-3 rounded-lg border border-gray-200 hover:bg-gray-50 cursor-pointer transition">
                                        <div class="flex items-center h-5">
                                            <input type="checkbox" 
                                                   name="permissions[]" 
                                                   value="{{ $permission->name }}" 
                                                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 h-4 w-4"
                                                   {{ is_array(old('permissions')) && in_array($permission->name, old('permissions')) ? 'checked' : '' }}>
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <span class="font-medium text-gray-700">
                                                {{ ucfirst(str_replace(['_', ' '], ' ', $permission->name)) }}
                                            </span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end gap-4 border-t pt-6">
                        <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 text-sm text-gray-600 underline hover:text-gray-900">
                            {{ __('Cancelar') }}
                        </a>
                        <x-primary-button>
                            {{ __('Crear Usuario') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>