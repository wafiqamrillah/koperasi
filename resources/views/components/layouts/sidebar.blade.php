<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <Link href="/" class="brand-link">
        <span class="brand-image elevation-3">
            <x-application-logo style="width: 35px;" />
        </span>
        <span class="brand-text font-weight-light">AdminLTE 3</span>
    </Link>
    
    <div class="sidebar" style="overflow-y: auto; margin-top: 0;">
        <div class="user-panel my-3 pb-3 d-flex">
            <div class="image">
                <img src="https://placeimg.com/80/80/people" class="img-circle elevation-2" alt="User Image" />
            </div>
            <div class="info">
                <Link href="#" class="d-block">
                    {{ auth()->user()->name }}
                </Link>
            </div>
        </div>
        
        <!-- Sidebar menus -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @foreach($menus as $menu)
                    <x-layouts.sidebar.menu :menu="collect($menu)" />
                @endforeach
            </ul>
        </nav>
    </div>
</aside>