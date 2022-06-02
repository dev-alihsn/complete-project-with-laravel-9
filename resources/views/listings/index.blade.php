<x-layout>
<main>
    @include('partails.hero')
    @include('partails.search')
    <div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">
        @if(!count($listings) == 0)
            @foreach ($listings as $listing)
                <x-listing-card :listing="$listing" />
            @endforeach
        @else
            no listings found
        @endif
    </div>
</main>
<div class="mt-5 p-4">
    {{$listings->links()}}
</div>
</x-layout>