<div class="mb-5">
    <label class="label">{{ $label }}</label>
    <textarea
        class="input-field {{ $attributes->get('class', '') }}"
        {{ $attributes->except('class') }}
        placeholder="{{ $placeholder ?? '' }}"
        rows="{{ $rows ?? 4 }}"
    >{{ $value ?? '' }}</textarea>
    @error($name)
        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>
