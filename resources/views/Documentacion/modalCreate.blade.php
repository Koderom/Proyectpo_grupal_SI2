<!-- Button trigger modal -->
<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal">
  Agregar documento
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Seleccione un paciente</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{route('documento.modal.create')}}" method="POST" id="modal-doc">
          @method('post')
          @csrf
          <div class="form-inline">
            <label for="">Pacientes:</label>
            <select name="paciente" class="form-control mx-1">
              @foreach ($Pacientes as $paciente)
                <option value="{{$paciente->id}}">
                  {{$paciente->persona->nombre}}
                  {{$paciente->persona->apellido_paterno}}
                  {{$paciente->persona->apellido_materno}}
                </option>  
              @endforeach
            </select>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
        <button type="submit" class="btn btn-primary" form="modal-doc">Continuar</button>
      </div>
    </div>
  </div>
</div>
