<details id="{{ $id }}" class="mb-6">
    <summary class="mb-6 text-4xl font-extrabold">{{ $name }}</summary>

    @foreach ($events as $event)
        @include("layouts.events.event")
        @php $i++; @endphp
    @endforeach
</details>
