<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form action="session" method="POST">
    @csrf

    <button>Put Data To Session</button>
</form>
<form action="session" method="POST">
    @method('DELETE')
    @csrf

    <button>Delete Data From Session</button>
</form>


@if(isset($data))
    <ul>
        <li>{{ $data['product_name'] }}</li>
        <li>{{ $data['qty'] }}</li>
    </ul>
@endif

</body>
</html>
