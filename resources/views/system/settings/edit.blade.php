<x-app-layout>
    <x-slot name="header">
        <h1>
            {{ __('Settings') }}
        </h1>
    </x-slot>
    
    <x-splade-form
        method="patch"
        :action="route('settings.update')"
        :default="$settings->pluck('value', 'key')"
        class="card card-outline card-warning">
        <div class="card-body">
            <div class="row">
                <div class="col-12 col-md-6">
                    @foreach ($settings->wherein('key', ['APP_LOGO', 'APP_ICON']) as $setting)
                    <!-- {{ $setting->description }} -->
                        <x-splade-file
                            :id="$setting->key"
                            :name="$setting->key"
                            :label="$setting->has_translation ? __($setting->title) : $setting->title"
                            :placeholder="$setting->has_translation ? __($setting->description) : $setting->description"
                            filepond
                            preview/>
                    @endforeach
                </div>
                <div class="col-12 col-md-6">
                    @foreach ($settings->whereNotIn('key', ['APP_LOGO', 'APP_ICON']) as $setting)
                    <!-- {{ $setting->description }} -->
                        @php
                            switch ($setting->key) {
                                case 'PRICE_DEFAULT_TAX':
                                    $type = "number";
                                    $class = "text-right";
                                    break;
                                case 'KOPERASI_ADDRESS':
                                    $type = "textarea";
                                    $class = null;
                                    break;
                                default:
                                    $type = "text";
                                    $class = null;
                                    break;
                            }
                        @endphp

                        @switch($type)
                            @case("textarea")
                            <x-splade-textarea
                                :id="$setting->key"
                                :name="$setting->key"
                                :label="$setting->has_translation ? __($setting->title) : $setting->title"
                                :class="$class"
                                :placeholder="$setting->has_translation ? __($setting->description) : $setting->description"
                                autosize />
                                @break
                            @default
                            <x-splade-input
                                :id="$setting->key"
                                :name="$setting->key"
                                :type="$type"
                                :label="$setting->has_translation ? __($setting->title) : $setting->title"
                                :autocomplete="$setting->key"
                                :class="$class"
                                :placeholder="$setting->has_translation ? __($setting->description) : $setting->description"
                                :min="$type === 'number' ? '0' : false " />
                        @endswitch
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-6">
                    <x-splade-submit :label="__('Save')" />
                </div>
                <div class="col-6 d-flex" style="align-items: center;">
                    @if (session('status') === 'settings-updated')
                        <span class="text-sm text-success">
                            {{ __('Saved.') }}
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </x-splade-form>
</x-app-layout>
