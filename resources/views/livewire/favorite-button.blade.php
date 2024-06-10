<div>
    @if (auth()->user())
        @if (\Maize\Markable\Models\Favorite::has($obj, auth()->user()))
            <button class="btn-favorite" wire:click="favoriteRemove({{ $obj->id }})" aria-label="Убрать из избранных"><i
                    class="bi bi-heart-fill"></i></button>
        @else
            <button class="btn-favorite" wire:click="favoriteAdd({{ $obj->id }})" aria-label="Добавить в избранные"><i class="bi bi-heart"></i></button>
        @endif
    @else
        <button class="btn-favorite" wire:click="favoriteAdd({{ $obj->id }})" aria-label="Добавить в избранные"><i class="bi bi-heart"></i></button>
    @endif
</div>
