<details id="{{ $id }}" class="mb-6" {{ $open ? "open" : "" }}>
    <summary class="mb-6 text-4xl font-extrabold">{{ $name }}</summary>

    @foreach ($events as $event)
        @include("layouts.events.event")
    @endforeach
</details>
