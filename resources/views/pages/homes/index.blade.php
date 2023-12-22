<x-layout>
    <div class="grid grid-cols-2 gap-4">
        @foreach($homes as $home)
            @include('components.home-card', ['home' => $home])
        @endforeach
    </div>
</x-layout>