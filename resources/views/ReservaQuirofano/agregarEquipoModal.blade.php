<!--boton que lanza el modal-->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
    Agregar Medico al equipo
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Agregar medico al equipo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('reservarQuirofano.agregar',['reservarQuirofano'=>$reservarQuirofano])}}" method="POST" id="form-prueba">
            @csrf
            <div class="form-group row">
              <div class="col mb-3 mb-sm-0">
                <label for="doctor">Seleccionar Medico:</label>
                <select name="doctor" id="doctor" class="form-control ">
                  @foreach ($DoctoresDisponibles as $doctor)
                      <option value="{{$doctor->id}}">
                        {{$doctor->id}}
                        {{$doctor->persona->nombre}}
                        {{$doctor->persona->apellido_paterno}}
                      </option>
                  @endforeach
                </select>
              </div>
          </div>
          <div class="form-group row">
            <div class="col mb-3 mb-sm-0">
              <label for="funcion">Funcion:</label>
              <input type="text" class="form-control form-control-user" id="funcion" name="funcion" placeholder="...funcion">
            </div>
          </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-primary" form="form-prueba">Agregar</button>
          
        </div>
      </div>
    </div>
</div>