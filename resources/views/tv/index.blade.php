@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-20 pt-16 ml-10 cont">
        <div class="popular-tv">
            <h2 class="uppercase tracking-wider text-lg font-semibold text-yellow-400">
                Popular Shows
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16 lg:mr-16" >
                @foreach($poptv as $x)
                    <x-tv-card :tv="$x" />
                @endforeach
            </div>

        </div>
        <div class="top-rated mt-5 py-24">
            <h2 class="uppercase tracking-wider text-lg font-semibold text-yellow-400">
                Top Rated Shows
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16 lg:mr-16" >
                @foreach($toptv as $x)
                    <x-tv-card :tv="$x" />
                @endforeach
            </div>
        </div>
    </div>
@endsection
