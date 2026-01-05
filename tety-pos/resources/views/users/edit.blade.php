<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight border-l-4 border-[#d13d7c] pl-4">
            {{ __('Editar Usuario') }}: <span class="text-[#d13d7c] uppercase">{{ $user->name }}</span>
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-3xl border border-gray-100 relative">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-yellow-400 via-[#d13d7c] to-pink-600"></div>

                <div class="p-8">
                    <form method="POST" action="{{ route('users.update', $user) }}" autocomplete="off">
                        @csrf 
                        @method('PUT')

                        <div class="flex flex-col sm:flex-row items-center gap-6 mb-10 pb-6 border-b border-gray-50">
                            <div class="h-24 w-24 rounded-3xl bg-pink-100 text-[#d13d7c] flex items-center justify-center text-4xl font-black shadow-inner border border-pink-200 uppercase">
                                {{ substr($user->name, 0, 2) }}
                            </div>
                            <div class="text-center sm:text-left">
                                <h3 class="text-xl font-black text-gray-800 uppercase tracking-tight">{{ $user->name }}</h3>
                                <p class="text-sm text-gray-400 font-mono italic">{{ $user->email }}</p>
                                <div class="mt-2">
                                    <span class="px-3 py-1 bg-gray-100 text-[#d13d7c] text-[10px] font-black rounded-full border border-gray-200 uppercase tracking-widest">
                                        Editor de Perfil
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                            <div>
                                <x-input-label for="name" value="Nombre Completo" class="font-bold text-gray-700 uppercase text-xs tracking-widest" />
                                <x-text-input id="name" name="name" type="text" 
                                    class="w-full mt-1 border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm font-bold" 
                                    :value="old('name', $user->name)" required />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="email" value="Correo Electrónico" class="font-bold text-gray-700 uppercase text-xs tracking-widest" />
                                <x-text-input id="email" name="email" type="email" 
                                    class="w-full mt-1 border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm font-bold" 
                                    :value="old('email', $user->email)" required autocomplete="none" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <div class="md:col-span-2 bg-gray-50 p-6 rounded-2xl border border-gray-100 shadow-inner">
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div class="md:col-span-2">
                                        <h3 class="text-xs font-black text-gray-400 mb-2 uppercase tracking-[0.2em]">Configuración de Seguridad</h3>
                                    </div>
                                    
                                    <div>
                                        <x-input-label for="password" value="Nueva Contraseña" class="font-bold text-gray-600 text-xs" />
                                        <x-text-input id="password" name="password" type="password" 
                                            class="w-full mt-1 border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm" 
                                            placeholder="••••••••" autocomplete="new-password" />
                                        <p class="text-[10px] text-gray-400 mt-2 italic font-medium">Dejar en blanco para mantener la contraseña actual.</p>
                                    </div>

                                    <div>
                                        <x-input-label for="role" value="Rol Principal del Sistema" class="font-bold text-gray-600 text-xs" />
                                        <select name="role" id="role" 
                                            class="w-full mt-1 border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm font-bold text-gray-700 transition">
                                            @foreach($roles as $role)
                                                <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                    {{ ucfirst($role->name) }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="md:col-span-2 mt-4">
                                <h3 class="text-xs font-black text-gray-400 mb-4 uppercase tracking-[0.2em] flex items-center">
                                    Permisos Especiales Directos
                                    <span class="ml-2 h-px flex-1 bg-gray-100"></span>
                                </h3>
                                
                                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3">
                                    @foreach($permissions as $permission)
                                        <label class="group relative flex items-center p-3 rounded-xl border border-gray-200 hover:border-[#d13d7c] hover:bg-pink-50 cursor-pointer transition-all shadow-sm active:scale-95 bg-white">
                                            <input type="checkbox" 
                                                   name="permissions[]" 
                                                   value="{{ $permission->name }}" 
                                                   class="rounded border-gray-300 text-[#d13d7c] shadow-sm focus:ring-[#d13d7c] h-5 w-5"
                                                   {{ $user->hasDirectPermission($permission->name) ? 'checked' : '' }}>
                                            <span class="ml-3 text-xs font-bold text-gray-600 group-hover:text-[#d13d7c] select-none uppercase tracking-tight">
                                                {{ ucfirst(str_replace(['_', ' '], ' ', $permission->name)) }}
                                            </span>
                                        </label>
                                    @endforeach
                                </div>
                                
                                <div class="mt-6 p-4 bg-blue-50 rounded-2xl border border-blue-100 flex items-start gap-3">
                                    <svg class="w-5 h-5 text-blue-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <p class="text-[11px] text-blue-700 leading-relaxed">
                                        <strong>IMPORTANTE:</strong> Los permisos marcados arriba se asignan de forma independiente al Rol. Esto permite dar acceso a funciones específicas sin cambiar el nivel de jerarquía del usuario.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-12 flex flex-col-reverse sm:flex-row justify-end gap-4 border-t border-gray-100 pt-8">
                            <a href="{{ route('users.index') }}" 
                                class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 bg-white border border-gray-300 rounded-xl font-bold text-xs text-gray-500 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition">
                                {{ __('Cancelar') }}
                            </a>
                            <button type="submit" 
                                class="w-full sm:w-auto inline-flex justify-center items-center px-10 py-3 bg-[#d13d7c] border border-transparent rounded-xl font-black text-xs text-white uppercase tracking-widest hover:bg-[#b03368] active:scale-95 transition-all shadow-lg shadow-pink-100">
                                {{ __('Guardar Cambios') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>