<div class="object-list">
    <div class="container">
        <div class="object-list__header">
            <h3>{{ $title }}</h3>
            <a href="#">Все предложения</a>
        </div>
        
        <div class="object-list__grid">
            @foreach ($objects as $obj)
                <a href="#{{ $obj->id }}" class="object-item">
                    
                    <livewire:favorite-button :obj="$obj"/>

                    
                    <img src="{{ $obj->getMedia('photos')->first()->getUrl('thumb') }}" alt="">
                    <div class="object-item__body">
                        <p class="object-item__price"><span>от {{ $obj->price }} {{ $obj->price_currency }}</span></p>
             
                        @foreach ($obj->cardProperties() as $propertyValue)
                            <p>{{ $propertyValue->property->name }}: {{ $propertyValue->data['value'] }}</p>
                        @endforeach
                        <p class="city">{{ $obj->city->name }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>
