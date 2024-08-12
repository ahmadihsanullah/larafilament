<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h1>Ahmad Ihsanullah</h1>
    {{ $date }}

    <table class="table" border="1">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Email</th>
        </tr>
        @php 
            $no = 1;
        @endphp
        @foreach ($users as $user )
        <tr>
            <th>{{ $no++ }}</th>
            <th>{{ $user->name }}</th>
            <th>{{ $user->email }}</th>
        </tr>
        @endforeach
    </table>
</body>

</html>
