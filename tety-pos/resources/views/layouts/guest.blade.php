<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Punto de Venta') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            /* BOTÓN PRINCIPAL (LOGIN / REGISTRO) */
            button[type="submit"],
            .bg-gray-800 {
                background-color: #d13d7c !important;
                text-transform: uppercase !important;
                font-weight: 800 !important;
                letter-spacing: 0.1em !important;
                padding: 0.75rem 1.5rem !important;
                border-radius: 0.75rem !important;
                transition: all 0.3s ease !important;
            }

            button[type="submit"]:hover {
                background-color: #b03368 !important;
                box-shadow: 0 10px 15px -3px rgba(209, 61, 124, 0.4) !important;
                transform: translateY(-1px);
            }

            /* BOTÓN "OLVIDÉ MI CONTRASEÑA" Y LINKS */
            /* Apuntamos a los links que están a la par del botón o debajo */
            a.underline, 
            a.text-sm.text-gray-600 {
                color: #6b7280 !important; /* Gris base */
                text-decoration: none !important;
                font-weight: 600 !important;
                transition: color 0.2s !important;
            }

            a.underline:hover, 
            a.text-sm.text-gray-600:hover {
                color: #d13d7c !important; /* Rosa al pasar el mouse */
            }

            /* TRADUCCIÓN FORZADA DE LABELS VÍA CSS (Truco si no quieres editar el JSON) */
            /* Nota: Esto funciona mejor si editas resources/lang/es.json, pero aquí le damos estilo */
            label {
                color: #374151 !important;
                font-weight: 700 !important;
                text-transform: uppercase !important;
                font-size: 0.75rem !important;
                letter-spacing: 0.05em !important;
            }

            /* INPUTS */
            input:focus {
                border-color: #d13d7c !important;
                outline: none !important;
                box-shadow: 0 0 0 3px rgba(209, 61, 124, 0.2) !important;
            }

            /* Checkbox */
            input[type="checkbox"]:checked {
                background-color: #d13d7c !important;
                border-color: #d13d7c !important;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col justify-center items-center pt-6 px-4 sm:pt-0 bg-gradient-to-b from-gray-50 to-gray-200">
            
            <div class="mb-8 transform transition duration-500 hover:scale-105">
                <a href="/" class="flex justify-center">
                    <img src="{{ asset('images/logo.png') }}" 
                         alt="Logo Punto de Venta" 
                         class="w-full max-w-[180px] sm:max-w-[280px] md:max-w-[320px] h-auto object-contain drop-shadow-xl">
                </a>
            </div>

            <div class="w-full sm:max-w-md bg-white shadow-[0_20px_50px_rgba(0,0,0,0.1)] overflow-hidden rounded-3xl border-t-[10px] border-[#d13d7c]">
                <div class="px-8 py-10">
                    @php
                        // Este pequeño truco traduce los textos si no tienes el archivo JSON de español configurado aún
                        $slot = str_replace('Email', 'Correo Electrónico', $slot);
                        $slot = str_replace('Password', 'Contraseña', $slot);
                        $slot = str_replace('Remember me', 'Recordarme', $slot);
                        $slot = str_replace('Forgot your password?', '¿Olvidaste tu contraseña?', $slot);
                        $slot = str_replace('Log in', 'Iniciar Sesión', $slot);
                    @endphp

                    <div class="space-y-6">
                        {!! $slot !!}
                    </div>
                </div>
            </div>

            <div class="mt-8 text-center">
                <p class="text-gray-500 text-sm font-medium uppercase tracking-widest">
                    &copy; {{ date('Y') }} {{ config('app.name', 'Punto de Venta') }}
                </p>
                <p class="text-gray-400 text-xs mt-1">Acceso Seguro al Sistema</p>
            </div>
        </div>
    </body>
</html>