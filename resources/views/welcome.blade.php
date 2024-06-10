@extends('layouts.app')

@section('content')
    <livewire:top-filter />

    <x-object-type-list title="Квартиры" :categoryId="4" :limit="4"/>
    <x-object-type-list title="Загородная" :categoryId="4" :limit="4"/>
    <x-object-type-list title="Коммерческая" :categoryId="4" :limit="4"/>
    <x-object-type-list title="Арендная недвижимость" :categoryId="4" :limit="4"/>
   
    {{-- <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
