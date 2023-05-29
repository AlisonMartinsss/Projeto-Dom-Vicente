<div class="modal" id="remover-{{$lancamento->id}}">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Remover</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Você tem certeza que deseja excluir?</p>
            </div>
            <div class="modal-footer">
                <form action="{{route('lancamento.destroy', $lancamento->id)}}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger">Remover</button>
                </form>
            </div>

        </div>
    </div>
</div>
