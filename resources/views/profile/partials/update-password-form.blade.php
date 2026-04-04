<section>
    <header class="mb-4">
        <h2 class="text-white h5 fw-bold">
            {{ __('Update Password') }}
        </h2>

        <p class="text-muted small">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-4">
        @csrf
        @method('put')

        <div class="mb-4">
            <label for="update_password_current_password" class="form-label text-muted small fw-semibold text-uppercase tracking-wider">{{ __('Current Password') }}</label>
            <input type="password" class="form-control bg-darker border-secondary border-opacity-50 text-white @if($errors->updatePassword->has('current_password')) is-invalid @endif" id="update_password_current_password" name="current_password" autocomplete="current-password">
            @if($errors->updatePassword->has('current_password'))
                <div class="invalid-feedback">{{ $errors->updatePassword->first('current_password') }}</div>
            @endif
        </div>

        <div class="mb-4">
            <label for="update_password_password" class="form-label text-muted small fw-semibold text-uppercase tracking-wider">{{ __('New Password') }}</label>
            <input type="password" class="form-control bg-darker border-secondary border-opacity-50 text-white @if($errors->updatePassword->has('password')) is-invalid @endif" id="update_password_password" name="password" autocomplete="new-password">
            @if($errors->updatePassword->has('password'))
                <div class="invalid-feedback">{{ $errors->updatePassword->first('password') }}</div>
            @endif
        </div>

        <div class="mb-4">
            <label for="update_password_password_confirmation" class="form-label text-muted small fw-semibold text-uppercase tracking-wider">{{ __('Confirm Password') }}</label>
            <input type="password" class="form-control bg-darker border-secondary border-opacity-50 text-white @if($errors->updatePassword->has('password_confirmation')) is-invalid @endif" id="update_password_password_confirmation" name="password_confirmation" autocomplete="new-password">
             @if($errors->updatePassword->has('password_confirmation'))
                <div class="invalid-feedback">{{ $errors->updatePassword->first('password_confirmation') }}</div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-4 mt-4 pt-3 border-top border-secondary border-opacity-25">
            <button type="submit" class="btn btn-primary rounded-pill px-4">{{ __('Update Password') }}</button>

            @if (session('status') === 'password-updated')
                <p class="text-success small mb-0 fw-semibold fade show">
                    <i class="bi bi-shield-check me-1"></i> {{ __('Password saved.') }}
                </p>
            @endif
        </div>
    </form>
</section>
