<x-layout>
    <div class="flex flex-row gap-10">
        <div class="flex-1 space-y-4">
            <div class="shadow-lg rounded overflow-hidden">
                <img alt="{{ $home->title }}" class="object-cover aspect-[3/2] p-1 shadow rounded"
                     src="{{ $home->getFirstMediaUrl('main', 'full') }}"/>
            </div>
            <div class="grid grid-cols-3  gap-4">
                @foreach($home->getMedia('gallery') as $image)
                    <img alt="{{ $home->title }}"
                         class="shadow-lg p-1 rounded overflow-hidden object-cover aspect-[3/2] "
                         src="{{ $image->getUrl('thumbnail') }}"
                    />
                @endforeach
            </div>
        </div>
        <div class="flex-1">
            <h1 class="text-2xl font-medium">{{ $home->name }}</h1>
            <h2 class="text-gray-700 italic">{{ $home->subtitle }}</h2>
            <p class="leading-9">{{ $home->description }}</p>

            <p class="text-xl font-semibold text-green-500">
                &euro; {{ number_format($home->price, 2, ',', '.') }}
            </p>
        </div>
    </div>
</x-layout>