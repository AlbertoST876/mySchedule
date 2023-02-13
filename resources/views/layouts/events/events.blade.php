<details class="mx-12 my-4">
    <summary class="my-6 text-4xl font-extrabold dark:text-white">Eventos Pasados</summary>

    @foreach ($events["prevEvents"] as $event)
        @include("layouts.events.event")
    @endforeach
</details>

<details class="mx-12 my-4" open>
    <summary class="my-6 text-4xl font-extrabold dark:text-white">Eventos Proximos</summary>

    @foreach ($events["nextEvents"] as $event)
        @include("layouts.events.event")
    @endforeach
</details>
