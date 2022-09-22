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
    {{-- <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Bank name</th>
                <th scope="col">Bank</th>
                <th scope="col">City</th>
                <th scope="col">Currancy</th>
                <th scope="col">Created at</th>
                <th scope="col">Updated at</th>
                <th scope="col">Created from</th>
                <th scope="col">Updated from</th>
            </tr>
        </thead>
        <tbody>
            @php
                $counter = 1;
            @endphp
            @foreach ($banks as $bank)
                <tr>
                    <th scope="row">{{ $counter }}</th>
                    @if ($bank->img)
                        <td>with image</td>
                    @else
                        <td>no image</td>
                    @endif
                    <td>{{ $bank->name }}</td>
                    <td>{{ $bank->active ? 'active' : 'in-active' }}</td>
                    <td>{{ $bank->created_at }}</td>
                    <td>{{ Carbon\Carbon::parse($bank->created_at)->diffForHumans() }}</td>
                    <td>{{ $bank->updated_at }}</td>
                    <td>{{ Carbon\Carbon::parse($bank->updated_at)->diffForHumans() }}</td>
                </tr>
                @php
                    ++$counter;
                @endphp
            @endforeach
        </tbody>
    </table> --}}
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Country</th>
                    <th>City</th>
                    <th>Currancy</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th>Updated</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $counter = 1;
                @endphp
                @foreach ($banks as $bank)
                    <tr>
                        <td>{{ $counter }}</td>
                        @if ($bank->img)
                            <td>
                                {{-- <a href="{{ env('APP_URL') . '' . Storage::url('app/img/' . $bank->img) }}">image</a> --}}
                                image
                            </td>
                        @else
                            <td>no image</td>
                        @endif
                        <td>{{ $bank->name }}</td>
                        <td>{{ $bank->country_name }}</td>
                        <td>{{ $bank->city }}</td>
                        <td>{{ $bank->currancy_name }}</td>
                        <td><span class="badge @if (!$bank->active) bg-danger @else bg-success @endif">
                                @if ($bank->active)
                                    Active
                                @else
                                    In-active
                                @endif
                            </span>
                        </td>
                        <td>{{ $bank->created_at . '||' . Carbon\Carbon::parse($bank->created_at)->diffForHumans() }}
                        </td>
                        <td>{{ $bank->updated_at . '||' . Carbon\Carbon::parse($bank->updated_at)->diffForHumans() }}
                        </td>
                    </tr>
                    @php
                        $counter++;
                    @endphp
                @endforeach
            </tbody>
        </table>
    </div>

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
