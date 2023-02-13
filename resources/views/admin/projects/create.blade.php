@extends('layouts.app')

@section('content')

<div class="container py-5">

    <h1>Creazione nuovo fumetto</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        I dati inseriti non sono validi:

        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('admin.projects.store') }}" method="POST" class="py-3" enctype="multipart/form-data">
        @csrf

        @include('components.form-input', [
        'label' => 'Titolo',
        'inputName' => 'title',
        ])

        @include('components.form-input', [
        'label' => 'Descrizione',
        'inputName' => 'description',
        'type' => 'textarea',
        ])

        @include('components.form-input', [
        'label' => 'Copertina',
        'inputName' => 'thumb',
        'type' => 'file',
        ])

        @include('components.form-input', [
        'label' => "GitHub",
        'inputName' => 'github_link',
        ])


        <div class="mb-3">
            <label class="form-label">Tipo:</label>
            <select class="form-select @error('type_id') is-invalid @enderror" name="type_id">
                <option></option>
                {{-- Per ogni elemento all'interno di $categories, stampo una option --}}
                @foreach ($types as $type)
                <option value={{ $type->id }}>{{ $type->title }}</option>
                @endforeach
            </select>
            @error('type_id')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <button class="btn btn-primary" type="submit">Salva prodotto</button>
    </form>
</div>


@endsection