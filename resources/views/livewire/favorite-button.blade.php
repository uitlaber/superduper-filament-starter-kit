<div>
    @if (auth()->user())
        @if (\Maize\Markable\Models\Favorite::has($obj, auth()->user()))
            <button class="btn-favorite" wire:click="favoriteRemove({{ $obj->id }})"><i
                    class="bi bi-heart-fill"></i></button>
        @else
            <button class="btn-favorite" wire:click="favoriteAdd({{ $obj->id }})"><i class="bi bi-heart"></i></button>
        @endif
    @else
        <button class="btn-favorite" wire:click="favoriteAdd({{ $obj->id }})"><i class="bi bi-heart"></i></button>
    @endif
</div>
