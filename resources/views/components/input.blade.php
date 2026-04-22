<div class="mb-5">
    <label class="label">{{ $label }}</label>
    <input
        type="{{ $type ?? 'text' }}"
        class="input-field {{ $attributes->get('class', '') }}"
        {{ $attributes->except('class') }}
        placeholder="{{ $placeholder ?? '' }}"
    />
    @error($name)
        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>
