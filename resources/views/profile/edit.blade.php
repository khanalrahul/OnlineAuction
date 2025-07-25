@extends('layouts.app')

@section('content')
<div class="profile-edit-container">
    <!-- Profile Header -->
    <div class="profile-header">
        <div class="avatar-container">
            @if($user->avatar)
                <img src="{{ asset('storage/avatars/' . $user->avatar) }}" alt="Profile" class="profile-avatar">
            @else
                <div class="avatar-initials">
                    {{ substr($user->name, 0, 1) }}
                </div>
            @endif
        </div>
        <h1 class="user-name">{{ $user->name }}</h1>
        <p class="user-email">{{ $user->email }}</p>
    </div>

    <!-- Profile Sections -->
    <div class="profile-sections">
        <!-- Profile Information Section -->
        <section class="profile-section">
            <div class="section-header">
                <h2>Profile Information</h2>
                <p>Update your account's profile information and email address.</p>
            </div>
            
            <form method="post" action="{{ route('profile.update') }}" class="profile-form">
                @csrf
                @method('patch')
                
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                    
                    @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                        <div class="email-verification">
                            <p>Your email address is unverified.</p>
                            <button form="send-verification" class="verification-link">
                                Click here to re-send the verification email.
                            </button>
                        </div>
                    @endif
                    
                    @if (session('status') === 'profile-updated')
                        <div class="success-message">
                            Profile updated successfully!
                        </div>
                    @endif
                </div>
                
                <button type="submit" class="save-btn">Save Changes</button>
            </form>
        </section>

        <!-- Password Update Section -->
        <section class="profile-section">
            <div class="section-header">
                <h2>Update Password</h2>
                <p>Ensure your account is using a long, random password to stay secure.</p>
            </div>
            
            <form method="post" action="{{ route('password.update') }}" class="profile-form">
                @csrf
                @method('put')
                
                <div class="form-group">
                    <label for="current_password">Current Password</label>
                    <input type="password" id="current_password" name="current_password" required>
                    @error('current_password', 'updatePassword')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" id="password" name="password" required>
                    @error('password', 'updatePassword')
                        <span class="error-message">{{ $message }}</span>
                    @enderror
                </div>
                
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>
                
                @if (session('status') === 'password-updated')
                    <div class="success-message">
                        Password updated successfully!
                    </div>
                @endif
                
                <button type="submit" class="save-btn">Update Password</button>
            </form>
        </section>

        <!-- Account Deletion Section -->
        <section class="profile-section danger-zone">
            <div class="section-header">
                <h2>Delete Account</h2>
                <p>Once your account is deleted, all of its resources and data will be permanently deleted.</p>
            </div>
            
            <button class="delete-btn" id="open-delete-modal">
                Delete Account
            </button>
        </section>
    </div>
</div>

<!-- Delete Account Modal -->
<div class="modal-overlay" id="delete-modal">
    <div class="modal-content">
        <h3>Confirm Account Deletion</h3>
        <p>Are you sure you want to delete your account? This action cannot be undone.</p>
        
        <form method="post" action="{{ route('profile.destroy') }}" class="delete-form">
            @csrf
            @method('delete')
            
            <div class="form-group">
                <label for="delete_password">Enter your password to confirm</label>
                <input type="password" id="delete_password" name="password" required>
                @error('password', 'userDeletion')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="modal-actions">
                <button type="button" class="cancel-btn" id="cancel-delete">Cancel</button>
                <button type="submit" class="confirm-delete-btn">Delete Account</button>
            </div>
        </form>
    </div>
</div>

