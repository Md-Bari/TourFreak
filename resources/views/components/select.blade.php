<div class="mb-5">
    <label class="label">{{ $label }}</label>
    <select
        class="input-field {{ $attributes->get('class', '') }}"
        {{ $attributes->except('class') }}
    >
        <option value="">{{ $placeholder ?? 'Select an option' }}</option>
        {{ $slot }}
    </select>
    @error($name)
        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
    @enderror
</div>
