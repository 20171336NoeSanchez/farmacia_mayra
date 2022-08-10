@extends('layouts.app')

@section('content')

<div class="container">

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
                <div class="card-header">{{ __('Tabla de agendados') }}</div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
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
                                    <th scope="row">{{ $row->id }}</th>
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

@endsection