<div>
    <x-splade-toggle>
        <div
        class="sidebar-mini control-sidebar-slide-open layout-fixed layout-navbar-fixed layout-footer-fixed"
        :class="{ 'sidebar-collapse' : !toggled }">
        <div class="wrapper">
            <!-- Navigation -->
            @include('layouts.navigation')
            
            <!-- Sidebar -->
            <x-layouts.sidebar />
            
            <!-- Page Content -->
            <main class="content-wrapper">
                <!-- Page Heading -->
                @if (isset($header) || isset($breadrumbs))
                <section class="content-header">
                    <div class="container-fluid">
                        <div class="row mb-2">
                            <div class="col-sm-6">
                                {{ isset($header) ? $header : null }}
                            </div>
                            <div class="col-sm-6">
                                <!-- Breadcrumbs -->
                                <ol class="breadcrumb float-sm-right">
                                @isset($breadcrumbs)
                                    @if (is_array($breadcrumbs))
                                        @foreach ($breadcrumbs as $breadcrumb)
                                        <li>{{ $breadcrumb }}</li>
                                        @endforeach
                                    @else
                                        {{ $breadcrumbs }}
                                    @endif
                                @endisset
                                </ol>
                            </div>
                        </div>
                    </div>
                </section>
                @endif
                
                <section class="content">
                    <div class="container-fluid">
                        {{ $slot }}
                    </div>
                </section>
            </main>
            
            <!-- Footer -->
            <footer class="main-footer text-sm">
                <div class="float-right d-none d-sm-block">
                    <b>Version</b> 3.2.0
                </div>
                <strong>Copyright © 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
            </footer>
            
            <!-- Sidebar Overlay -->
            <div id="sidebar-overlay"></div>
        </div>
    </div>
</x-splade-toggle>    
</div>