<style>
    /* Base Styles */
    .profile-edit-container {
        max-width: 800px;
        margin: 2rem auto;
        padding: 0 1.5rem;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
    }

    /* Profile Header */
    .profile-header {
        text-align: center;
        margin-bottom: 3rem;
    }

    .avatar-container {
        margin: 0 auto 1.5rem;
        width: 120px;
        height: 120px;
    }

    .profile-avatar {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #fff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .avatar-initials {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        background: linear-gradient(135deg, #3b82f6, #8b5cf6);
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        font-weight: bold;
        border: 4px solid #fff;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .user-name {
        font-size: 1.8rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #1f2937;
    }

    .user-email {
        font-size: 1.1rem;
        color: #6b7280;
    }

    /* Profile Sections */
    .profile-sections {
        display: grid;
        gap: 2rem;
    }

    .profile-section {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
    }

    .danger-zone {
        border-left: 4px solid #ef4444;
    }

    .section-header {
        margin-bottom: 1.5rem;
    }

    .section-header h2 {
        font-size: 1.4rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #1f2937;
    }

    .section-header p {
        color: #6b7280;
        line-height: 1.5;
    }

    /* Forms */
    .profile-form {
        display: grid;
        gap: 1.5rem;
    }

    .form-group {
        display: grid;
        gap: 0.5rem;
    }

    label {
        font-weight: 500;
        color: #374151;
        font-size: 0.95rem;
    }

    input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.2s;
    }

    input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
    }

    /* Buttons */
    .save-btn {
        background: #3b82f6;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        width: fit-content;
    }

    .save-btn:hover {
        background: #2563eb;
    }

    .delete-btn {
        background: #ef4444;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }

    .delete-btn:hover {
        background: #dc2626;
    }

    /* Messages */
    .error-message {
        color: #ef4444;
        font-size: 0.875rem;
        margin-top: 0.25rem;
    }

    .success-message {
        color: #10b981;
        font-size: 0.875rem;
        margin-top: 0.5rem;
        font-weight: 500;
    }

    .email-verification {
        margin-top: 0.5rem;
        color: #6b7280;
        font-size: 0.875rem;
    }

    .verification-link {
        color: #3b82f6;
        text-decoration: underline;
        background: none;
        border: none;
        padding: 0;
        cursor: pointer;
    }

    /* Modal */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1000;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.3s;
    }

    .modal-overlay.active {
        opacity: 1;
        pointer-events: all;
    }

    .modal-content {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        width: 90%;
        max-width: 500px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        transform: translateY(20px);
        transition: transform 0.3s;
    }

    .modal-overlay.active .modal-content {
        transform: translateY(0);
    }

    .modal-content h3 {
        font-size: 1.25rem;
        font-weight: 600;
        margin-bottom: 1rem;
        color: #1f2937;
    }

    .modal-content p {
        color: #6b7280;
        margin-bottom: 1.5rem;
        line-height: 1.5;
    }

    .modal-actions {
        display: flex;
        gap: 1rem;
        justify-content: flex-end;
        margin-top: 1.5rem;
    }

    .cancel-btn {
        background: #f3f4f6;
        color: #374151;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }

    .cancel-btn:hover {
        background: #e5e7eb;
    }

    .confirm-delete-btn {
        background: #ef4444;
        color: white;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }

    .confirm-delete-btn:hover {
        background: #dc2626;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .profile-edit-container {
            padding: 0 1rem;
        }
        
        .profile-section {
            padding: 1.5rem;
        }
        
        .modal-actions {
            flex-direction: column;
        }
        
        .cancel-btn,
        .confirm-delete-btn {
            width: 100%;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Delete Account Modal
        const deleteModal = document.getElementById('delete-modal');
        const openDeleteBtn = document.getElementById('open-delete-modal');
        const cancelDeleteBtn = document.getElementById('cancel-delete');
        
        openDeleteBtn.addEventListener('click', function() {
            deleteModal.classList.add('active');
        });
        
        cancelDeleteBtn.addEventListener('click', function() {
            deleteModal.classList.remove('active');
        });
        
        // Close modal when clicking outside
        deleteModal.addEventListener('click', function(e) {
            if (e.target === deleteModal) {
                deleteModal.classList.remove('active');
            }
        });
        
        // Password visibility toggle (optional)
        const passwordInputs = document.querySelectorAll('input[type="password"]');
        passwordInputs.forEach(input => {
            const wrapper = document.createElement('div');
            wrapper.className = 'password-input-wrapper';
            input.parentNode.insertBefore(wrapper, input);
            wrapper.appendChild(input);
            
            const toggle = document.createElement('button');
            toggle.type = 'button';
            toggle.className = 'password-toggle';
            toggle.innerHTML = '👁️';
            toggle.addEventListener('click', function() {
                if (input.type === 'password') {
                    input.type = 'text';
                    toggle.innerHTML = '👁️';
                } else {
                    input.type = 'password';
                    toggle.innerHTML = '👁️';
                }
            });
            wrapper.appendChild(toggle);
        });
    });
</script>
@endsection