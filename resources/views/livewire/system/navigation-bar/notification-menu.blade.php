<li
    x-data="{ open: false }"
    x-bind:class="{ 'show' : open }"
    wire:init="loadNotifications"
    class="nav-item dropdown">
    <a x-on:click="() => { open=true; Livewire.emit('refreshNotifications'); }" x-bind:aria-expanded="{ 'true' : open, 'false' : !open }" class="nav-link" data-toggle="dropdown" href="#">
        <i class="far fa-bell"></i>
        @if ($loaded && count($notifications) > 0)
            <span class="badge badge-warning navbar-badge">
                {{ count($notifications) > 9 ? '9+' : count($notifications) }}
            </span>
        @endif
    </a>

    <div
        x-show="open"
        x-bind:class="{ 'show' : open }"
        x-on:click.away="open = false"
        x-cloak
        x-transition.scale.origin.top
        class="dropdown-menu dropdown-menu-xl dropdown-menu-right" style="left: inherit; right: 0px;">
        <h6 class="dropdown-item dropdown-header">{{ __('Notifications') }}</h6>
        <div class="dropdown-divider"></div>
        @if ($loaded)
            @forelse ($notifications as $notification)
                <a href="{{ route('profile.notifications.show', $notification['id']) }}" class="dropdown-item">
                    <div class="row">
                        <div class="col-9">
                            <h6 class="text-bold text-truncate">{{ $notification['data']['title'] }}</h6>
                        </div>
                        <div class="col-3">
                            <span class="float-right text-muted text-sm">{{ $notification['human_readable_created_at'] }}</span>
                        </div>
                    </div>
                    <span class="text-xs text-truncate">
                        {{ $notification['data']['message'] ?? '' }}
                    </span>
                </a>
                <div class="dropdown-divider"></div>
            @empty
                <span href="#" class="dropdown-item disabled text-center text-sm">
                    {{ __('No notifications found') }}
                </span>
            @endforelse
        @else
            <span href="#" class="dropdown-item disabled text-center">
                <i class="fas fa-circle-notch fa-spin"></i>
            </span>
        @endif
        {{-- <div class="dropdown-divider"></div>
        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a> --}}
    </div>
</li>