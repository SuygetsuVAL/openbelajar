@extends('layouts.admin')

@section('header', 'Profile Settings')

@section('content')
<div class="row g-4">
    <div class="col-lg-8">
        <div class="card bg-transparent border-secondary border-opacity-25 rounded-4 shadow-sm mb-4">
            <div class="card-body p-4 p-md-5">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="card bg-transparent border-secondary border-opacity-25 rounded-4 shadow-sm mb-4">
            <div class="card-body p-4 p-md-5">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="card bg-transparent border-danger border-opacity-25 rounded-4 shadow-sm">
            <div class="card-body p-4 p-md-5">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
