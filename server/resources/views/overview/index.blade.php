<!DOCTYPE html>
<html>
<head>
    <title>Laravel</title>
</head>
<body>
<ul>

    @foreach($registers as $register)
        <li><a href="registers/{{$register->id}}"> {{$register->name}}</a></li>
    @endforeach




</ul>
</body>

</html>
