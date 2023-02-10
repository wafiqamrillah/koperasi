<x-app-layout>
    <x-slot name="header">
        <h1>
            {{ __('Show product') }}
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

    <x-splade-form dusk="show-product" :default="$product">
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
                            <div class="row">
                                <div class="col-12">
                                    <x-splade-input id="barcode" name="barcode" type="text" :label="__('Barcode')" :placeholder="__('Barcode')" readonly />
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <x-splade-input id="name" name="name" type="text" :label="__('Name')" :placeholder="__('Name')" readonly />
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <x-splade-input id="brand" name="brand" type="text" :label="__('Brand')" :placeholder="__('Brand')" readonly />
                                </div>
                                <div class="col-12">
                                    <x-splade-textarea id="description" name="description" :label="__('Description')" :placeholder="__('Description')" readonly />
                                </div>
                                <div class="col-12">
                                    <label for="is_active">
                                        {{ __('Active') }}
                                    </label>
                                    <x-splade-checkbox id="is_active" name="is_active" :value="$product->is_active ? 1 : 0" :label="__('Active')" readonly />
                                </div>
                            </div>
                        </div>
                    </div>
                </x-splade-data>
            </div>
        </div>
    </x-splade-form>
    
</x-app-layout>