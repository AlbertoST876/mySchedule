<div>
    <div>
        <h3>{{ $event -> name }}</h3>
        <span>{{ $event -> category }}</span>
        <p>{{ $event -> description }}</p>
        <span>{{ $event -> date }}</span>
    </div>

    <div>
        <form action="{{ route("events.show") }}" method="post">
            @csrf

            <input type="hidden" name="event" value="{{ $event -> id }}">
            <input type="submit" value="Ver">
        </form>

        <form action="{{ route("events.edit") }}" method="post">
            @csrf

            <input type="hidden" name="event" value="{{ $event -> id }}">
            <input type="submit" value="Editar">
        </form>

        <form action="{{ route("events.delete") }}" method="post">
            @csrf

            <input type="hidden" name="event" value="{{ $event -> id }}">
            <input type="submit" value="Borrar" onclick="confirm('¿Estás seguro de que deseas borrar el evento?')">
        </form>
    </div>
</div>