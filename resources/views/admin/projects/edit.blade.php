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
        'defaultValue' => $project->title
        ])

        @include('components.form-input', [
        'label' => 'Copertina',
        'inputName' => 'thumb',
        'defaultValue' => $project->title,
        'type' => 'file',
        ])

        <img src="{{ asset('storage/' . $project->thumb) }}" alt="" class="img-thumbnail">


        @include('components.form-input', [
        'label' => "GitHub",
        'inputName' => 'github_link',
        'defaultValue' => $project->title
        ])


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