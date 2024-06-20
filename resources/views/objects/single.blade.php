@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="object-single">
            <div class="col-md-7">
                <p>{{ $objectEntity->city->name }}</p>
                @if($photos = $objectEntity->getMedia('photos'))
                <div class="gallery">                
                    <div class="swiper-container gallery-slider">
                        <div class="swiper-wrapper">
                            @foreach ($photos as $photo)
                            <div class="swiper-slide"><img src="{{ $photo->getUrl() }}" alt=""></div>
                            @endforeach
                        </div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>
                
                    <div class="swiper-container gallery-thumbs">
                        <div class="swiper-wrapper">
                            @foreach ($photos as $photo)
                            <div class="swiper-slide"><img src="{{ $photo->getUrl('thumb') }}" alt=""></div>
                            @endforeach
                        </div>
                    </div>
                </div>
                @endif

                <div class="card mt-4">
                    <div class="card-body">
                        <h3>Описание</h3>
                        {{ $objectEntity->description }}
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
