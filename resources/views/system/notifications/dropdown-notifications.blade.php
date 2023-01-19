<span class="dropdown-item dropdown-header">
    {{ $totalUnreadNotifications }} Notifications
</span>
@forelse ($unreadNotifications as $notification)
    <div class="dropdown-divider"></div>
    <Link href="#" class="dropdown-item">
        Notification
        <span class="float-right text-muted text-sm">
            Times
        </span>
    </Link>
    @empty
    <div class="dropdown-divider"></div>
    <p class="my-2 text-center text-xs">
        {{ __('There is no notification') }}
    </p>
@endforelse