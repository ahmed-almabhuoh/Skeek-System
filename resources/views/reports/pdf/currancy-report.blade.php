<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Countries - report</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
</head>

<body>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">currancy name</th>
                <th scope="col">Status</th>
                <th scope="col">Created at</th>
                <th scope="col">Created From</th>
                <th scope="col">Updated at</th>
                <th scope="col">Updated From</th>
            </tr>
        </thead>
        <tbody>
            @php
                $counter = 1;
            @endphp
            @foreach ($currancies as $currancy)
                <tr>
                    <th scope="row">{{ $counter }}</th>
                    <td>{{ $currancy->name }}</td>
                    <td>{{ $currancy->active ? 'active' : 'in-active' }}</td>
                    <td>{{ $currancy->created_at }}</td>
                    <td>{{ Carbon\Carbon::parse($currancy->created_at)->diffForHumans() }}</td>
                    <td>{{ $currancy->updated_at }}</td>
                    <td>{{ Carbon\Carbon::parse($currancy->updated_at)->diffForHumans() }}</td>
                </tr>
                @php
                    ++$counter;
                @endphp
            @endforeach
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</body>

</html>