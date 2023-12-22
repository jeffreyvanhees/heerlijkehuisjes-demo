<a class="bg-white shadow-lg rounded flex flex-col border border-gray-50" href="{{ route('home.show', $home) }}">
    <img alt="{{ $home->title }}" class="object-cover aspect-[3/2] p-1 rounded-t" src="{{ $home->getFirstMediaUrl('main', 'full') }}" />
    <div class="bg-gray-50 p-4">
        <h2 class="font-sans font-semibold text-xl text-gray-800">
            {{ $home->name }}
        </h2>
        <h3 class="font-sans font-normal text-lg line-clamp-1 text-gray-700">
            {{ $home->subtitle }}
        </h3>
        <p class="font-sans font-normal text-base line-clamp-3 text-gray-600">
            {{ $home->description }}
        </p>
    </div>
</a>