<section>
    <header class="mb-4">
        <h2 class="text-white h5 fw-bold">
            {{ __('Profile Information') }}
        </h2>

        <p class="text-muted small">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="mb-4 d-flex align-items-center gap-4">
            <img src="{{ $user->avatar_url }}" alt="Profile Avatar" class="rounded-circle border border-2 border-primary" width="80" height="80" style="object-fit: cover;">
            <div>
                <label for="avatar" class="form-label text-muted small fw-semibold text-uppercase tracking-wider">{{ __('Change Avatar') }}</label>
                <input class="form-control bg-darker border-secondary border-opacity-50 text-white form-control-sm @error('avatar') is-invalid @enderror" id="avatar" name="avatar" type="file" accept="image/*">
                @error('avatar')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if($user->avatar)
                    <button type="button" class="btn btn-link btn-sm text-danger mt-1 p-0 text-decoration-none" data-bs-toggle="modal" data-bs-target="#deleteAvatarModal">
                        {{ __('Remove Avatar') }}
                    </button>
                @endif
            </div>
        </div>

        <div class="mb-4">
            <label for="name" class="form-label text-muted small fw-semibold text-uppercase tracking-wider">{{ __('Name') }}</label>
            <input type="text" class="form-control bg-darker border-secondary border-opacity-50 text-white @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="form-label text-muted small fw-semibold text-uppercase tracking-wider">{{ __('Email') }}</label>
            <input type="email" class="form-control bg-darker border-secondary border-opacity-50 text-white @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm mt-2 text-warning">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="btn btn-link p-0 text-decoration-none text-info">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-success small">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-4 mt-4 pt-3 border-top border-secondary border-opacity-25">
            <button type="submit" class="btn btn-primary rounded-pill px-4">{{ __('Save Changes') }}</button>

            @if (session('status') === 'profile-updated')
                <p class="text-success small mb-0 fw-semibold fade show">
                    <i class="bi bi-check-circle me-1"></i> {{ __('Saved successfully.') }}
                </p>
            @endif
        </div>
    </form>

    @if($user->avatar)
    <!-- Delete Avatar Modal -->
    <div class="modal fade" id="deleteAvatarModal" tabindex="-1" aria-labelledby="deleteAvatarModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content bg-darker border-secondary border-opacity-25">
                <form method="post" action="{{ route('profile.avatar.destroy') }}">
                    @csrf
                    @method('delete')
                    <div class="modal-header border-secondary border-opacity-25">
                        <h5 class="modal-title h6 text-white" id="deleteAvatarModalLabel">{{ __('Remove Avatar') }}</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-muted small">
                        {{ __('Are you sure you want to remove your custom profile picture?') }}
                    </div>
                    <div class="modal-footer border-secondary border-opacity-25 p-2">
                        <button type="button" class="btn btn-sm btn-outline-secondary" data-bs-dismiss="modal">{{ __('Cancel') }}</button>
                        <button type="submit" class="btn btn-sm btn-danger">{{ __('Remove') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</section>
