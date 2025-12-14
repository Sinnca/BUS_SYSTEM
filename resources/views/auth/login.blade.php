<x-guest-layout>

    <!-- Header -->
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold tracking-wide text-white">
            Welcome Back
        </h1>
        <p class="mt-2 text-base text-indigo-300">
            Sign in to continue your journey
        </p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status
        class="mb-6 text-indigo-300"
        :status="session('status')" />

    <form method="POST" action="{{ route('login') }}"
          class="space-y-7">
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
                       text-white placeholder-indigo-400
                       text-base
                       focus:ring-2 focus:ring-indigo-500
                       focus:border-indigo-500"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
                autocomplete="username"
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2 text-sm text-red-400" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label
                for="password"
                value="Password"
                class="text-sm text-indigo-300 mb-2"
            />

            <x-text-input
                id="password"
                class="block w-full h-12 rounded-xl
                       bg-[#0f1630] border border-indigo-500/30
                       text-white placeholder-indigo-400
                       text-base
                       focus:ring-2 focus:ring-indigo-500
                       focus:border-indigo-500"
                type="password"
                name="password"
                required
                autocomplete="current-password"
            />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2 text-sm text-red-400" />
        </div>

        <!-- Options -->
        <div class="flex items-center justify-between text-sm pt-1">
            <label for="remember_me"
                   class="inline-flex items-center gap-2 text-indigo-200">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-indigo-500/40
                           bg-[#0f1630] text-indigo-500
                           focus:ring-indigo-500"
                    name="remember"
                >
                Remember me
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                   class="text-indigo-400 hover:text-indigo-300 hover:underline">
                    Forgot password?
                </a>
            @endif
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
                Log in
            </x-primary-button>
        </div>

    </form>

</x-guest-layout>
