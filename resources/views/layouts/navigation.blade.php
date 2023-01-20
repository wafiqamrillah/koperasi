<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <ul class="navbar-nav">
        <li class="nav-item">
            <div class="nav-link" href="#" @click.prevent="data.collapse = !data.collapse" role="button">
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
                    {{-- @if (auth()->user()->unreadNotifications->count() > 0)
                    <span class="badge badge-warning navbar-badge">
                        {{ auth()->user()->unreadNotifications->count() <= 9 ? auth()->user()->unreadNotifications->count() : "9+" }}
                    </span>
                    @endif --}}
                </div>
                <div class="dropdown-menu dropdown-menu-xl dropdown-menu-right" :class="{ 'show' : toggled }">
                    <x-splade-lazy url="{{ route('notifications.get') }}">
                        <x-slot::placeholder>
                            <span class="dropdown-item dropdown-header">
                                <i class="fa-solid fa-circle-notch fa-spin"></i> Loading...
                            </span>
                        </x-slot::placeholder>
                    </x-splade-lazy>
                </div>
            </li>
        </x-splade-toggle>
        
        <!-- User Menu -->
        <x-splade-toggle>
            <li class="nav-item dropdown user-menu">
                <div class="nav-link" data-toggle="dropdown" :aria-expanded="!toggled" @click.prevent="toggle">
                    <img src="{{ auth()->user()->profile_photo_url }}" class="user-image img-circle elevation-2" alt="User Image" />
                    <span class="d-none d-md-inline">
                        {{ auth()->user()->name }}
                    </span>
                </div>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;" :class="{ 'show' : toggled }" @click.prevent="toggle">
                    <li class="user-header bg-primary">
                        <img src="{{ auth()->user()->profile_photo_url }}" class="img-circle elevation-2" alt="User Image">
                        <p>
                            <span class="text-sm">{{ auth()->user()->name }}</span>
                            <small>Web Developer</small>
                            <small>Member since Nov. 2012</small>
                        </p>
                    </li>
                    
                    <li class="user-footer">
                        <Link href="{{ route('profile.edit') }}">
                            <button type="button" class="btn btn-default">
                                {{ __('Profile') }}
                            </button>
                        </Link>
                        <form action="{{ route('logout') }}" method="POST" class="float-right">
                            @csrf
                            
                            <Link href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                                <button type="button" class="btn btn-default">
                                    {{ __('Log Out') }}
                                </button>
                            </Link>
                        </form>
                    </li>
                </ul>
            </li>
        </x-splade-toggle>

        <!-- Settings -->
        <li class="nav-item">
            <Link href="{{ route('settings.edit') }}" class="nav-link">
                <i class="fa-solid fa-cog"></i>
            </Link>
        </li>
    </ul>
</nav>