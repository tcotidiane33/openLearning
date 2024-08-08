<!-- resources/views/components/radio-button.blade.php -->
<label class="inline-flex items-center">
    <input type="radio" class="form-radio" {{ $attributes }}>
    <span class="ml-2">{{ $slot }}</span>
</label>