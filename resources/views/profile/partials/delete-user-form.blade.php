<section>
    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="btn-danger-custom"
    >
        <i class="fas fa-trash-alt"></i>
        Delete Account
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <div class="modal-content-custom">
            <form method="post" action="{{ route('profile.destroy') }}">
                @csrf
                @method('delete')

                <div class="modal-header-custom">
                    <h2>
                        <i class="fas fa-exclamation-triangle"></i>
                        Are you sure you want to delete your account?
                    </h2>
                </div>

                <div class="modal-body-custom">
                    <p>
                        Once your account is deleted, all of its resources and data will be permanently deleted. 
                        Please enter your password to confirm you would like to permanently delete your account.
                    </p>

                    <div class="form-group-custom" style="margin-top: 1.5rem;">
                        <label for="password" class="form-label-custom">Password</label>
                        <input
                            id="password"
                            name="password"
                            type="password"
                            class="form-input-custom"
                            placeholder="Enter your password to confirm"
                        />
                        @error('password', 'userDeletion')
                            <div class="error-message">
                                <i class="fas fa-exclamation-circle"></i>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer-custom">
                    <button 
                        type="button" 
                        class="btn-secondary-custom" 
                        x-on:click="$dispatch('close')"
                    >
                        <i class="fas fa-times"></i>
                        Cancel
                    </button>

                    <button type="submit" class="btn-danger-custom">
                        <i class="fas fa-trash-alt"></i>
                        Delete Account
                    </button>
                </div>
            </form>
        </div>
    </x-modal>
</section>