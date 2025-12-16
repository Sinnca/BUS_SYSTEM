<section>
    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="form-group-custom">
            <label for="update_password_current_password" class="form-label-custom">Current Password</label>
            <input 
                id="update_password_current_password" 
                name="current_password" 
                type="password" 
                class="form-input-custom" 
                autocomplete="current-password"
                placeholder="Enter your current password"
            />
            @error('current_password', 'updatePassword')
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group-custom">
            <label for="update_password_password" class="form-label-custom">New Password</label>
            <input 
                id="update_password_password" 
                name="password" 
                type="password" 
                class="form-input-custom" 
                autocomplete="new-password"
                placeholder="Enter your new password"
            />
            @error('password', 'updatePassword')
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group-custom">
            <label for="update_password_password_confirmation" class="form-label-custom">Confirm Password</label>
            <input 
                id="update_password_password_confirmation" 
                name="password_confirmation" 
                type="password" 
                class="form-input-custom" 
                autocomplete="new-password"
                placeholder="Confirm your new password"
            />
            @error('password_confirmation', 'updatePassword')
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i>
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="action-row">
            <button type="submit" class="btn-save">
                <i class="fas fa-save"></i>
                Save Changes
            </button>

            @if (session('status') === 'password-updated')
                <span
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="success-message"
                >
                    <i class="fas fa-check-circle"></i>
                    Password updated successfully!
                </span>
            @endif
        </div>
    </form>
</section>