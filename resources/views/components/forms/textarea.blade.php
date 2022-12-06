<div class="form-group">
@if($label ?? null)
    <label class="{{ ($required ?? false) ? 'label label-required' : 'label' }}" for="{{ $name }}">
        {{ $label }}
    </label>
@endif
@error($name)
<p class="form-error" role="alert">{{ $message }}</p>
@enderror
<textarea
    autocomplete="off"
    rows="{{ $rows ?? 3 }}"
    name="{{ $name }}"
    id="{{ $name }}"
    class="input form-control"
    placeholder="{{ $placeholder ?? $label ?? '' }}"
    {{ ($required ?? false) ? 'required' : '' }}
>{{ old($name, $value ?? '') }}</textarea>
</div>
