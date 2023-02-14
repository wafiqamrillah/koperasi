<x-app-layout>
    <x-slot name="header">
        <h1>
            {{ __('Units') }}
        </h1>
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item">
            <Link href="{{ route('dashboard.index') }}">
                Home
            </Link>
        </li>
        <li class="breadcrumb-item active">
            {{ __('Units') }}
        </li>
    </x-slot>

    <div class="card card-outline card-primary">
        <div class="card-header">
            <div class="card-title">
                {{ __('Units') }}
            </div>
            <div class="card-tools">
                <div class="btn-group">
                    <Link
                        modal
                        href="{{ route('master.units.create') }}"
                        class="btn btn-xs btn-success"
                        data-toggle="tooltip"
                        data-placement="bottom"
                        title="{{ __('Add') }}">
                        <i class="fa-solid fa-plus"></i> {{ __('Create') }}
                    </Link>
                </div>
            </div>
        </div>
        <div class="card-body">
            <x-splade-table :for="$table">
                <x-splade-cell active>
                    <div class="d-flex justify-content-center">
                        <i class="fa-solid {{ !$item->trashed() ? 'fa-check text-success' : 'fa-times text-danger' }}"></i>
                    </div>
                </x-splade-cell>
                <x-splade-cell action>
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="btn-group">
                            <Link
                                modal
                                href="{{ route('master.units.edit', $item->id) }}"
                                class="btn btn-sm btn-warning"
                                data-toggle="tooltip"
                                data-placement="bottom"
                                title="{{ __('Edit') }}">
                                <i class="fa-solid fa-edit"></i>
                            </Link>
                            <Link
                                modal
                                href="{{ route('master.units.delete', $item->id) }}"
                                class="btn btn-sm btn-danger"
                                data-toggle="tooltip"
                                data-placement="bottom"
                                title="{{ __('Delete') }}">
                                <i class="fa-solid fa-trash"></i>
                            </Link>
                        </div>
                    </div>
                </x-splade-cell>
            </x-splade-table>
        </div>
    </div>
</x-app-layout>
