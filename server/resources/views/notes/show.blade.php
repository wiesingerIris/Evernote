<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>
</head>
<body>
<div>
    <h1>{{ $note->title }}</h1>
    <p>{{ $note->description }}</p>
    <!-- Weitere Details der Notiz hier einfügen -->
    <h2>Tasks:</h2>
    @if ($note->tasks)
        <ul>
            @foreach($note->tasks as $task)
                <li>
                    <h3>{{ $task->title }}</h3>
                    <p>{{ $task->description }}</p>
                    <p>Fällig am: {{ $task->due_date }}</p>
                </li>
            @endforeach
        </ul>
    @else
        <p>Keine Tasks vorhanden.</p>
    @endif
</div>
</body>
</html>
