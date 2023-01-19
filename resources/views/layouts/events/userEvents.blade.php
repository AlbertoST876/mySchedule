<div>
    <div>
        <h2>Eventos Proximos</h2>

        @foreach ($nextEvents as $event)
            @include("layouts.events.event", ["event" => $event])
        @endforeach
    </div>

    <div>
        <h2>Eventos Pasados</h2>

        @foreach ($prevEvents as $event)
            @include("layouts.events.event", ["event" => $event])
        @endforeach
    </div>
</div>