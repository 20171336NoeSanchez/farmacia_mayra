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

    <div class="row">
        <div class="col-md-12 mb-2">
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-plus"></i> Agregar cita</button>
                
            </div>
        </div>
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Tabla de citas') }}</div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Dia</th>
                                <th scope="col">Hora</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($citas as $row)
                                <tr>
                                    <th scope="row">{{ $row->id }}</th>
                                    <td>{{ $row->dia }}</td>
                                    <td>{{ cambiarFormato($row->hora) }}</td>

                                    <td style="width: 50px;">
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#updateCita{{ $row->id }}" title="Editar">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                    </td>
                                    
                                    <form action=" {{ route('citas.destroy', $row->id) }} " method="POST">
                                        @csrf
                                        @method('delete')
                                        <td style="width: 50px;">
                                            <button type="submit" class="btn btn-danger btn-sm" title="Eliminar">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </td>
                                    </form>
                                
                                </tr>
                                <div class="modal fade" id="updateCita{{ $row->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <div class="modal-header text-center">
                                                <h5 class="modal-title" id="exampleModalLabel">Editar cita</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action=" {{ route('citas.update', $row->id)}} " method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <input disabled value="{{ $row->id }}" name="id" type="input" class="form-control" id="exampleInputEmail1" placeholder="Dia">
                                                    <div class="mb-3">
                                                        <label for="exampleInputEmail1" class="form-label">Dia:</label>
                                                        <input value="{{ $row->dia }}" name="dia" type="date" class="form-control" id="exampleInputEmail1" placeholder="Dia">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="exampleInputPassword1" class="form-label">Hora:</label>
                                                        <input value="{{ $row->hora }}" name="hora" type="time" class="form-control" id="exampleInputPassword1" placeholder="Hora">
                                                    </div>
                                                    <hr>
                                                    <div class="d-flex justify-content-end">
                                                        <button type="submit" class="btn btn-primary m-1">Guardar</button>
                                                        <button type="button" class="btn btn-secondary m-1" data-bs-dismiss="modal">Cerrar</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
      
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar cita</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action=" {{ route('citas.create') }} " method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Dia:</label>
                            <input name="dia" type="date" class="form-control" id="exampleInputEmail1" placeholder="Dia">
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Hora:</label>
                            <input name="hora" type="time" class="form-control" id="exampleInputPassword1" placeholder="Hora">
                        </div>
                        <hr>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary m-1">Guardar</button>
                            <button type="button" class="btn btn-secondary m-1" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
</div>

@endsection