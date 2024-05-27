<div>
    <!-- Swiper -->
    <div class="swiper home-banner">
        <div class="swiper-wrapper">
            @foreach ($banners as $banner)
                <div class="swiper-slide" style="background-image: url({{ $banner->getMedia('banners')->first()->getUrl() }})">
                </div>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>

</div>
