<!--boton que lanza el modal-->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal">
    Nuevo tipo de internacion
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Nuevo tipo de internacion</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{route('tipoInternacion.store')}}" method="POST" id="form-prueba">
            @csrf
            <label for="tipo_internacion">Nombre del tipo de internacion: </label>
            <input type="text" name="tipo_internacion" id="tipo_internacion" placeholder="tipo de internacion" value="" autocomplete="off">
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" form="form-prueba">Save changes</button>
          
        </div>
      </div>
    </div>
</div>