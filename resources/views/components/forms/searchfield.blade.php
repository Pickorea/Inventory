<div class="form-group">
@if($label ?? null)
    <label class="{{ ($required ?? false) ? 'label label-required' : 'label' }}" for="{{ $name }}">
        {{ $label }}
    </label>
@endif
@error($name)
<p class="form-error" role="alert">{{ $message }}</p>
@enderror
<input
    autocomplete="off"
    type="{{ $type ?? 'search' }}"
    name="{{ $name }}"
    id="{{ $name }}"
    class="input form-control"
    placeholder="{{ $placeholder ?? '' }}"
    value="{{ old($name, $value ?? '') }}"
    {{ ($required ?? false) ? 'required' : '' }}
>
</div>
