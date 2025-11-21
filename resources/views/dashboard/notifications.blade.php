@extends('layout.layout')

@section('content')
    <main class="w-100 py-3" style="margin-left: 240px;">
        <div class="mx-auto" style="max-width: 600px;">
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
                            <figure class="mb-0 position-relative">
                                @if ($notification->type === 'like' || $notification->type === 'comment')
                                    <img src="{{ $notification->post->image }}" alt="Post image" width="80" height="80" class="rounded-1 object-fit-cover">
                                @else    
                                    <img src="{{ auth()->user()->image }}" alt="User image" width="80" height="80" class="rounded-circle object-fit-cover">
                                @endif
                                
                                @if($notification->type === 'like')
                                    <i class="bi bi-heart-fill px-2 py-1 rounded-circle bg-danger position-absolute" style="bottom: -15px; left: -15px;"></i>
                                @elseif($notification->type === 'follow')
                                    <i class="bi bi-person-plus-fill px-2 py-1 rounded-circle bg-body border border-1 position-absolute" style="bottom: -15px; left: -15px;"></i>
                                @elseif($notification->type === 'comment')
                                    <i class="bi bi-chat-fill px-2 py-1 rounded-circle bg-body border border-1 position-absolute" style="bottom: -15px; left: -15px;"></i>
                                @endif
                            </figure>
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-muted">No notifications yet.</p>
            @endforelse
        </div>
    </main>
@endsection