<x-guest-layout>

    <!-- Header -->
    <div class="text-center mb-10">
        <h1 class="text-3xl font-bold tracking-wide text-white">
            Create Your Account
        </h1>
        <p class="mt-2 text-base text-indigo-300">
            Join MoveON and start your journey
        </p>
    </div>

    <form method="POST" action="{{ route('register') }}"
          class="space-y-3">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label
                for="name"
                value="Full Name"
                class="text-sm text-indigo-300 mb-1"
            />

            <x-text-input
                id="name"
                class="block w-full h-12 rounded-xl
                       bg-[#0f1630] border border-indigo-500/30
                       text-white placeholder-indigo-400 text-base
                       focus:ring-2 focus:ring-indigo-500
                       focus:border-indigo-500"
                type="text"
                name="name"
                :value="old('name')"
                required
                autofocus
                autocomplete="name"
            />

            <x-input-error
                :messages="$errors->get('name')"
                class="mt-2 text-sm text-red-400" />
        </div>

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
                       text-white placeholder-indigo-400 text-base
                       focus:ring-2 focus:ring-indigo-500
                       focus:border-indigo-500"
                type="password"
                name="password"
                required
                autocomplete="new-password"
            />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2 text-sm text-red-400" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label
                for="password_confirmation"
                value="Confirm Password"
                class="text-sm text-indigo-300 mb-2"
            />

            <x-text-input
                id="password_confirmation"
                class="block w-full h-12 rounded-xl
                       bg-[#0f1630] border border-indigo-500/30
                       text-white placeholder-indigo-400 text-base
                       focus:ring-2 focus:ring-indigo-500
                       focus:border-indigo-500"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
            />

            <x-input-error
                :messages="$errors->get('password_confirmation')"
                class="mt-2 text-sm text-red-400" />
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between text-sm pt-2">
            <a href="{{ route('login') }}"
               class="text-indigo-400 hover:text-indigo-300 hover:underline">
                Already registered?
            </a>

            <x-primary-button
                class="h-12 px-8 text-base font-semibold
                       rounded-xl justify-center
                       bg-gradient-to-r from-indigo-500 to-purple-500
                       hover:from-indigo-400 hover:to-purple-400
                       shadow-lg shadow-indigo-500/30
                       transition-all duration-200">
                Register
            </x-primary-button>
        </div>

    </form>

</x-guest-layout>
