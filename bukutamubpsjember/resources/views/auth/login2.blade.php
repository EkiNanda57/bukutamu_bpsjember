<!DOCTYPE html>
<html lang="id" class="h-full bg-blue-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BPS Kabupaten Jember</title>
    {{-- Pastikan Anda sudah mengintegrasikan Vite/CSS --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {background: linear-gradient(
                135deg, 
                #37e31d87 0%,
                #ff74177d 50%,    
                #119bdb81 100%   
            );
        }
    </style>
</head>
<body class="h-full">
    <div class="flex min-h-full items-center justify-center p-4 sm:p-6 lg:p-8">

        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl overflow-hidden p-8 sm:p-12">

            <div class="mx-auto w-full">
                <img class="mx-auto h-16 w-auto" src="{{ asset('logo/logo-bps.png') }}" alt="Logo BPS">
                <h2 class="mt-6 text-center text-2xl font-bold tracking-tight text-gray-900">
                    BPS Kabupaten Jember
                </h2>
            </div>

            <div class="mt-10">
                <form action="{{ route('login') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="username" class="sr-only">Username</label>
                        <input id="username" name="username" type="text" autocomplete="username" required
                               class="relative block w-full appearance-none rounded-md border border-gray-300 px-3 py-3 ..."
                               placeholder="Enter Username" value="{{ old('username') }}">
                    </div>
                    <div>
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                               class="relative block w-full appearance-none rounded-md border border-gray-300 px-3 py-3 ..."
                               placeholder="Password">
                    </div>

                    @error('username')
                        <div class="mb-4 rounded-md bg-red-50 p-4">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div class="ml-3">
                                    <h3 class="text-sm font-medium text-red-800">{{ $message }}</h3>
                                </div>
                            </div>
                        </div>
                    @enderror

                    <div>
                        <button type="submit" class="group relative flex w-full justify-center rounded-md border border-transparent bg-blue-600 py-3 px-4 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Login
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</body>
</html>


