@extends('layouts.main')

@section('content')
    <div class="container mx-auto ml-10" style="padding: 3rem 4rem; overflow-y: hidden;">
        <div class="popular-actors">
            <h2 class="uppercase tracking-wider text-lg font-semibold text-yellow-400">
                Popular Actors
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-16 lg:mr-16" >
                @foreach($popactors as $actor)
                <div class="actor mt-8">
                    <a href="{{url('actors', $actor['id'])}}"><img src='{{$actor['profile_path']}}' alt=""
                        class="hover:opacity-75 transition ease-in-out duration-150"></a>
                    <div class="mt-2">
                        <a href="{{url('actors', $actor['id'])}}" class="text-lg hover:text-gray-300">{{$actor['name']}}</a>
                        <div class="text-sm truncate text-gray-400">{{$actor['known_for']}}</div>
                    </div>
                </div>
                @endforeach
            </div>

        </div>
        <div class="page-load-status my-8">
            <div class="flex justify-center">
                <p class="infinite-scroll-request spinner my-8 text-4xl">&nbsp;</p>
            </div>

            <p class="infinite-scroll-last">End of content</p>
            <p class="infinite-scroll-error">Error</p>
        </div>
{{--        <div class="flex justify-between mt-16" style="width: 95%">--}}
{{--            @if($previous)--}}
{{--            <a href="/actors/page/{{$previous}}" class="hover:text-gray-300">Previous</a>--}}
{{--            @else--}}
{{--                <div></div>--}}
{{--            @endif--}}
{{--            @if($next)--}}
{{--            <a href="/actors/page/{{$next}}" class="hover:text-gray-300">Next</a>--}}
{{--                @else--}}
{{--                <div></div>--}}
{{--            @endif--}}
{{--        </div>--}}

    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
    <script>
        let elem = document.querySelector('.grid');
        let infScroll = new InfiniteScroll( elem, {
            // options
            path: '/actors/page/@{{#}}',
            append: '.actor',
            status: '.page-load-status'
            // history: false,
        });
    </script>
@endsection
