@extends('template.layout')
@section('titleGeneral', 'Lista de ciudades...')
@section('sectionGeneral')
<table class="table table-striped">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Fecha registro</th>
            <th>Fecha actualización</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($listTCity as $value)
            <tr id="cityRow_{{$value->idCity}}">
                <td>{{$value->name}}</td>
                <td>{{$value->created_at}}</td>
                <td>{{$value->updated_at}}</td>
                <td class="text-right">
                    <button class="btn btn-xs btn-info" onclick="showEditModal('{{$value->idCity}}', '{{$value->name}}');">Actualizar</button>
                        <button class="btn btn-xs btn-danger" onclick="deleteCity('{{$value->idCity}}');">Eliminar</button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal de edición -->
<div class="modal fade" id="editCityModal" tabindex="-1" role="dialog" aria-labelledby="editCityModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCityModalLabel">Editar Ciudad</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <input type="text" id="txtName" class="form-control">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-primary" onclick="updateCity($('#editCityModal').data('idCity'));">Guardar</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="{{asset('viewresources/city/getall.js')}}"></script>
<script src="{{asset('viewresources/city/update.js')}}"></script>
@endsection
