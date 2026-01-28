

<?php $__env->startSection('title', 'Login'); ?>

<?php $__env->startSection('content'); ?>
        <main class="relative min-h-screen w-full bg-white">
            <div class="p-6" x-data="app">

                <header class="flex w-full justify-between">
                        <span class="text-xl font-bold text-blue-600 tracking-wide cursor-default">
                            Si-Magang
                        </span>

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

                <!-- ❗ FORM WRAPPER DI LUAR -->
                <form method="POST" action="<?php echo e(route('login')); ?>"
                    class="absolute left-1/2 top-1/2 mx-auto w-full max-w-sm -translate-x-1/2 -translate-y-1/2 space-y-4 text-center">
                    <?php echo csrf_field(); ?>

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
                            <input type="email" name="email" value="<?php echo e(old('email')); ?>" required
                                class="my-3 w-full bg-transparent outline-none" placeholder="Email">
                        </div>

                        <div class="flex w-full items-center space-x-2 rounded-2xl bg-gray-50 px-4 ring-2 ring-gray-200">
                            <input type="password" name="password" required
                                class="my-3 w-full bg-transparent outline-none" placeholder="Password">
                            <a href=""
                                class="font-medium text-gray-400 hover:text-gray-500">FORGOT?</a>
                        </div>

                        <button type="submit"
                            class="w-full rounded-2xl border-b-4 border-b-blue-600 bg-blue-500 py-3 font-bold text-white">
                            LOG IN
                        </button>
                    </div>
                </form>
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