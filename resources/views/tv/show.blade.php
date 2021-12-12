@extends('layouts.main')

@section('content')
    <div class="tv-info border-b border-gray-800">
        <div class="container mx-auto px-20 py-16 flex flex-col md:flex-row">
            <img src="{{$tv['poster_path']}}" alt="" class="w-64 md:w-96">
            <div class="md:ml-24">
                <h2 class="text-4xl font-semibold">{{$tv['name']}}</h2>
                <div>
                    <div class="flex flex-wrap items-center text-gray-400 text-sm mt-1">
                        <span><i class="fas fa-star text-yellow-500"></i></span>
                        <span class="ml-1">{{$tv['vote_average']}}</span>
                        <span class="mx-2">|</span>
                        <span>{{$tv['first_air_date']}}</span>
                        <span class="mx-2">|</span>
                        <span>
                            {{$tv['genres']}}
                        </span>
                    </div>
                    <p class="text-gray-300 mt-8">
                        {{$tv['overview']}}
                    </p>

                    <div class="mt-12">

                        <div class="flex mt-4">
                            @foreach($tv['created_by'] as $crew)
                                <div class="mr-8">
                                    <div>{{$crew['name']}}</div>
                                    <div class="text-sm text-gray-400">Creator</div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div x-data="{ isOpen: false }">
                        @if(count($tv['videos']['results']) > 0)
                            <div class="mt-12">
                                <button
                                    @click="isOpen = true"
                                    class="flex inline-flex items-center bg-yellow-500 text-gray-900 rounded font-semibold px-4 py-3 hover:bg-yellow-600 transition ease-in-out duration-150">
                                    <i class="far fa-play-circle"></i>
                                    <span class="ml-2">Play Trailer</span>
                                </button>
                            </div>
                        @endif
                        {{--                        modal--}}
                        <div style="background-color: rgba(0,0,0,.5);"
                             class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                             x-show.transition.opacity="isOpen"
                        >
                            <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                                <div class="bg-gray-900 rounded">
                                    <div class="flex justify-end pr-4 pt-2">
                                        <button @click="isOpen=false" class="text-3xl leading-none hover:text-gray-300">&times;</button>
                                    </div>
                                    <div class="modal-body px-8 py-8">
                                        <div class="responsive-container overflow-hidden relative" style="padding-top: 56.25%">
                                            @if(count($tv['videos']['results'])>0)
                                            <iframe src="https://www.youtube.com/embed/{{$tv['videos']['results'][(count($tv['videos']['results'])-2 < 0)?0:count($tv['videos']['results']) - 2]['key']}}" width="560" height="315" class="responsive-iframe
                            absolute top-0 left-0 w-full h-full" style="border: 0;" allow="autoplay; encrypted-media"
                                                    allowfullscreen></iframe>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        {{--                        modal--}}
                    </div>
                </div>
            </div>
        </div>



        <div class="movie-cast border-t border-gray-800">
            <div class="container mx-auto px-20 py-16">
                <h2 class="text-4xl font-semibold">Cast</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">

                    @foreach($tv['cast'] as $cast)

                        <div class="mt-8">
                            <a href="{{url('actors',$cast['id'])}}">
                                <img src={{"https://image.tmdb.org/t/p/w300/".$cast['profile_path']}} alt="" class="hover:opacity-75 transition ease-in-out duration-150">
                            </a>
                            <div class="mt-2">
                                <a href="{{url('actors',$cast['id'])}}" class="text-lg mt-2 hover:text-gray-300">{{$cast['name']}}</a><br>
                                <span class="text-gray-400 text-sm">{{$cast['character']}}</span>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="movie-images border-t border-gray-800" x-data="{isOpen:false, image: '' }">
        <div class="container mx-auto px-20 py-16">
            <h2 class="text-4xl font-semibold">Images</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                @foreach($tv['images'] as $image)

                    <div class="mt-8">
                        <a
                            @click.prevent="
                       isOpen = true
                       image='{{"https://image.tmdb.org/t/p/original/".$image['file_path']}}'
                        "
                            href="#"
                        >
                            <img src={{"https://image.tmdb.org/t/p/w500/".$image['file_path']}} alt="" class="hover:opacity-75 transition ease-in-out duration-150">
                        </a>
                    </div>

                @endforeach
            </div>
            <div style="background-color: rgba(0,0,0,.5);"
                 class="fixed top-0 left-0 w-full h-full flex items-center shadow-lg overflow-y-auto"
                 x-show="isOpen"
            >
                <div class="container mx-auto lg:px-32 rounded-lg overflow-y-auto">
                    <div class="bg-gray-900 rounded">
                        <div class="flex justify-end pr-4 pt-2">
                            <button @click="isOpen = false"
                            <button @keydown.escape.window="isOpen = false"
                                    class="text-3xl leading-none hover:text-gray-300">&times;</button>
                        </div>
                        <div class="modal-body px-8 py-8">
                            <img :src="image" alt="poster">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
@endsection
