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
    <input type="file" class="form-control @error($inputName) is-invalid @enderror" name="{{ $inputName }}" >
    <span class="input-group-text">{{$label}}</span>

   
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