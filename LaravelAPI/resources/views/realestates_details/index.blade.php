<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pretraga</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container-fluid">

        <h1>Pretraga nekretnina</h1>

        <div class="card">
            <div class="card-header">
                <form class="row row-cols-lg-auto g-1">
                    <div class="col">
                        <select class="form-select" name="location_name">
                            <option value="">Sve lokacije</option>
                            @foreach($locations as $location)
                                @if($selectedLocation == $location)
                                    <option value="{{ $location }}" selected>{{ $location }}</option>
                                @else
                                    <option value="{{ $location }}">{{ $location }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" name="q" value="{{ $q }}" placeholder="Pretrazi..." />
                    </div>
                    <div class="input-group">
                        <select class="form-select" name="operator">
                            <option value="">Opseg cene</option>
                            @foreach($operators as $key => $val)
                                @if($operator == $key)
                                    <option value="{{ $key }}" selected>{{ $val }}</option>
                                @else
                                    <option value="{{ $key }}">{{ $val }}</option>
                                @endif
                            @endforeach
                        </select>
                        <input type="text" class="form-control" name="price_start" value="{{ $price_start }}" />
                        <input type="text" class="form-control" name="price_end" value="{{ $price_end }}" />
                    </div>
                    <div class="col">
                        <button class="btn btn-success">Pronadji</button>
                    </div>
                </form>
            </div>
            <div class="card-body p-0">
                <table class="table table-hover table-bordered table-striped table sm m-0">
                    <thead>
                        <th>Username</th>
                        <th>Lokacija</th>
                        <th>Opis</th>
                        <th>Cena nekretnine</th>
                        <th>Broj pratilaca</th>
                    </thead>

                    @foreach($realestates_details as $realestate)
                        <tr>
                            <td>{{ $realestate->username }}</td>
                            <td>{{ $realestate->location }}</td>
                            <td>{{ $realestate->description }}</td>
                            <td>{{ number_format($realestate->price, 2) }}</td>
                            <td>{{ $realestate->followers_count }}</td>
                        </tr>
                    @endforeach
                </table>

                {{ $realestates_details->links() }}
            </div>
        </div>

    </div>
</body>
</html>
