@extends('layouts.app')

@section('content')

<section class="py-4 bg-primary">
    <div class="container position-relative">

        <div class="position-comic ">
            <div class="container-comics-top">
                <div></div>
            </div>
            <img src="{{ asset('storage/' . $project['thumb']) }}" height="200" alt="" class="img-fluid">

            <div class="container-comics-bottom">
                <a href="#" class="nav-link fs-small">

                    VIEW GALLERY</a>
            </div>
        </div>

        <div class="position-absolute end-0">
            <a href="{{ route('admin.projects.edit', $project->id)}}" class="btn btn-secondary">
                <i class="bi bi-pencil-square"></i>
            </a>

            <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST"
                class="delete-comic d-inline-block">
                @csrf()
                @method('delete')

                <button class="btn btn-danger">
                    <i class="bi bi-trash-fill "></i>
                </button>
            </form>

        </div>



    </div>
</section>

<div class="container py-5">

    <h1>{{ $project->title }}</h1>

    <div
        class="d-flex justify-content-between px-2 border border-3 border-success border-start-0 bg-success bg-gradient">

        <div>
            <span>U.S Price:

            </span>
            <span class="text-white">{{$project['price']}}</span>
        </div>

        <div>
            <span>AVAILABLE</span>

            <span class="text-white">Check Availability ▼</span>
        </div>

    </div>


    <p class="lead py-3"> {{ $project->description }}</p>

    {{-- @dump($project->technologies) --}}

    <div>Tecnologie:
        @foreach ($project->technologies as $technology)
        <span class="badge text-bg-secondary">{{ $technology->title }}</span>
        @endforeach
    </div>



</div>


<script>
    const deleteComic = document.querySelector(".delete-comic");
    deleteComic.addEventListener("submit", function(e) {
        
        e.preventDefault();
        
        const message = confirm("Vuoi eliminare questo prodotto?");
        if (message === true) {
            deleteComic.submit();
        }
      })
</script>

@endsection