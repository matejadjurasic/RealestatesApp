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
    <div class = "container-fluid" >

    <h1>Pretraga nekretnina</h1>
    <div class = "card">
        <div class = "card-header">

        <form class = "row row-cols-lg-auto g-1" >
           <div class = "col">
              <select class = "form-select" name = "location_id">
                <option value="">Sve lokacije</option>
                @foreach($locations as $location)
                <option value="{{ $location }}" {{ $location == $selectedLocation ? 'selected' : '' }}>
                     {{ $location }}
              </option>
                @endforeach
              </select>
            </div>
            <div class = "col">
                <input type="text" class = "form-control" name = "q" value = "{{ $q }}" placeholder = "Pretrazi..." />
            </div>
            <div class = "input-group">
                 <select class = "form-select" name = "operators">
                   <option value="">Opseg</option>
                    @foreach($operators as $key => $val)
                    @if($operator == $key)
                       <option value="{{ $key }}" selected >{{ $val }}</option>
                    @else
                    <option value="{{ $key }}">{{ $val }}</option>
                    @endif
                     @endforeach
                 </select>
                 <input type="text" class = "form-control" name = "price_start" value = "{{ $price_start }}" />
                 <input type="text" class = "form-control" name = "price_end" value = "{{ $price_end }}"  />
            </div>
            <div class = "col">
                <button class = "btn btn-success">Osvezi</button>
            </div>
        </form>

        </div>
        <div class = "card-body p-0">
            <table class = "table table-hover table-bordered table-striped table sm m-0">
                <thead>        
                    <th>Username</th>
                    <th>Lokacija</th>
                    <th>Opis</th>
                    <th>Cena nekretnine</th>
                    <th>Broj pratilaca</th>
                </thead>

                @foreach($realestates_details as $realestates_details)
                  <tr>     
                    <td>{{ $realestates_details -> username  }}</td>
                    <td>{{ $realestates_details -> location  }}</td>
                    <td>{{ $realestates_details -> description  }}</td>
                    <td>{{ number_format($realestates_details -> price, 2)  }}</td>
                    <td>{{ $realestates_details -> followers_count  }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>

    </div>
</body>
</html>