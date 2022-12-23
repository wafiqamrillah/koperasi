{{-- <nav class="fixed top-0 navbar bg-base-100 shadow z-10"> --}}
<nav class="fixed top-0 h-16 px-0 lg:px-3 w-full bg-gray-50 border-b border-gray-100 shadow z-20 flex items-center justify-between">
    <div class="flex items-center space-x-3">
        <!-- Drawer Menu -->
        <button
            type="button"
            @click.prevent="toggle"
            tabindex="0"
            class="btn btn-ghost btn-circle drawer-button">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>
    <div class="flex items-center space-x-3">
        <!-- Notifications -->
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
    </div>
</nav>