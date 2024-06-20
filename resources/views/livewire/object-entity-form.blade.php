<div>
    {{ html()->form('POST', '/create')->open() }}
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm">
                        <label class="form-label">Тип сделки</label>
                        <select class="form-select" name="type"  wire:model.live="selectedDealType">
                            <option value="0">Выберите тип сделки</option>
                            @foreach ($dealTypes as $value => $label)
                                <option value="{{ $value }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    @if($selectedDealType != null || $selectedDealType != 0)
                    <div class="col-sm">
                        <label class="form-label">Категория</label>
                        <select class="form-select" name="category_id" wire:model.live="selectedCategory">
                            @foreach ($categoryOptions as $group => $categories)
                                <optgroup label="{{ $group }}">
                                    @foreach ($categories as $categoryId => $category)
                                        <option value="{{ $categoryId }}">{{ $category }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        {{ html()->form()->close() }}
</div>
