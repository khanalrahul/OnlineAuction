@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="text-center font-semibold text-xl leading-tight mb-4">
            {{ __('Profile') }}
        </h2>

        <!-- Update Profile Information Section -->
        <div class="profile-section">
            <div class="profile-card bg-white shadow rounded-lg p-4 mb-4">
                @include('profile.partials.update-profile-information-form', ['user' => $user])
            </div>
        </div>

        <!-- Update Password Section -->
        <div class="profile-section">
            <div class="profile-card bg-white shadow rounded-lg p-4 mb-4">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Delete User Section -->
        <div class="profile-section">
            <div class="profile-card bg-white shadow rounded-lg p-4 alert alert-warning text-center">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
@endsection
