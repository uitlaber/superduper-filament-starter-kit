<div class="filter">
    <div class="container">
        <div class="filter__tabs">
            <a href="#" class="{{ $selectedType === 'buy' ? 'active' : '' }}"
                wire:click="selectType('buy')">Купить</a>
            <a href="#" class="{{ $selectedType === 'rent' ? 'active' : '' }}"
                wire:click="selectType('rent')">Арендовать</a>
        </div>

        {{ html()->form('GET', '/search')->open() }}
        <input type="hidden" value="{{ $selectedType }}">
        <div class="filter__content">
            <div class="filter__default">
                <div class="col">
                    <label class="form-label">Тип недвижимости</label>
                    <select class="form-select" name="category_id" wire:model.live="selectedRoot">
                        @foreach ($rootCategories as $value => $title)
                            <option value="{{ $value }}">{{ $title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <label class="form-label">Вид недвижимости</label>
                    <select class="form-select" name="child_category_id" wire:model.live="selectedChild">
                        @foreach ($childCategories as $value => $title)
                            <option value="{{ $value }}">{{ $title }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col">
                    <label class="form-label">Город</label>
                    <select class="form-select" name="city_id" wire:model.live="selectedCity">
                        <option value="0">Любой</option>
                        @foreach ($cities as $cityId => $cityName)
                            <option value="{{ $cityId }}">{{ $cityName }}</option>
                        @endforeach
                    </select>
                </div>

                @foreach ($defaultProperties as $property)
                    <div class="col">
                        <label class="form-label">{{ $property->name }}</label>
                        @if ($property->type === \Modules\ClickHome\Enums\PropertyTypeEnum::RADIO)
                            <select class="form-select" name="properties[{{ $property->id }}]">
                                <option value="0">Любой</option>
                                @foreach ($property->options as $option)
                                    <option value="{{ $option->value }}">{{ $option->value }}</option>
                                @endforeach
                            </select>
                        @endif

                        @if ($property->type === \Modules\ClickHome\Enums\PropertyTypeEnum::NUMBER)
                            <input type="number" name="properties[{{ $property->id }}]" min="0"
                                class="form-control">
                        @endif
                    </div>
                @endforeach

                <div class="col col--price">
                    <label class="form-label">Цена</label>
                    <div class="d-flex gap-3">
                        <div class="form-group ">
                            <input type="number" name="min-price" class="form-control" min="0" placeholder="От">
                        </div>
                        <div class="form-group">
                            <input type="number" name="max-price" class="form-control" min="0" placeholder="До">
                        </div>
                    </div>
                </div>
            </div>
            @if ($isFullFilter)
                <div class="filter__full">
                    @foreach ($fullProperties as $property)
                        <div class="col">
                            <label class="form-label">{{ $property->name }}</label>
                            @if ($property->type === \Modules\ClickHome\Enums\PropertyTypeEnum::RADIO)
                                <select class="form-select" name="properties[{{ $property->id }}]">
                                    <option value="0">Любой</option>
                                    @foreach ($property->options as $option)
                                        <option value="{{ $option->value }}">{{ $option->value }}</option>
                                    @endforeach
                                </select>
                            @endif

                            @if ($property->type === \Modules\ClickHome\Enums\PropertyTypeEnum::NUMBER)
                                <input type="number" name="properties[{{ $property->id }}]" min="0"
                                    class="form-control">
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="filter__buttons">
                <a href="#" wire:click.prevent="toggleFull">
                    @if ($isFullFilter)
                        Быстрый поиск
                    @else
                        Расширенный поиск
                    @endif
                </a>
                <button class="btn" type="submit">Поиск</button>
            </div>
        </div>
        {{ html()->form()->close() }}
    </div>
</div>
