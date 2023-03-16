<details class="mx-12 my-4" {{ $open ? "open" : "" }}>
    <summary class="my-6 text-4xl font-extrabold">{{ $name }}</summary>

    @foreach ($events as $event)
        @include("layouts.events.event")
    @endforeach
</details>
