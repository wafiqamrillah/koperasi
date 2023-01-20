<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <Link href="/" class="brand-link">
        @if ($application_logo)
            <img src="{{ $application_logo }}" alt="Application Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        @else
            <x-application-logo style="width: 35px;" class="brand-image elevation-3"/>
        @endif
        <span class="brand-text font-weight-light">{{ $application_name }}</span>
    </Link>
    
    <div class="sidebar" style="overflow-y: auto; margin-top: 0;">
        <div class="user-panel my-3 pb-3 d-flex">
            <div class="image">
                <img src="{{ auth()->user()->profile_photo_url }}" class="img-circle elevation-2" alt="User Image" />
            </div>
            <div class="info">
                <Link href="{{ route('profile.edit') }}" class="d-block">
                    {{ auth()->user()->name }}
                </Link>
            </div>
        </div>
        
        <!-- Sidebar menus -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar nav-compact nav-child-indent flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @foreach($menus as $menu)
                    <x-layouts.sidebar.menu :menu="collect($menu)" />
                @endforeach
            </ul>
        </nav>
    </div>
</aside>