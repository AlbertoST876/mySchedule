<div>
    <h2>Eventos Proximos</h2>

    @foreach ($events["nextEvents"] as $event)
        @include("layouts.events.event")
    @endforeach
</div>

<div>
    <h2>Eventos Pasados</h2>

    @foreach ($events["prevEvents"] as $event)
        @include("layouts.events.event")
    @endforeach
</div>