@extends('layout.layout')

@section('content')
    <div class="container mt-4">
        <h1>Notifications</h1>
        @forelse(auth()->user()->notifications()->latest()->get() as $notification)
            <div class="card mb-2 {{ $notification->read ? '' : 'border-primary' }}">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="d-flex align-items-start">
                            <img src="{{ $notification->actor->image }}" alt="{{ $notification->actor->name }}" width="40" height="40" class="rounded-circle me-2 object-fit-cover">
                            <div>
                                <strong>{{ $notification->actor->name }}</strong>
                                @if($notification->type === 'like')
                                    <p>liked your post</p>
                                @elseif($notification->type === 'follow')
                                    <p>started following you</p>
                                @elseif($notification->type === 'comment')
                                    <p>commented on your post</p>
                                @endif
                                <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        @if(!$notification->read)
                            <form action="{{ route('dashboard.notifications.mark-as-read', $notification) }}" method="POST" style="display:inline;">
                                @csrf
                                <button class="btn btn-sm btn-outline-primary">Mark as read</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">No notifications yet.</p>
        @endforelse
    </div>
@endsection