<div class="modal" id="adicionarLancamento">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Adicionar</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{route('lancamento.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-4">
                            <input type="date" class="form-control" name="data" placeholder="Data">
                            <span class="text-danger">{{ $errors->has('data') ? $errors->first('data') : '' }}</span>
                        </div>
                        <div class="col-4">
                            <input type="number" class="form-control" name="valor" step=".01" placeholder="Valor">
                            <span class="text-danger">{{ $errors->has('valor') ? $errors->first('valor') : '' }}</span>
                        </div>
                        <div class="col-4">
                            <select class="form-select" name="tipo_gasto">
                                <option value="">Tipo de Gasto</option>
                                <option value="0">Receita</option>
                                <option value="1">Despesa</option>
                            </select>
                            <span class="text-danger">{{ $errors->has('tipo_gasto') ? $errors->first('tipo_gasto') : '' }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-4">
                            <select class="form-select" name="tipo_lancamento_id">
                                <option>Tipo de Lançamento</option>
                                <optgroup label="Receita">
                                    @for ($i = 0; $i < 2; $i++)
                                        <option value="{{$tipo_lancamentos[$i]->id}}">{{$tipo_lancamentos[$i]->descricao}}</option>
                                    @endfor
                                </optgroup>
                                <optgroup label="Despesa">
                                    @for ($i = 2; $i < 21; $i++)
                                        <option value="{{$tipo_lancamentos[$i]->id}}">{{$tipo_lancamentos[$i]->descricao}}</option>
                                    @endfor
                                </optgroup>
                            </select>
                            <span class="text-danger">{{ $errors->has('tipo_lancamento_id') ? $errors->first('tipo_lancamento_id') : '' }}</span>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" name="descricao" placeholder="Descrição">
                            <span class="text-danger">{{ $errors->has('descricao') ? $errors->first('descricao') : '' }}</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Voltar</button>
                    <button type="submit" class="btn btn-success">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>
