<div>
    <div>
        <h2>Eventos Proximos</h2>

        @php
            $events = DB::select("SELECT * FROM events WHERE user_id = ? AND date > NOW() ORDER BY date ASC", [$user_id]);
        @endphp

        @foreach ($events as $event)
            @include("layouts.events.event", ["event" => $event])
        @endforeach
    </div>

    <div>
        <h2>Eventos Pasados</h2>

        @php
            $events = DB::select("SELECT * FROM events WHERE user_id = ? AND date < NOW() ORDER BY date DESC", [$user_id]);
        @endphp

        @foreach ($events as $event)
            @include("layouts.events.event", ["event" => $event])
        @endforeach
    </div>
</div>