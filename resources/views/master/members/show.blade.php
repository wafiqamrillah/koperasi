<x-app-layout>
    <x-slot name="header">
        <h1>
            {{ __('Show').' '. __('member') }}
        </h1>
    </x-slot>

    <x-slot name="breadcrumbs">
        <li class="breadcrumb-item">
            <Link href="{{ route('dashboard.index') }}">
                Home
            </Link>
        </li>
        <li class="breadcrumb-item">
            <Link href="{{ route('master.members.index') }}">
                Members
            </Link>
        </li>
        <li class="breadcrumb-item active">
            {{ $member->name }}
        </li>
    </x-slot>
    
    <x-splade-form dusk="show-member" :default="$member">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    {{ $member->name }}
                </div>
                <div class="card-tools">
                    <div class="btn-group">
                        <Link
                            href="{{ route('master.members.edit', $member->id) }}"
                            class="btn btn-sm btn-warning"
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="{{ __('Edit') }}">
                            <i class="fa-solid fa-edit"></i> {{ __('Edit') }}
                        </Link>
                        <Link
                            modal
                            href="{{ route('master.members.delete', $member->id) }}"
                            class="btn btn-sm btn-danger"
                            data-toggle="tooltip"
                            data-placement="bottom"
                            title="{{ __('Delete') }}">
                            <i class="fa-solid fa-trash"></i> {{ __('Delete') }}
                        </Link>
                    </div>
                </div>
            </div>
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
                                {{ __('Others') }}
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content p-2">
                        <div class="tab-pane" :class="{ 'active' : data.tab === 1 }" id="show-member-identity" dusk="show-member-identity">
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <x-splade-input id="name" name="name" type="text" :label="__('Name')" :placeholder="__('Name')" readonly />
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <x-splade-input id="id_card_number" name="id_card_number" type="text" :label="__('ID Card Number')" :placeholder="__('ID Card Number') . ' (Contoh : 32**************)'" readonly />
                                </div>
                                <div class="col-12">
                                    <label for="is_active">{{ __('Active') }}</label>
                                    <x-splade-checkbox id="is_active" name="is_active" value="1" :label="__('Active')" readonly />
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <x-splade-input id="birth_place" name="birth_place" type="text" :label="__('Birth Place')" :placeholder="__('Birth Place')" readonly />
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <x-splade-input id="birth_date" name="birth_date" type="date" :label="__('Birth Date')" :placeholder="__('Birth Date')" readonly />
                                </div>
                                <div class="col-6">
                                    <x-splade-input id="phone_number" name="phone_number" type="text" :label="__('Phone Number')" :placeholder="__('Phone Number')" readonly />
                                </div>
                                <div class="col-12">
                                    <x-splade-textarea id="address" name="address" :label="__('Address')" :placeholder="__('Address')" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" :class="{ 'active' : data.tab === 2 }" id="show-member-others" dusk="show-user-others">
                            <div class="row">
                                <div class="col-6">
                                    <x-splade-input id="account_number" name="account_number" type="text" :label="__('Account Number')" :placeholder="__('Account Number')" readonly />
                                </div>
                                <div class="col-12">
                                    <label>
                                        {{ __('HRD Employee Data') }}
                                    </label>
                                    <div class="form-group mb-3">
                                        <input
                                            type="text"
                                            class="form-control"
                                            name="employee"
                                            value="{{ optional($member->employee)->name_related }}"
                                            placeholder="{{ __('HRD Employee Data') }}"
                                            readonly
                                        />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </x-splade-data>
            </div>
        </div>
    </x-splade-form>
</x-app-layout>