

<?php $__env->startSection('title', 'Login'); ?>

<?php $__env->startSection('content'); ?>
    <main class="relative min-h-screen w-full bg-white">
        <div class="p-6" x-data="app">

            <header class="flex w-full justify-between">
                <div class="flex items-center">
                    <img src="<?php echo e(asset('img/logo_instansi.png')); ?>" alt="Logo" class="h-12 w-auto object-contain">
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
                <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-4">
                    <?php echo csrf_field(); ?>
                    <header class="mb-3 text-2xl font-bold text-gray-800">Masuk ke Akun Anda</header>
                    <p class="text-sm text-gray-500 mb-6">Silakan masukkan kredensial Anda untuk melanjutkan ke dashboard.
                    </p>

                    <div
                        class="w-full rounded-2xl bg-gray-50 px-4 ring-2 ring-gray-200 focus-within:ring-blue-500 transition-all duration-300">
                        <input type="email" name="email" value="<?php echo e(old('email')); ?>" required
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
                <form method="POST" action="<?php echo e(route('register')); ?>" class="space-y-4">
                    <?php echo csrf_field(); ?>
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

    

<?php $__env->stopSection(); ?>





<?php echo $__env->make('layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\Si-Magang\resources\views/auth/login.blade.php ENDPATH**/ ?>