<x-app-layout>
    <x-slot name="header">
        <h1>
            {{ __('User Management') }}
        </h1>
    </x-slot>

    <div class="card card-outline card-primary">
        <div class="card-body">
            <x-splade-table :for="$users" />
        </div>
    </div>
</x-app-layout>
