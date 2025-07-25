@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">All Notifications</h5>
                    <a href="#" class="btn btn-sm btn-outline-primary mark-all-read">
                        Mark all as read
                    </a>
                </div>

                <div class="card-body p-0">
                    @forelse($notifications as $notification)
                        <div class="p-3 border-bottom notification-item {{ $notification->unread() ? 'bg-light' : '' }}" data-id="{{ $notification->id }}">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <i class="bi bi-{{ $notification->data['icon'] ?? 'bell' }}-fill fs-4 text-{{ $notification->data['type'] ?? 'primary' }}"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="d-flex justify-content-between">
                                        <h6 class="mb-1">{{ $notification->data['title'] ?? 'Notification' }}</h6>
                                        <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-1">{{ $notification->data['message'] }}</p>
                                    @if(isset($notification->data['action_url']))
                                        <a href="{{ $notification->data['action_url'] }}" class="btn btn-sm btn-outline-{{ $notification->data['type'] ?? 'primary' }} mt-1">View</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-4 text-center text-muted">
                            No notifications found
                        </div>
                    @endforelse
                </div>

                @if($notifications->hasPages())
                    <div class="card-footer">
                        {{ $notifications->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection