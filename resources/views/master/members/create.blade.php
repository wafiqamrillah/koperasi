<x-app-layout>
    <x-slot name="header">
        <h1>
            {{ __('Create new member') }}
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
            {{ __('Create') }}
        </li>
    </x-slot>

    <x-splade-form dusk="create-member" method="POST" :action="route('master.members.store')">
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
                                {{ __('Others') }}
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content p-2">
                        <div class="tab-pane" :class="{ 'active' : data.tab === 1 }" id="edit-member-identity" dusk="edit-member-identity">
                            <div class="row">
                                <div class="col-xs-12 col-md-6">
                                    <x-splade-input id="name" name="name" type="text" :label="__('Name')" :placeholder="__('Name')" />
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <x-splade-input id="id_card_number" name="id_card_number" type="text" :label="__('ID Card Number')" :placeholder="__('ID Card Number') . ' (Contoh : 32**************)'" />
                                </div>
                                <div class="col-12">
                                    <label for="is_active">{{ __('Active') }}</label>
                                    <x-splade-checkbox id="is_active" name="is_active" :label="__('Active')" />
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <x-splade-input id="birth_place" name="birth_place" type="text" :label="__('Birth Place')" :placeholder="__('Birth Place')" />
                                </div>
                                <div class="col-xs-12 col-md-6">
                                    <x-splade-input id="birth_date" name="birth_date" date :label="__('Birth Date')" :placeholder="__('Birth Date')" />
                                </div>
                                <div class="col-6">
                                    <x-splade-input id="phone_number" name="phone_number" type="text" :label="__('Phone Number')" :placeholder="__('Phone Number')" />
                                </div>
                                <div class="col-12">
                                    <x-splade-textarea id="address" name="address" :label="__('Address')" :placeholder="__('Address')" />
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" :class="{ 'active' : data.tab === 2 }" id="edit-member-others" dusk="edit-user-others">
                            <div class="row">
                                <div class="col-6">
                                    <x-splade-input id="account_number" name="account_number" type="text" :label="__('Account Number')" :placeholder="__('Account Number')" />
                                </div>
                                <div class="col-12">
                                    <x-splade-select
                                        choices
                                        remote-url="{{ route('api.master.employee.index') }}"
                                        name="employee_id"
                                        :label="__('HRD Employee Data')"
                                        :placeholder="__('Select Employee Data')"
                                        option-label="name_related"
                                        option-value="id" />
                                </div>
                            </div>
                        </div>
                    </div>
                </x-splade-data>
            </div>

            <div class="card-footer">
                <Link href="{{ route('master.members.index') }}" class="btn btn-default">
                    {{ __('Cancel') }}
                </Link>

                <button type="submit" class="btn btn-success float-right">
                    {{ __('Confirm') }}
                </button>
            </div>
        </div>
    </x-splade-form>
    
</x-app-layout>