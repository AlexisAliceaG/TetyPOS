<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight border-l-4 border-[#d13d7c] pl-4">
            {{ __('Registrar Nuevo Usuario') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-3xl border border-gray-100 relative">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-[#d13d7c] to-[#f472b6]"></div>

                <div class="p-8">
                    <form method="POST" action="{{ route('users.store') }}" autocomplete="off">
                        @csrf

                        <input autocomplete="false" name="hidden" type="text" style="display:none;">

                        <div class="flex flex-col sm:flex-row items-center gap-6 mb-10 pb-6 border-b border-gray-50">
                            <div class="h-20 w-20 rounded-3xl bg-gray-50 text-gray-300 flex items-center justify-center border-2 border-dashed border-gray-200 shadow-inner">
                                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                            </div>
                            <div class="text-center sm:text-left">
                                <h3 class="text-xl font-black text-gray-800 uppercase tracking-tight">Nuevo Perfil</h3>
                                <p class="text-xs text-gray-400 font-bold uppercase tracking-widest mt-1">Configuración de credenciales y acceso</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                            <div>
                                <x-input-label for="name" value="Nombre Completo" class="font-bold text-gray-700 uppercase text-xs tracking-widest" />
                                <x-text-input id="name" name="name" type="text" 
                                    class="w-full mt-1 border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm font-bold uppercase placeholder:text-gray-300" 
                                    :value="old('name')" required autofocus placeholder="Ej. Juan Pérez" />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="email" value="Correo Electrónico" class="font-bold text-gray-700 uppercase text-xs tracking-widest" />
                                <x-text-input id="email" name="email" type="email" 
                                    class="w-full mt-1 border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm font-bold placeholder:text-gray-300" 
                                    :value="old('email')" required autocomplete="new-email" placeholder="usuario@empresa.com" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="md:col-span-2 grid grid-cols-1 md:grid-cols-2 gap-6 bg-gray-50 p-6 rounded-2xl border border-gray-100 mt-2">
                                <div class="md:col-span-2">
                                    <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-2 text-center sm:text-left">Seguridad de la Cuenta</h4>
                                </div>
                                <div>
                                    <x-input-label for="password" value="Contraseña" class="font-bold text-gray-600 text-xs" />
                                    <x-text-input id="password" name="password" type="password" 
                                        class="w-full mt-1 border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm" 
                                        required autocomplete="new-password" placeholder="••••••••" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <div>
                                    <x-input-label for="password_confirmation" value="Confirmar Contraseña" class="font-bold text-gray-600 text-xs" />
                                    <x-text-input id="password_confirmation" name="password_confirmation" type="password" 
                                        class="w-full mt-1 border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm" 
                                        required autocomplete="new-password" placeholder="••••••••" />
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <x-input-label for="role" value="Rol del Sistema" class="font-bold text-gray-700 uppercase text-xs tracking-widest mb-2" />
                                <select name="role" id="role" 
                                    class="w-full border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm font-bold text-gray-700 transition">
                                    @foreach($roles as $role)
                                        <option value="{{ $role->name }}" {{ old('role') == $role->name ? 'selected' : '' }}>
                                            {{ ucfirst($role->name) }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('role')" class="mt-2" />
                            </div>

                            <div class="md:col-span-2 mt-4">
                                <h3 class="text-xs font-black text-gray-400 mb-4 uppercase tracking-[0.2em] flex items-center">
                                    Permisos Especiales Directos
                                    <span class="ml-2 h-px flex-1 bg-gray-100"></span>
                                </h3>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                                    @foreach($permissions as $permission)
                                        <label class="group relative flex items-center p-3 rounded-xl border border-gray-100 hover:border-[#d13d7c] hover:bg-pink-50 cursor-pointer transition-all shadow-sm active:scale-95 bg-white">
                                            <input type="checkbox" 
                                                   name="permissions[]" 
                                                   value="{{ $permission->name }}" 
                                                   class="rounded border-gray-300 text-[#d13d7c] shadow-sm focus:ring-[#d13d7c] h-5 w-5"
                                                   {{ is_array(old('permissions')) && in_array($permission->name, old('permissions')) ? 'checked' : '' }}>
                                            <span class="ml-3 text-xs font-bold text-gray-600 group-hover:text-[#d13d7c] select-none uppercase tracking-tight">
                                                {{ ucfirst(str_replace(['_', ' '], ' ', $permission->name)) }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="mt-12 flex flex-col-reverse sm:flex-row justify-end gap-4 border-t border-gray-50 pt-8">
                            <a href="{{ route('users.index') }}" 
                                class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 bg-white border border-gray-300 rounded-xl font-bold text-xs text-gray-500 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition">
                                {{ __('Cancelar') }}
                            </a>
                            <button type="submit" 
                                class="w-full sm:w-auto inline-flex justify-center items-center px-10 py-3 bg-[#d13d7c] border border-transparent rounded-xl font-black text-xs text-white uppercase tracking-widest hover:bg-[#b03368] active:scale-95 transition-all shadow-lg shadow-pink-100">
                                {{ __('Crear Usuario') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>