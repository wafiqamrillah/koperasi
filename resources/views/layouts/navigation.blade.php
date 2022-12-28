<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <div class="nav-link" href="#" @click.prevent="toggle" role="button">
                <i class="fa-solid fa-bars"></i>
            </div>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <!-- Notifications -->
        <x-splade-toggle>
            <li class="nav-item dropdown">
                <div class="nav-link" data-toggle="dropdown" aria-expanded="true" @click.prevent="toggle">
                    <i class="fa-regular fa-bell"></i>
                    @if (auth()->user()->unreadNotifications->count() > 0)
                    <span class="badge badge-warning navbar-badge">
                        {{ auth()->user()->unreadNotifications->count() <= 9 ? auth()->user()->unreadNotifications->count() : "9+" }}
                    </span>
                    @endif
                </div>
                <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right" :class="{ 'show' : toggled }">
                    <span class="dropdown-item dropdown-header">
                        {{ auth()->user()->unreadNotifications->count() }} Notifications
                    </span>
                    @forelse (auth()->user()->unreadNotifications as $notification)
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
                </div>
            </li>
        </x-splade-toggle>
    </ul>
    {{-- <div class="flex items-center space-x-3">
        <x-dropdown placement="bottom-end" width="96">
            <x-slot name="trigger">
                <button type="button" tabindex="0" class="btn btn-ghost btn-circle">
                    <div class="indicator">
                        <i class="fa-regular fa-bell text-lg"></i>
                        @if (auth()->user()->unreadNotifications->count() > 0)
                        <span class="badge badge-sm badge-primary rounded-full indicator-item text-xs">
                            {{ auth()->user()->unreadNotifications->count() <= 9 ? auth()->user()->unreadNotifications->count() : "9+" }}
                        </span>
                        @endif
                    </div>
                </button>
            </x-slot>
            
            <x-slot name="content">
                <ul class="divide-y divide-gray-200 max-h-[47vh] overflow-hidden overflow-y-auto">
                    @forelse (auth()->user()->unreadNotifications as $notification)
                    <li class="p-4 hover:bg-gray-200 hover:cursor-pointer text-sm text-gray-800">
                        A
                    </li>
                    @empty
                    <li class="p-4 text-center text-sm text-gray-400">
                        {{ __('There is no notification') }}
                    </li>
                    @endforelse
                </ul>
            </x-slot>
        </x-dropdown>
        
        <!-- Profile -->
        <x-dropdown placement="bottom-end">
            <x-slot name="trigger">
                <button type="button" tabindex="0" class="btn btn-ghost btn-circle avatar online">
                    <div class="w-10 rounded-full">
                        <img src="https://placeimg.com/80/80/people" />
                    </div>
                </button>
            </x-slot>
            
            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-dropdown-link>
                
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    
                    <x-dropdown-link as="a" :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    </div> --}}
</nav>