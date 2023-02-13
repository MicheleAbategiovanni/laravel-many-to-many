@php
$type = empty($type) ? "" : $type;
$defaultValue = empty($defaultValue) ? "" : $defaultValue;
@endphp

<div class="input-group mb-3">

    @if ($type === 'textarea')
    <span class="input-group-text">{{$label}}</span>
    <textarea name="description" cols="30" rows="3"
        class="form-control @error('description') is-invalid @enderror">{{ old('description', $defaultValue) }}</textarea>

    @elseif ($type === 'file')
    <input type="file" class="form-control @error($inputName) is-invalid @enderror" name="{{ $inputName }}">
    <span class="input-group-text">{{$label}}</span>


    @elseif ($type === 'checkbox')

    <div class="mb-3">

        @foreach ($technologies as $technology)
        <div class="form-check form-check-inline @error('technologies') is-invalid @enderror">
            <input class="form-check-input @error('technologies') is-invalid @enderror" type="checkbox"
                id="technologyCheckbox_{{ $loop->index }}" value="{{ $technology->id }}" name="technologies[]" {{ in_array( $technology->id,
            old('technologies', [])) ? 'checked' : '' }}
            >
            <label class="form-check-label" for="technologyCheckbox_{{ $loop->index }}">{{ $technology->title }}</label>
        </div>
        @endforeach

    </div>




    @else
    <span class="input-group-text">{{$label}}</span>
    <input type="text" class="form-control @error($inputName) is-invalid @enderror" name="{{ $inputName }}"
        value="{{ old($inputName, $defaultValue) }}">

    @endif

    @error($inputName)
    <div class="invalid-feedback">
        {{ $message }}
    </div>
    @enderror

</div>