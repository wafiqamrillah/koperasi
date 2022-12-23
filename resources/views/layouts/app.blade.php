<div class="relative min-h-screen bg-gray-100">
    <x-splade-toggle>
        <!-- Navigation -->
        @include('layouts.navigation')

        <!-- Sidebar -->
        <x-splade-transition
            show="toggled"
            enter="transform transform ease-in-out duration-300"
            enter-from="opacity-0 -translate-x-full"
            enter-to="opacity-100 translate-x-0"
            leave="transform transform ease-in-out duration-300"
            leave-from="opacity-100 translate-x-0"
            leave-to="opacity-0 -translate-x-full"
        >
            @include('layouts.sidebar')
        </x-splade-transition>
    </x-splade-toggle>

    <!-- Page Heading -->
    @if (isset($header) || isset($breadrumbs))
    <header class="pt-16 bg-white shadow">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8">
            {{ isset($header) ? $header : null }}
            @isset($breadcrumbs)
                <!-- Breadcrumbs -->
                <div class="text-sm breadcrumbs">
                    @if (is_array($breadcrumbs))
                        <ul>
                            @foreach ($breadcrumbs as $breadcrumb)
                                <li>{{ $breadcrumb }}</li>
                            @endforeach
                        </ul>
                    @else
                        {{ $breadcrumbs }}
                    @endif
                </div>
            @endisset
        </div>
    </header>
    @endif

    <!-- Page Content -->
    <main class="relative w-full px-6 py-6 mx-auto">
        {{ $slot }}
    </main>
</div>
