<section>
    <header class="mb-4">
        <h2 class="text-danger h5 fw-bold">
            {{ __('Delete Account') }}
        </h2>

        <p class="text-muted small">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button type="button" class="btn btn-outline-danger mt-2" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
        {{ __('Delete Account') }}
    </button>

    <!-- Delete Account Modal -->
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true" {{ $errors->userDeletion->isNotEmpty() ? 'data-bs-show="true"' : '' }}>
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-darker border-secondary border-opacity-25">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')
                    
                    <div class="modal-header border-secondary border-opacity-25">
                        <h5 class="modal-title text-white" id="confirmUserDeletionModalLabel">{{ __('Are you sure you want to delete your account?') }}</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    
                    <div class="modal-body text-muted">
                        <p>
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                        </p>

                        <div class="mt-4">
                            <label for="password" class="form-label sr-only">{{ __('Password') }}</label>
                            <input type="password" class="form-control bg-transparent border-secondary border-opacity-50 text-white @if($errors->userDeletion->has('password')) is-invalid @endif" id="password" name="password" placeholder="{{ __('Password') }}" required>
                            
                            @if($errors->userDeletion->has('password'))
                                <div class="invalid-feedback d-block">{{ $errors->userDeletion->first('password') }}</div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="modal-footer border-secondary border-opacity-25">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-danger">{{ __('Delete Account') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@if ($errors->userDeletion->isNotEmpty())
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var myModal = new bootstrap.Modal(document.getElementById('confirmUserDeletionModal'), {
                keyboard: false
            });
            myModal.show();
        });
    </script>
@endif
