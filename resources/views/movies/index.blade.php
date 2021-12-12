@extends('layouts.main')

@section('content')
<div class="container mx-auto px-20 pt-16 ml-10 cont">
    <div class="popular-movies">
        <h2 class="uppercase tracking-wider text-lg font-semibold text-yellow-400">
            Popular Movies
        </h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16 lg:mr-16" >
            @foreach($popularMovies as $x)
            <x-movie-card :movie="$x" />
            @endforeach
        </div>

    </div>
    <div class="Now-Playing mt-5 py-24">
        <h2 class="uppercase tracking-wider text-lg font-semibold text-yellow-400">
            Now-Playing
        </h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16 lg:mr-16" >
            @foreach($nowmov as $x)
                <x-movie-card :movie="$x" :genres="$genres"/>
            @endforeach
        </div>
    </div>
</div>
@endsection
