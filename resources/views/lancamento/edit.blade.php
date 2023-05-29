<div class="modal" id="editar-{{$lancamento->id}}">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{route('lancamento.update', $lancamento->id)}}">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-4">
                            <input type="date" class="form-control" name="data" placeholder="Data" value="{{$lancamento->data ?? old('data')}}">
                            <span class="text-danger">{{ $errors->has('data') ? $errors->first('data') : '' }}</span>
                        </div>
                        <div class="col-4">
                            <input type="number" class="form-control" name="valor" step=".01" placeholder="Valor" value="{{$lancamento->valor ?? old('valor')}}">
                            <span class="text-danger">{{ $errors->has('tipo_gasto') ? $errors->first('tipo_gasto') : '' }}</span>
                        </div>
                        <div class="col-4">
                            <select class="form-select" name="tipo_gasto">
                                <option value="">Tipo de Gasto</option>
                                <option value="0" {{ $lancamento->tipo_gasto == 0 ? "selected='selected'" : ""}}>Receita</option>
                                <option value="1" {{ $lancamento->tipo_gasto == 1 ? "selected='selected'" : ""}}>Despesa</option>
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
                                        <option value="{{$tipo_lancamentos[$i]->id}}" @if(isset($tipo_lancamentos[$i]->id)) {{ old('tipo_lancamento_id', $lancamento->tipo_lancamento_id) == $tipo_lancamentos[$i]->id ? 'selected' : '' }} @endif>{{$tipo_lancamentos[$i]->descricao}}</option>
                                    @endfor
                                </optgroup>
                                <optgroup label="Despesa">
                                    @for ($i = 2; $i < 21; $i++)
                                        <option value="{{$tipo_lancamentos[$i]->id}}" @if(isset($tipo_lancamentos[$i]->id)) {{ old('tipo_lancamento_id', $lancamento->tipo_lancamento_id) == $tipo_lancamentos[$i]->id ? 'selected' : '' }} @endif>{{$tipo_lancamentos[$i]->descricao}}</option>
                                    @endfor
                                </optgroup>
                            </select>
                            <span class="text-danger">{{ $errors->has('tipo_lancamento_id') ? $errors->first('tipo_lancamento_id') : '' }}</span>
                        </div>
                        <div class="col-8">
                            <input type="text" class="form-control" name="descricao" placeholder="Descrição" value="{{$lancamento->descricao ?? old('descricao')}}">
                            <span class="text-danger">{{ $errors->has('descricao') ? $errors->first('descricao') : '' }}</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Voltar</button>
                    <button type="submit" class="btn btn-primary">Editar</button>
                </div>
            </form>
        </div>
    </div>
</div>
