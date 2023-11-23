<style>
    .select2-container--default .select2-results__option[aria-selected=true] {
        background-color: rgb(227, 238, 255) !important;
        color: #1a1a1a !important;
    }
</style>

<label for="{{ $id }}" class="form-label">{{ $label }} @if (isset($required))
        *
    @endif
</label>
<div class="input-group">
    <select id="{{ $id }}" name="{{ $name }}@if (isset($isMultiSelect))[]@endif"
            @if (isset($disabled)) disabled @endif
            class="form-control select2 {{ $class??'' }} @if (isset($isMultiSelect)) select2-multiple @endif
    @error($name) is-invalid @enderror"
            @if (isset($isMultiSelect)) multiple="multiple" @endif data-toggle="select2"
            @if (isset($required)) required @endif>
        @if (isset($isMultiSelect))
            @if($isMultiSelect  == false )
                <option value="">Selecione</option>
            @endif
        @endif
            <option value="" @if (!isset($required) && !old($name) && !isset($selected)) selected @endif></option>
        @foreach ($dataset as $data)
            @if (isset($isMultiSelect))
                <option value="{{ $data->value() }}" @if (
                    ($selected and is_array($selected))
                        ? in_array($data->value(), $selected)
                        : collect(old($id))->contains($data->value())) selected @endif>
                    {{ $data->label() }}
                </option>
            @else
                <option value="{{ $data->value() }}"
                        @if ($data->value() == old($name) or $data->value() == isset($selected) ?? $selected) selected @endif>
                    {{ $data->label() }}
                </option>
            @endif
        @endforeach
    </select>
    @if (!$errors->any())
        <div class="invalid-feedback">
            Campo Obrigatório.
        </div>
    @endif
    <div class="invalid-feedback">
        @error($name)
        {{ $message }}
        @enderror
    </div>

</div>

<script>
    $(document).ready(function () {
        $('#{{ $id }}').each(function () {
            $(this).select2({
                dropdownParent: $(this).parent()
            });
        });
    });
</script>
