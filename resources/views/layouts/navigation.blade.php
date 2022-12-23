{{-- <nav class="fixed top-0 navbar bg-base-100 shadow z-10"> --}}
<nav class="fixed top-0 h-16 w-full bg-gray-50 border-b border-gray-100 shadow z-20 flex items-center justify-between">
    <div class="flex items-center space-y-3">
        <!-- Drawer Menu -->
        <button
            type="button"
            @click.prevent="toggle"
            tabindex="0"
            class="btn btn-ghost btn-circle drawer-button">
            <i class="fa-solid fa-bars"></i>
        </button>
    </div>
    <div class="flex flex-row-reverse items-center space-y-3">
        <!-- Profile -->
        <x-dropdown placement="bottom-end">
            <x-slot name="trigger">
                <button type="button" tabindex="0" class="btn btn-ghost btn-circle avatar">
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