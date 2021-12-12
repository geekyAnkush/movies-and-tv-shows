<div class="relative" x-data="{isOpen: true}" @click.away="isOpen = false">
    <input wire:model.debounce.450ms="search" type="text"
           class="bg-gray-800 text-sm rounded-full w-64 px-4 pl-8 py-1 focus:outline-none focus:shadow-inner"
           placeholder="Search"
           @focus="isOpen = true"
           @keydown="isOpen = true"
           @keydown.escape.window = "isOpen = false"
           @keydown.shift.tab.window = "isOpen = false"
    >
    <div class="absolute top-0">
        <svg class="fill-current w-4 text-gray-500 mt-2 ml-2" viewBox="0 0 24 24">
            <path class="heroicon_ui" d="M16.32 14.9l5.39 5.4a1 1 0 01-1.42 1.4l-5.38-5.38a8 8 0 111.41-1.41zM10 16a6 6 0 100-12 6 6 0 000 12z"/>
        </svg>
    </div>
    <div wire:loading class="spinner top-0 right-0 mr-4 mt-4"></div>
    @if(strlen($search)>=2)
    <div class="z-50 absolute bg-gray-800 text-sm rounded w-64 mt-4"
         x-show.transition.opacity = "isOpen"
    >
        @if($searchResults->count()>0)
        <ul>
            @foreach($searchResults as $res)
            <li class="border-b border-gray-700">
                <a href="{{$res['link']}}" class="block
                hover:border-gray-700 px-3 py-3 flex items-center"
                   @if ($loop->last) @keydown.tab="isOpen = false" @endif
                >
                    <img src="{{$res['img']}}"
                         class="w-8" alt="poster">
                    <span class="ml-4">{{$res['title']}}</span>
                </a>
            </li>
            @endforeach
        </ul>
        @else
            <div class="px-3 py-3">No results for {{$search}}</div>
        @endif
    </div>
    @endif
</div>
