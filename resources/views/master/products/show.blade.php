<x-app-layout>
    <x-slot name="header">
        <h1>
            {{ __('Show'). ' ' . __('product') }}
        </h1>
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item">
            <Link href="{{ route('dashboard.index') }}">
                Home
            </Link>
        </li>
        <li class="breadcrumb-item">
            <Link href="{{ route('master.products.index') }}">
                {{ __('Products') }}
            </Link>
        </li>
        <li class="breadcrumb-item active">
            {{ $product->number ? "($product->number)" : "" }} {{ $product->name }}
        </li>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <x-splade-data default="{ tab : 1 }">
                <ul class="nav nav-tabs">
                    <li class="nav-item" style="cursor: pointer;">
                        <a class="nav-link" :class="{ 'active': data.tab === 1 }" @click.prevent="data.tab = 1">
                            {{ __('Identity') }}
                        </a>
                    </li>
                    <li class="nav-item" style="cursor: pointer;">
                        <a class="nav-link" :class="{ 'active': data.tab === 2 }" @click.prevent="data.tab = 2">
                            {{ __('Unit Management') }}
                        </a>
                    </li>
                    <li class="nav-item" style="cursor: pointer;">
                        <a class="nav-link" :class="{ 'active': data.tab === 3 }" @click.prevent="data.tab = 3">
                            {{ __('Price Management') }}
                        </a>
                    </li>
                    <li class="nav-item" style="cursor: pointer;">
                        <a class="nav-link" :class="{ 'active': data.tab === 4 }" @click.prevent="data.tab = 4">
                            {{ __('Supplier') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content p-2">
                    <div class="tab-pane" :class="{ 'active' : data.tab === 1 }" id="show-product-identity" dusk="show-product-identity">
                        @if ($barcodePNGPath)
                            <div class="row mb-1">
                                <img src="data:image/png;base64,{{ $barcodePNGPath }}" alt="barcode">
                            </div>
                        @endif

                        <div class="row">
                            <table class="table table-bordered">
                                {{-- Product --}}
                                <tr>
                                    <th>
                                        {{ __('Name') }}
                                    </th>
                                    <td>
                                        {{ $product->name }}
                                    </td>
                                </tr>

                                {{-- Active --}}
                                <tr>
                                    <th>
                                        {{ __('Active') }}
                                    </th>
                                    <td>
                                        @if ($product->is_active)
                                            <i class="fa-solid fa-check text-success"></i>
                                        @else
                                            <i class="fa-solid fa-times text-danger"></i>
                                        @endif
                                    </td>
                                </tr>

                                {{-- Category --}}
                                <tr>
                                    <th>
                                        {{ __('Category') }}
                                    </th>
                                    <td>
                                        {{ $product->category?->name }}
                                    </td>
                                </tr>

                                {{-- Brand --}}
                                <tr>
                                    <th>
                                        {{ __('Brand') }}
                                    </th>
                                    <td>
                                        {{ $product->brand }}
                                    </td>
                                </tr>

                                {{-- Description --}}
                                <tr>
                                    <th>
                                        {{ __('Description') }}
                                    </th>
                                    <td>
                                        {{ $product->description }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </x-splade-data>
        </div>
    </div>
    
</x-app-layout>