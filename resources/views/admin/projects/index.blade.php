@extends('layouts.app')

@section('content')
<section class="bg-dark py-4">
    <div class="container py-5">

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-6 text-white g-4 px-2">

            @foreach ($projects as $project)
            <div class="col">
                <a href="{{ route('admin.projects.show', $project->id) }}">
                    <img src="{{ asset('storage/' . $project['thumb']) }}" alt="" class="img-fluid">
                </a>
                <div class="fw-small mt-2">{{$project['title']}}</div>
            </div>
            @endforeach

        </div>
    </div>
</section>

@endsection