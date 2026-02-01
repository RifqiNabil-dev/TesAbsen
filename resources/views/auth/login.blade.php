@extends('layouts.auth')

@section('title', 'Login')

@section('content')
    <main class="relative min-h-screen w-full bg-white">
        <div class="p-6" x-data="app">

            <header class="flex w-full justify-between">
                <div class="flex items-center">
                    <img src="{{ asset('img/logo_instansi.png') }}" alt="Logo" class="h-12 w-auto object-contain">
                </div>

                <div>
                    <button type="button" @click="isLoginPage = false" x-show="isLoginPage"
                        class="rounded-2xl border-b-2 border-b-gray-300 bg-white px-6 py-2 font-bold text-blue-600 ring-2 ring-gray-200 hover:shadow-md transition-all duration-200">
                        MASUK
                    </button>

                    <button type="button" @click="isLoginPage = true" x-show="!isLoginPage"
                        class="rounded-2xl border-b-2 border-b-gray-300 bg-white px-6 py-2 font-bold text-blue-600 ring-2 ring-gray-200 hover:shadow-md transition-all duration-200">
                        DAFTAR
                    </button>
                </div>
            </header>

            <!-- LOGIN FORM -->
            <div x-show="!isLoginPage"
                class="absolute left-1/2 top-1/2 mx-auto w-full max-w-sm -translate-x-1/2 -translate-y-1/2 space-y-4 text-center">
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf
                    <header class="mb-3 text-2xl font-bold text-gray-800">Masuk ke Akun Anda</header>
                    <p class="text-sm text-gray-500 mb-6">Silakan masukkan kredensial Anda untuk melanjutkan ke dashboard.
                    </p>

                    <div
                        class="w-full rounded-2xl bg-gray-50 px-4 ring-2 ring-gray-200 focus-within:ring-blue-500 transition-all duration-300">
                        <input type="email" name="email" value="{{ old('email') }}" required
                            class="my-3 w-full bg-transparent outline-none text-gray-700 placeholder-gray-400"
                            placeholder="Alamat Email">
                    </div>

                    <div
                        class="flex w-full items-center space-x-2 rounded-2xl bg-gray-50 px-4 ring-2 ring-gray-200 focus-within:ring-blue-500 transition-all duration-300">
                        <input type="password" name="password" required
                            class="my-3 w-full bg-transparent outline-none text-gray-700 placeholder-gray-400"
                            placeholder="Kata Sandi">
                    </div>

                    <button type="submit"
                        class="w-full rounded-2xl border-b-4 border-b-blue-600 bg-blue-600 py-3 font-bold text-white shadow-lg hover:bg-blue-700 hover:border-b-blue-700 active:border-b-0 active:translate-y-1 transition-all duration-200">
                        MASUK
                    </button>

                    <p class="text-xs text-gray-400 mt-4">
                        Lupa kata sandi? Hubungi administrator.
                    </p>
                </form>
            </div>

            <!-- REGISTER FORM -->
            <div x-show="isLoginPage"
                class="absolute left-1/2 top-1/2 mx-auto w-full max-w-sm -translate-x-1/2 -translate-y-1/2 space-y-4 text-center"
                style="display: none;">
                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf
                    <header class="mb-2 text-2xl font-bold text-gray-800">Buat Akun Baru</header>
                    <p class="text-xs text-gray-500 mb-4">Lengkapi data diri Anda untuk memulai magang di Dispussipda
                        Malang.</p>

                    <div
                        class="w-full rounded-2xl bg-gray-50 px-4 ring-2 ring-gray-200 focus-within:ring-blue-500 transition-all duration-300">

                        <input type="text" name="name" required placeholder="Nama Lengkap"
                            class="my-3 w-full bg-transparent outline-none text-gray-700 placeholder-gray-400">
                    </div>

                    <div
                        class="w-full rounded-2xl bg-gray-50 px-4 ring-2 ring-gray-200 focus-within:ring-blue-500 transition-all duration-300">
                        <input type="email" name="email" required placeholder="Alamat Email"
                            class="my-3 w-full bg-transparent outline-none text-gray-700 placeholder-gray-400">
                    </div>

                    <div
                        class="w-full rounded-2xl bg-gray-50 px-4 ring-2 ring-gray-200 focus-within:ring-blue-500 transition-all duration-300">
                        <input type="tel" name="phone_number" required placeholder="Nomor WhatsApp"
                            class="my-3 w-full bg-transparent outline-none text-gray-700 placeholder-gray-400">
                    </div>

                    <div
                        class="w-full rounded-2xl bg-gray-50 px-4 ring-2 ring-gray-200 focus-within:ring-blue-500 transition-all duration-300">
                        <input type="password" name="password" required placeholder="Kata Sandi"
                            class="my-3 w-full bg-transparent outline-none text-gray-700 placeholder-gray-400">
                    </div>

                    <div
                        class="w-full rounded-2xl bg-gray-50 px-4 ring-2 ring-gray-200 focus-within:ring-blue-500 transition-all duration-300">
                        <input type="password" name="password_confirmation" required placeholder="Konfirmasi Kata Sandi"
                            class="my-3 w-full bg-transparent outline-none text-gray-700 placeholder-gray-400">
                    </div>

                    <button type="submit"
                        class="w-full rounded-2xl border-b-4 border-b-blue-600 bg-blue-600 py-3 font-bold text-white shadow-lg hover:bg-blue-700 hover:border-b-blue-700 active:border-b-0 active:translate-y-1 transition-all duration-200">
                        DAFTAR SEKARANG
                    </button>
                </form>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("app", () => ({
                isLoginPage: false
            }));
        });
    </script>

    {{-- <div class="h-screen flex flex-col overflow-hidden">

        <!-- CONTENT -->
        <div class="flex-1 flex items-center justify-center" x-data="app">

            <div class="w-full max-w-sm space-y-4 text-center p-6">

                <header class="flex w-full justify-between">
                    <svg class="h-7 w-7 cursor-pointer text-gray-400 hover:text-gray-300" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path stroke-width="1" fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>

                    <div>
                        <button type="button" @click="isLoginPage = false" x-show="isLoginPage"
                            class="rounded-2xl border-b-2 border-b-gray-300 bg-white px-4 py-3 font-bold text-blue-500 ring-2 ring-gray-300">
                            LOGIN
                        </button>

                        <button type="button" @click="isLoginPage = true" x-show="!isLoginPage"
                            class="rounded-2xl border-b-2 border-b-gray-300 bg-white px-4 py-3 font-bold text-blue-500 ring-2 ring-gray-300">
                            SIGN UP
                        </button>
                    </div>
                </header>

                <!-- FORM -->
                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- REGISTER -->
                    <div x-show="isLoginPage" class="space-y-4">
                        <header class="mb-3 text-2xl font-bold">Create your profile</header>

                        <div class="w-full rounded-2xl bg-gray-50 px-4 ring-2 ring-gray-200">
                            <input type="email" placeholder="Email" class="my-3 w-full bg-transparent outline-none">
                        </div>

                        <div class="w-full rounded-2xl bg-gray-50 px-4 ring-2 ring-gray-200">
                            <input type="password" placeholder="Password" class="my-3 w-full bg-transparent outline-none">
                        </div>

                        <button type="button"
                            class="w-full rounded-2xl border-b-4 border-b-blue-600 bg-blue-500 py-3 font-bold text-white">
                            CREATE ACCOUNT
                        </button>
                    </div>

                    <!-- LOGIN -->
                    <div x-show="!isLoginPage" class="space-y-4">
                        <header class="mb-3 text-2xl font-bold">Log in</header>

                        <div class="w-full rounded-2xl bg-gray-50 px-4 ring-2 ring-gray-200">
                            <input type="email" name="email" value="{{ old('email') }}" required
                                class="my-3 w-full bg-transparent outline-none" placeholder="Email">
                        </div>

                        <div class="flex w-full items-center space-x-2 rounded-2xl bg-gray-50 px-4 ring-2 ring-gray-200">
                            <input type="password" name="password" required class="my-3 w-full bg-transparent outline-none"
                                placeholder="Password">
                            <a href="#" class="font-medium text-gray-400 hover:text-gray-500">
                                FORGOT?
                            </a>
                        </div>

                        <button type="submit"
                            class="w-full rounded-2xl border-b-4 border-b-blue-600 bg-blue-500 py-3 font-bold text-white">
                            LOG IN
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("alpine:init", () => {
            Alpine.data("app", () => ({
                isLoginPage: false
            }));
        });
    </script> --}}

@endsection




{{-- <div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="bi bi-box-arrow-in-right"></i> Login</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="password" name="password" required>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Ingat saya</label>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> --}}