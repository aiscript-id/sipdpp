<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid mt-4">
        <h3 class="">{{ $title }}</h3>
        <h6>{{ $event->name }}</h6>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Lokasi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)    
                <tr>
                    <th scope="row">{{ $loop->iteration }}</th>
                    <td>{{ $user->user->name }}</td>
                    <td>{{ $user->date }}</td>
                    <td>{{ $user->location }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
