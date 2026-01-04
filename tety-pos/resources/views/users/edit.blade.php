<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Usuario') }}: {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <form method="POST" action="{{ route('users.update', $user) }}" autocomplete="off">
                    @csrf 
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="name" value="Nombre Completo" />
                            <x-text-input id="name" name="name" type="text" class="w-full mt-1" :value="old('name', $user->name)" required autocomplete="off" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="email" value="Correo Electrónico" />
                            <x-text-input id="email" name="email" type="email" class="w-full mt-1" :value="old('email', $user->email)" required autocomplete="none" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="md:col-span-2 bg-gray-50 p-4 rounded-lg border border-gray-200">
                            <h3 class="text-sm font-bold text-gray-700 mb-2">Seguridad</h3>
                            <x-input-label for="password" value="Nueva Contraseña (dejar vacío para mantener actual)" />
                            <x-text-input id="password" name="password" type="password" class="w-full mt-1" placeholder="••••••••" autocomplete="new-password" />
                            <p class="text-xs text-gray-500 mt-1 italic">Si ingresa una, debe tener al menos 8 caracteres.</p>
                        </div>

                        <div>
                            <x-input-label for="role" value="Rol Principal" />
                            <select name="role" id="role" class="w-full mt-1 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                @foreach($roles as $role)
                                    <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-2 border-t pt-6">
                            <h3 class="text-sm font-bold text-gray-700 mb-4 uppercase tracking-wider">Permisos Especiales Directos</h3>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                @foreach($permissions as $permission)
                                    <label class="relative flex items-start p-3 rounded-lg border border-gray-200 hover:bg-gray-50 cursor-pointer transition">
                                        <div class="flex items-center h-5">
                                            <input type="checkbox" 
                                                   name="permissions[]" 
                                                   value="{{ $permission->name }}" 
                                                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 h-4 w-4"
                                                   {{ $user->hasDirectPermission($permission->name) ? 'checked' : '' }}>
                                        </div>
                                        <div class="ml-3 text-sm">
                                            <span class="font-medium text-gray-700">
                                                {{ ucfirst(str_replace(['_', ' '], ' ', $permission->name)) }}
                                            </span>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                            
                            <div class="mt-4 p-3 bg-blue-50 rounded-md">
                                <p class="text-xs text-blue-700">
                                    <strong>Nota:</strong> Los permisos marcados aquí se asignan directamente al usuario, independientemente de lo que su rol permita.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-8 flex justify-end gap-4 border-t pt-6">
                        <a href="{{ route('users.index') }}" class="inline-flex items-center px-4 py-2 text-sm text-gray-600 underline hover:text-gray-900">
                            {{ __('Cancelar') }}
                        </a>
                        <x-primary-button>
                            {{ __('Guardar Cambios') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>