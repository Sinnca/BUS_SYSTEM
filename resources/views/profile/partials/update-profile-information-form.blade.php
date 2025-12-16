<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="form-group-custom">
            <label for="name" class="form-label-custom">Name</label>
            <input 
                id="name" 
                name="name" 
                type="text" 
                class="form-input-custom" 
                value="{{ old('name', $user->name) }}" 
                required 
                autofocus 
                autocomplete="name"
            />
            @error('name')
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group-custom">
            <label for="email" class="form-label-custom">Email</label>
            <input 
                id="email" 
                name="email" 
                type="email" 
                class="form-input-custom" 
                value="{{ old('email', $user->email) }}" 
                required 
                autocomplete="username"
            />
            @error('email')
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="verification-alert">
                    <i class="fas fa-info-circle"></i>
                    Your email address is unverified.
                    <button form="send-verification">
                        Click here to re-send the verification email.
                    </button>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <div class="verification-success">
                        <i class="fas fa-check-circle"></i>
                        A new verification link has been sent to your email address.
                    </div>
                @endif
            @endif
        </div>

        <div class="action-row">
            <button type="submit" class="btn-save">
                <i class="fas fa-save"></i>
                Save Changes
            </button>

            @if (session('status') === 'profile-updated')
                <span
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="success-message"
                >
                    <i class="fas fa-check-circle"></i>
                    Saved successfully!
                </span>
            @endif
        </div>
    </form>
</section>