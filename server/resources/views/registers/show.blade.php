<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>
</head>
<body>
<div>
    <h1>{{ $register->name }}</h1>
    <p>Description: {{ $register->description }}</p>
    <h2>Users:</h2>
    <ul>
        @foreach($users as $user)
            <li>{{ $user->sur_name }}</li>
        @endforeach
    </ul>
    <h2>Notes:</h2>
    <ul>
        @foreach($notes as $note)
            <li><a href="notes/{{$note->id}}"> {{$note->title}}</a></li>
        @endforeach
    </ul>
</div>
</body>

</html>
