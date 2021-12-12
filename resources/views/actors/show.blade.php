@extends('layouts.main')

@section('content')
    <div class="movie-info border-b border-gray-800">
        <div class="container mx-auto px-20 py-16 flex flex-col md:flex-row">
            <div class="flex-none">
            <img src="{{$actor['profile_path']}}" alt="" class="w-64 md:w-96">
               <ul class="flex items-center mt-4">
                   <li>
                       @if($social['facebook'])
                       <a href="{{$social['facebook']}}" title="Facebook" class="mr-2 text-gray-400 hover:text-white"><i class="fab fa-facebook-square"></i></a>
                       @endif

                       @if($social['instagram'])
                       <a href="{{$social['instagram']}}" title="Instagram" class="mr-2 text-gray-400 hover:text-white"><i class="fab fa-instagram"></i></a>
                           @endif
                           @if($social['twitter'])
                       <a href="{{$social['twitter']}}" title="Twitter" class="mr-2 text-gray-400 hover:text-white"><i class="fab fa-twitter"></i></a>
                           @endif
                       @if($actor['homepage'])
                           <a href="{{$actor['homepage']}}" title="Website" class="text-gray-400 hover:text-white"><i class="fas fa-globe-americas"></i></a>
                       @endif
                   </li>
               </ul>
            </div>
            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">{{$actor['name']}}</h2>
                <div>
                    <div class="flex flex-wrap items-center text-gray-400 text-sm mt-1">
                        <span><i class="fas fa-birthday-cake"></i></span>
                        <span class="ml-2 mt-1">{{$actor['birthday']}}<span class="mx-2">({{$actor['age']}} years old)</span>in {{$actor['place_of_birth']}}</span>
                    </div>
                    <p class="text-gray-300 mt-8">
                        {{$actor['biography']}}
                    </p>
                    <h2 class="font-semibold mt-12">Known For</h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8">
                        @foreach($knownForTitles as $titles)
                        <div class="mt-4">
                            <a href="{{$titles['linkToPage']}}"><img src="{{$titles['poster_path']}}" alt="" class="hover:opacity-75 transition ease-in-out duration-150"></a>
                            <a href="{{$titles['linkToPage']}}" class="text-sm leading-normal block text-gray-400 hover:text-white mt-1"
                            > {{$titles['title']}}</a>
                        </div>
                        @endforeach

                    </div>

                </div>

            </div>
        </div>
    </div>

    <div class="credits border-t border-gray-800">
        <div class="container mx-auto px-20 py-16">
            <h2 class="text-4xl font-semibold">Credits</h2>
            <ul class="list-disc leading-loose pl-5 mt-8">
                @foreach($credits as $credit)
                <li>{{$credit['release_year']}} &middot; <strong>{{$credit['title']}}</strong> as {{$credit['character']}}</li>
                @endforeach
            </ul>
        </div>
    </div>

@endsection
