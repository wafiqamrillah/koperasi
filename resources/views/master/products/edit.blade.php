<x-app-layout>
    <x-slot name="header">
        <h1>
            {{ __('Edit product') }}
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
            <Link href="{{ route('master.products.show', $product->id) }}">
                {{ $product->number ? "($product->number)" : "" }} {{ $product->name }}
            </Link>
        </li>
        <li class="breadcrumb-item active">
            {{ __('Edit') }}
        </li>
    </x-slot>

    <x-splade-form dusk="edit-product" method="PATCH" :action="route('master.products.update', $product->id)" :default="$product">
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
                        <div class="tab-pane" :class="{ 'active' : data.tab === 1 }" id="edit-product-identity" dusk="edit-product-identity">
                            <div class="row">
                                <div class="col-12">
                                    <x-splade-input id="barcode" name="barcode" type="text" :label="__('Barcode')" :placeholder="__('Barcode')" />
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <x-splade-input id="name" name="name" type="text" :label="__('Name')" :placeholder="__('Name')" required />
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <x-splade-select id="category_id" name="category_id" :label="__('Category')" :placeholder="__('Select category')">
                                        <option value="">{{ __('Select category') }}</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </x-splade-select>
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <x-splade-input id="brand" name="brand" type="text" :label="__('Brand')" :placeholder="__('Brand')" />
                                </div>
                                <div class="col-12">
                                    <x-splade-textarea id="description" name="description" :label="__('Description')" :placeholder="__('Description')" />
                                </div>
                                <div class="col-12">
                                    <label for="is_active">
                                        {{ __('Active') }}
                                    </label>
                                    <x-splade-checkbox id="is_active" name="is_active" value="1" :label="__('Active')" />
                                </div>
                            </div>
                        </div>
                    </div>
                </x-splade-data>
            </div>

            <div class="card-footer">
                <Link href="{{ route('master.products.index') }}" class="btn btn-default">
                    {{ __('Cancel') }}
                </Link>

                <button type="submit" class="btn btn-success float-right">
                    {{ __('Confirm') }}
                </button>
            </div>
        </div>
    </x-splade-form>
    
</x-app-layout>