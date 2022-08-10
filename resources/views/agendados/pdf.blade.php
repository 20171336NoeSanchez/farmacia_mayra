<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    
    <!-- Styles -->
    <link href="{{ public_path('css/app.css') }}" rel="stylesheet" type="text/css">
</head>
<style>
    body{
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        font-size: 110%;
        line-height: 1;
        color: #585858;
        padding: 22px 10px;
        padding-bottom: 55px;
    }
    .card-header{
        font-size: 30px;
        margin-bottom: 20px;
        
    }
    table tbody tr { 
        color: #555;
    }

    table tbody tr  {
        padding: 15px 10px;
    }

    h1 { 
        font-family: 'Amarante', Tahoma, sans-serif;
        font-weight: bold;
        font-size: 3.6em;
        line-height: 1.7em;
        margin-bottom: 10px;
        text-align: center;
    }

    #keywords {
        margin: 0 auto;
        font-size: 1.2em;
        margin-bottom: 15px;
    }

    #keywords thead {
        cursor: pointer;
        background: #c9dff0;
    }

    #keywords thead tr th { 
        font-weight: bold;
        padding: 12px 30px;
        padding-left: 42px;
    }

    #keywords thead tr th span { 
        padding-right: 20px;
        background-repeat: no-repeat;
        background-position: 100% 100%;
    }

    #keywords thead tr th.headerSortUp, #keywords thead tr th.headerSortDown {
        background: #acc8dd;
    }

    #keywords thead tr th.headerSortUp span {
        background-image: url('https://i.imgur.com/SP99ZPJ.png');
    }

    #keywords thead tr th.headerSortDown span {
        background-image: url('https://i.imgur.com/RkA9MBo.png');
    }

    #keywords tbody tr { 
        color: #555;
    }

    #keywords tbody tr td {
        text-align: center;
        padding: 15px 10px;
    }

    #keywords tbody tr td.lalign {
        text-align: left;
    }

</style>
<body>
    <div class="container mt-4">

        <?php 

            function cambiarFormato($hora) 
            {
                $var_dump = ( explode( ':', $hora ) );
                $hours = $var_dump[0];
                $minutes = $var_dump[1];

                if ($hours > 12) {
                    $meridian = 'PM';
                    $hours -= 12;
                } else if ($hours < 12) {
                        $meridian = 'AM';
                    if ($hours == 0) {
                        $hours = 12;
                    }
                } else {
                    $meridian = 'PM';
                }
                
                return $hours . ':' . $minutes . ' ' . $meridian;
            }

        ?>
       
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Pacientes Agendados') }}</div>
                    <div class="card-body" id="wrapper">
                        <table id="keywords" class="table table-striped table-hover" cellspacing="0" cellpadding="0">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Paciente</th>
                                    <th scope="col">Dia</th>
                                    <th scope="col">Hora</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($agendados as $row)
                                    <tr>
                                        <td>{{ $row->id }}</td>
                                        <td>{{ $row->nombrepaciente }}</td>
                                        <td>{{ $row->dia }}</td>
                                        <td>{{ cambiarFormato($row->hora) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>