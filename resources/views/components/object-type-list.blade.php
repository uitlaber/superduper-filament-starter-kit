<div class="object-list">
    <div class="container">
        <div class="object-list__header">
            <h3>{{ $title }}</h3>
            <a href="#">Все предложения</a>
        </div>

        <div class="object-list__grid">
            @foreach ($objects as $obj)
                <a href="{{ route('objects.single', ['objectId' => $obj->id]) }}" class="object-item">

                    <livewire:favorite-button :obj="$obj" />

                    @if ($photo = $obj->getMedia('photos')->first())
                        <img src="{{ $photo->getUrl('thumb') }}" alt="">
                    @else
                        <img src="/images/no-photo.png" alt="">
                    @endif

                    <div class="object-item__body">
                        <p class="object-item__price"><span>от {{ $obj->price }} {{ $obj->price_currency }}</span></p>

                        @foreach ($obj->cardProperties() as $propertyValue)
                            <dl>
                                <dt>
                                    @if ($icon = $propertyValue->property->getMedia('icon')->first())
                                        <img src="{{ $icon->getUrl() }}" />
                                    @else
                                        {{ $propertyValue->property->name }}:
                                    @endif
                                </dt>
                                <dd>{{ $propertyValue->data['value'] }}</dd>
                            </dl>
                        @endforeach
                        <p class="city">{{ $obj->city->name }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
