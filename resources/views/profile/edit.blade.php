<x-app-layout>
    <x-slot name="header">
        <h1>
            {{ __('Profile') }}
        </h1>
    </x-slot>
    
    <div class="row">
        <div class="col-md-3">
            <div class="card card-primary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle" src="{{ auth()->user()->profile_photo_url }}" alt="User profile picture">
                    </div>
                    <h3 class="profile-username text-center">
                        {{ auth()->user()->name }}
                    </h3>
                    <p class="text-muted text-center">Software Engineer</p>
                </div>
            </div>
            
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        {{ __('About Me') }}
                    </h3>
                </div>
                
                <div class="card-body">
                    <strong><i class="fa-solid fa-at mr-1"></i> Email</strong>
                    <p class="text-muted">
                        {{ auth()->user()->email }}
                    </p>
                </div>
            </div>
        </div>
        
        <div class="col-md-9">
            <x-splade-data remember="profile-tab" default="{ tab: '{{ $tab }}' }">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link" :class="{ 'active' : data.tab === 'edit-profile-information' }" href="#edit-profile-information" data-toggle="tab" @click.prevent="data.tab = 'edit-profile-information'">
                                    {{ __('Edit Profile Information') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" :class="{ 'active' : data.tab === 'change-password' }" href="#change-password" data-toggle="tab" @click.prevent="data.tab = 'change-password'">
                                    {{ __('Change Password') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" :class="{ 'active' : data.tab === 'delete-user' }" href="#delete-user" data-toggle="tab" @click.prevent="data.tab = 'delete-user'">
                                    {{ __('Delete User') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane" :class="{ 'active' : data.tab === 'edit-profile-information' }" id="edit-profile-information" dusk="update-profile-information">
                                @include('profile.partials.update-profile-information-form')
                            </div>
                            <div class="tab-pane" :class="{ 'active' : data.tab === 'change-password' }" id="change-password" dusk="update-password">
                                @include('profile.partials.update-password-form')
                            </div>
                            <div class="tab-pane" :class="{ 'active' : data.tab === 'delete-user' }" id="delete-user" dusk="delete-user">
                                @include('profile.partials.delete-user-form')
                            </div>
                        </div>
                    </div>
                </div>
            </x-splade-data>
        </div>
    </div>
</x-app-layout>
