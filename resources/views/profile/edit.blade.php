@extends('layouts.app')

@section('title', 'My Profile')

@push('styles')
<style>
    /* Profile Container */
    .profile-container {
        margin-top: 2rem;
        margin-bottom: 3rem;
        animation: fadeIn 0.6s ease-out;
    }

    /* Page Header */
    .profile-header {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 20px;
        padding: 2rem 2.5rem;
        margin-bottom: 2.5rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        position: relative;
        overflow: hidden;
        animation: fadeInDown 0.6s ease-out;
    }

    .profile-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #6366f1, #8b5cf6, #a855f7);
    }

    .profile-header h1 {
        color: #ffffff;
        font-size: 2.2rem;
        font-weight: 800;
        margin: 0 0 0.5rem 0;
        letter-spacing: -0.5px;
    }

    .profile-header p {
        color: rgba(255, 255, 255, 0.7);
        margin: 0;
        font-size: 1rem;
    }

    /* Profile Cards */
    .profile-card {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border: 1px solid rgba(139, 92, 246, 0.2);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        transition: all 0.3s ease;
        animation: fadeInUp 0.6s ease-out;
        animation-fill-mode: both;
    }

    .profile-card:nth-child(1) {
        animation-delay: 0.1s;
    }

    .profile-card:nth-child(2) {
        animation-delay: 0.2s;
    }

    .profile-card:nth-child(3) {
        animation-delay: 0.3s;
    }

    .profile-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
    }

    /* Card Headers */
    .card-header-custom {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 1.5rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid rgba(139, 92, 246, 0.2);
    }

    .card-header-custom h5 {
        color: #ffffff;
        font-size: 1.3rem;
        font-weight: 700;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .card-header-custom i {
        color: #8b5cf6;
        font-size: 1.2rem;
    }

    .card-header-custom.danger h5 {
        color: #ef4444;
    }

    .card-header-custom.danger i {
        color: #ef4444;
    }

    .card-description {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.9rem;
        margin-top: 0.5rem;
        line-height: 1.6;
    }

    /* Form Groups */
    .form-group-custom {
        margin-bottom: 1.5rem;
    }

    .form-label-custom {
        color: rgba(255, 255, 255, 0.9);
        font-weight: 600;
        font-size: 0.95rem;
        margin-bottom: 0.5rem;
        display: block;
    }

    /* Input Fields */
    .form-input-custom {
        background: rgba(99, 102, 241, 0.08);
        border: 1px solid rgba(139, 92, 246, 0.3);
        border-radius: 10px;
        color: white !important;
        padding: 0.75rem 1rem;
        font-size: 0.95rem;
        font-weight: 500;
        transition: all 0.3s ease;
        width: 100%;
    }

    .form-input-custom:focus {
        outline: none;
        border-color: #a855f7;
        background: rgba(99, 102, 241, 0.12);
        box-shadow: 0 0 0 3px rgba(168, 85, 247, 0.1);
        color: white !important;
    }

    .form-input-custom::placeholder {
        color: rgba(255, 255, 255, 0.4) !important;
    }

    /* Autofill fix */
    .form-input-custom:-webkit-autofill,
    .form-input-custom:-webkit-autofill:hover,
    .form-input-custom:-webkit-autofill:focus {
        -webkit-text-fill-color: white !important;
        -webkit-box-shadow: 0 0 0 1000px rgba(99, 102, 241, 0.12) inset !important;
        box-shadow: 0 0 0 1000px rgba(99, 102, 241, 0.12) inset !important;
        transition: background-color 5000s ease-in-out 0s;
    }

    /* Error Messages */
    .error-message {
        color: #f87171;
        font-size: 0.85rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .error-message i {
        font-size: 0.75rem;
    }

    /* Success Messages */
    .success-message {
        color: #10b981;
        font-size: 0.9rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        animation: fadeIn 0.3s ease-out;
    }

    /* Buttons */
    .btn-save {
        background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(99, 102, 241, 0.6);
        background: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%);
        color: white;
    }

    .btn-danger-custom {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: white;
        border: none;
        padding: 0.75rem 2rem;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.95rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4);
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-danger-custom:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(239, 68, 68, 0.6);
        background: linear-gradient(135deg, #dc2626 0%, #b91c1c 100%);
        color: white;
    }

    .btn-secondary-custom {
        background: rgba(100, 116, 139, 0.2);
        color: white;
        border: 1px solid rgba(100, 116, 139, 0.3);
        padding: 0.75rem 2rem;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.95rem;
        transition: all 0.3s ease;
    }

    .btn-secondary-custom:hover {
        background: rgba(100, 116, 139, 0.3);
        color: white;
        border-color: rgba(100, 116, 139, 0.5);
        transform: translateY(-2px);
    }

    /* Action Row */
    .action-row {
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
        margin-top: 1.5rem;
    }

    /* Email Verification Alert */
    .verification-alert {
        background: rgba(245, 158, 11, 0.1);
        border: 1px solid rgba(245, 158, 11, 0.3);
        border-radius: 10px;
        padding: 1rem;
        margin-top: 0.75rem;
        color: #fbbf24;
        font-size: 0.9rem;
    }

    .verification-alert button {
        color: #fbbf24;
        text-decoration: underline;
        background: none;
        border: none;
        padding: 0;
        font-weight: 600;
        cursor: pointer;
        transition: color 0.3s ease;
    }

    .verification-alert button:hover {
        color: #f59e0b;
    }

    .verification-success {
        background: rgba(16, 185, 129, 0.1);
        border: 1px solid rgba(16, 185, 129, 0.3);
        border-radius: 10px;
        padding: 1rem;
        margin-top: 0.75rem;
        color: #10b981;
        font-size: 0.9rem;
        font-weight: 600;
    }

    /* Modal Overlay */
    .modal-overlay {
        background: rgba(0, 0, 0, 0.8);
        backdrop-filter: blur(4px);
    }

    /* Modal Content */
    .modal-content-custom {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border: 2px solid rgba(239, 68, 68, 0.3);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
    }

    .modal-header-custom {
        margin-bottom: 1rem;
    }

    .modal-header-custom h2 {
        color: #ef4444;
        font-size: 1.5rem;
        font-weight: 800;
        margin: 0;
    }

    .modal-body-custom {
        color: rgba(255, 255, 255, 0.8);
        line-height: 1.6;
        margin-bottom: 1.5rem;
    }

    .modal-footer-custom {
        display: flex;
        justify-content: flex-end;
        gap: 1rem;
        margin-top: 2rem;
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .profile-container {
            margin-top: 1.5rem;
        }

        .profile-header {
            padding: 1.5rem;
        }

        .profile-header h1 {
            font-size: 1.8rem;
        }

        .profile-card {
            padding: 1.5rem;
        }

        .action-row {
            flex-direction: column;
            align-items: stretch;
        }

        .btn-save,
        .btn-danger-custom,
        .btn-secondary-custom {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
<div class="container profile-container" style="max-width: 980px;">

    <!-- Header -->
    <div class="profile-header text-center">
        <h1>
            <i class="fas fa-user-circle"></i> My Profile
        </h1>
        <p>Manage your account information, security, and preferences</p>
    </div>

    <!-- Profile Info -->
    <div class="profile-card">
        <div class="card-header-custom">
            <h5>
                <i class="fas fa-user"></i>
                Profile Information
            </h5>
        </div>
        <p class="card-description">
            Update your account's profile information and email address.
        </p>
        @include('profile.partials.update-profile-information-form')
    </div>

    <!-- Password -->
    <div class="profile-card">
        <div class="card-header-custom">
            <h5>
                <i class="fas fa-lock"></i>
                Update Password
            </h5>
        </div>
        <p class="card-description">
            Ensure your account is using a long, random password to stay secure.
        </p>
        @include('profile.partials.update-password-form')
    </div>

    <!-- Danger Zone -->
    <div class="profile-card">
        <div class="card-header-custom danger">
            <h5>
                <i class="fas fa-exclamation-triangle"></i>
                Danger Zone
            </h5>
        </div>
        <p class="card-description">
            Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
        </p>
        @include('profile.partials.delete-user-form')
    </div>

</div>
@endsection