<div class="object-list">
    <div class="container">
        <div class="object-list__header">
            <h3>{{ $title }}</h3>
            <a href="#">Все предложения</a>
        </div>

        <div class="object-list__grid">
            @foreach ($objects as $obj)
                <a href="#{{ $obj->id }}" class="object-item">

                    @if(auth()->user())
                        @if (\Maize\Markable\Models\Favorite::has($obj, auth()->user()))
                            <button class="btn-favorite" wire:click="favoriteRemove({{ $obj->id }})"><i class="bi bi-heart-fill"></i></button>
                        @else
                            <button class="btn-favorite" wire:click="favoriteAdd({{ $obj->id }})"><i class="bi bi-heart"></i></button>
                        @endif
                    @endif

                    <img src="/storage/{{ $obj->getMedia('photos')->first()->getPathRelativeToRoot('thumb') }}" alt="">
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
