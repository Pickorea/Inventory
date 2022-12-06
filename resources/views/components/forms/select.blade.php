<div class="form-group">
    @if($label ?? null)
        <label class="{{ ($required ?? false) ? 'label label-required' : 'label' }}" for="{{ $name }}">
            {{ $label }}
        </label>
    @endif
    @error($name)
    <p class="form-error" role="alert">{{ $message }}</p>
    @enderror
    <select name="{{ $name }}" name="{{ $name }}" class="input form-control" {{ ($required ?? false) ? 'required' : '' }}>
        @if ($required ?? false)
            <option value="">{{ $placeholder ?? 'Please select' }}</option>
        @endif
        @foreach($options as $option)
            <option value="{{ $option->id }}" @if($option->id == old($name, $value ?? ''))selected="true"@endif> {{ $option->name }}</option>
        @endforeach
    </select>
</div>
