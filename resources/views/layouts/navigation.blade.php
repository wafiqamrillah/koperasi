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
                <div class="nav-link" data-toggle="dropdown" :aria-expanded="!toggled" @click.prevent="toggle">
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
        <!-- User Menu -->
        <x-splade-toggle>
            <li class="nav-item dropdown user-menu">
                <div class="nav-link" data-toggle="dropdown" :aria-expanded="!toggled" @click.prevent="toggle">
                    <img src="https://placeimg.com/80/80/people" class="user-image img-circle elevation-2" alt="User Image" />
                    <span class="d-none d-md-inline">
                        {{ auth()->user()->name }}
                    </span>
                </div>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;" :class="{ 'show' : toggled }">
                    <li class="user-header bg-primary">
                        <img src="https://placeimg.com/80/80/people" class="img-circle elevation-2" alt="User Image">
                        <p>
                            <span class="text-sm">{{ auth()->user()->name }}</span>
                            <small>Web Developer</small>
                            <small>Member since Nov. 2012</small>
                        </p>
                    </li>
                    
                    <li class="user-footer">
                        <Link href="{{ route('profile.edit') }}" class="btn btn-default btn-flat">
                            {{ __('Profile') }}
                        </Link>
                        <form action="{{ route('logout') }}" method="POST" class="float-right">
                            @csrf
                            
                            <Link href="{{ route('logout') }}" class="btn btn-default btn-flat" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </Link>
                        </form>
                    </li>
                </ul>
            </li>
        </x-splade-toggle>
    </ul>
</nav>