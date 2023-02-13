@extends('layouts.app')

@section('content')
<div class="container py-5">

    <div class="d-flex justify-content-between align-items-center">
        <h1>Modifica: {{ $project->title }}</h1>

        <div class="return-on-comic">

            <a href="{{ route('admin.projects.show', $project->id)}}" class="btn btn-secondary p-2 return-on-comic">
                <i class="bi bi-arrow-return-left"></i>
            </a>
        </div>

    </div>

    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        @method('put')

        @include('components.form-input', [
        'label' => 'Titolo',
        'inputName' => 'title',
        'defaultValue' => $project->title
        ])

        @include('components.form-input', [
        'label' => 'Descrizione',
        'inputName' => 'description',
        'type' => 'textarea',
        'defaultValue' => $project->description
        ])

        @include('components.form-input', [
        'label' => 'Copertina',
        'inputName' => 'thumb',
        'defaultValue' => $project->thumb,
        'type' => 'file',
        ])

        <img src="{{ asset('storage/' . $project->thumb) }}" alt="" class="img-thumbnail">


        @include('components.form-input', [
        'label' => "GitHub",
        'inputName' => 'github_link',
        'defaultValue' => $project->github_link
        ])

        <div class="mb-3">
            {{-- una checkbox per ogni tag disponibile. L'utente sceglie quali e quanti associare a questo post --}}
            @foreach ($technologies as $technology)
            <div class="form-check form-check-inline @error('technologies') is-invalid @enderror">
                {{-- Il name dell'input ha come suffisso le quadre [] che indicheranno al server,
                di creare un array con i vari tag che stiamo inviando --}}
                <input class="form-check-input @error('technologies') is-invalid @enderror" type="checkbox"
                    id="technologyCheckbox_{{ $loop->index }}" value="{{ $technology->id }}" name="technologies[]" 
                    {{$project->technologies->contains('id', $technology->id) ? 'checked' : '' }}>

                <label class="form-check-label" for="technologyCheckbox_{{ $loop->index }}">
                {{ $technology->title }} ({{$technology->projects->count() }})</label>
            </div>
            @endforeach

            @error('tags')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>


        <button class="btn btn-primary" type="submit"><i class="bi bi-check-circle-fill"></i></button>
    </form>
</div>


<script>
    const returnOnComic = document.querySelector(".return-on-comic");
    returnOnComic.addEventListener("click", function(e) {
        
        e.preventDefault();
        
        const message = confirm("Vuoi annullare le modifiche di questo prodotto e tornare alla sua visualizzazione?");
        if (message === true) {
            history.back();
        }
      })
</script>
@endsection