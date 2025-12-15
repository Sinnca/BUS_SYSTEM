<x-guest-layout>

    <!-- Header -->
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold tracking-wide text-white">
            Reset Your Password
        </h1>
        <p class="mt-3 text-base text-indigo-300 leading-relaxed">
            Forgot your password? No worries.  
            Enter your email and we’ll send you a reset link.
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status
        class="mb-6 text-indigo-300"
        :status="session('status')" />

    <form method="POST"
          action="{{ route('password.email') }}"
          class="space-y-1">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label
                for="email"
                value="Email Address"
                class="text-sm text-indigo-300 mb-2"
            />

            <x-text-input
                id="email"
                class="block w-full h-12 rounded-xl
                       bg-[#0f1630] border border-indigo-500/30
                       text-white placeholder-indigo-400 text-base
                       focus:ring-2 focus:ring-indigo-500
                       focus:border-indigo-500"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2 text-sm text-red-400" />
        </div>

        <!-- CTA -->
        <div class="pt-4">
            <x-primary-button
                class="w-full h-12 text-base font-semibold
                       rounded-xl justify-center
                       bg-gradient-to-r from-indigo-500 to-purple-500
                       hover:from-indigo-400 hover:to-purple-400
                       shadow-lg shadow-indigo-500/30
                       transition-all duration-200">
                Email Password Reset Link
            </x-primary-button>
        </div>

        <!-- Back to Login -->
        <div class="text-center pt-2">
            <a href="{{ route('login') }}"
               class="text-sm text-indigo-400 hover:text-indigo-300 hover:underline">
                Back to login
            </a>
        </div>

    </form>

</x-guest-layout>
