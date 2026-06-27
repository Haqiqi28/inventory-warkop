@props([
    'name',
    'label',
    'options' => [],
    'value' => '',
    'required' => false,
    'placeholder' => '-- Pilih --'
])

<div class="mb-3">

    <label for="{{ $name }}" class="form-label">

        {{ $label }}

        @if($required)
            <span class="text-danger">*</span>
        @endif

    </label>

    <select
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-select @error($name) is-invalid @enderror"
        @if($required) required @endif
    >

        <option value="">

            {{ $placeholder }}

        </option>

        @foreach($options as $key => $option)

            <option
                value="{{ $key }}"
                @selected(old($name, $value) == $key)
            >

                {{ $option }}

            </option>

        @endforeach

    </select>

    @error($name)

        <div class="invalid-feedback">

            {{ $message }}

        </div>

    @enderror

</div>