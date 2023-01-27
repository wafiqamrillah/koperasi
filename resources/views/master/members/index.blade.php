<x-app-layout>
    <x-slot name="header">
        <h1>
            {{ __('Members') }}
        </h1>
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item">
            <Link href="{{ route('dashboard.index') }}">
                Home
            </Link>
        </li>
        <li class="breadcrumb-item active">
            Members
        </li>
    </x-slot>

    <div class="card card-outline card-primary">
        <div class="card-header">
            <div class="card-title">
                {{ __('Members Data') }}
            </div>
            <div class="card-tools">
                <div class="btn-group">
                    <Link
                        modal
                        href="{{ route('master.members.import') }}"
                        class="btn btn-xs btn-default"
                        data-toggle="tooltip"
                        data-placement="bottom"
                        title="{{ __('Import') }}">
                        <i class="fa-solid fa-file"></i> {{ __('Import') }}
                    </Link>
                    <Link
                        href="{{ route('master.members.create') }}"
                        class="btn btn-xs btn-success"
                        data-toggle="tooltip"
                        data-placement="bottom"
                        title="{{ __('Add') }}">
                        <i class="fa-solid fa-plus"></i> {{ __('Create new member') }}
                    </Link>
                </div>
            </div>
        </div>
        <div class="card-body">
            <x-splade-table :for="$members">
                <x-splade-cell name>
                    {{ $item->name }}
                </x-splade-cell>
                <x-splade-cell id_card_number>
                    {{ $item->id_card_number }}
                </x-splade-cell>
                <x-splade-cell active>
                    <div class="d-flex justify-content-center">
                        <i class="fa-solid {{ $item->is_active ? 'fa-check text-success' : 'fa-times text-danger' }}"></i>
                    </div>
                </x-splade-cell>
                <x-splade-cell birthPlaceDate>
                    {{ $item->birth_place && $item->birth_date ? $item->birth_place . ', ' . date_format(date_create($item->birth_date), 'd/m/Y') : null }}
                </x-splade-cell>
                <x-splade-cell action>
                    <div class="d-flex align-items-center justify-content-center">
                        <div class="btn-group">
                            <Link
                                href="{{ route('master.members.show', $item->id) }}"
                                class="btn btn-sm btn-default"
                                data-toggle="tooltip"
                                data-placement="bottom"
                                title="{{ __('Show') }}">
                                <i class="fa-solid fa-eye"></i>
                            </Link>
                            <Link
                                href="{{ route('master.members.edit', $item->id) }}"
                                class="btn btn-sm btn-warning"
                                data-toggle="tooltip"
                                data-placement="bottom"
                                title="{{ __('Edit') }}">
                                <i class="fa-solid fa-edit"></i>
                            </Link>
                            <Link
                                modal
                                href="{{ route('master.members.delete', $item->id) }}"
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
