<div class="modal" id="adicionarEspelho">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Adicionar</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{route('espelho.store')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col">
                            <select class="form-select" name="morador_id">
                                <option value="">Unidade</option>
                                @foreach ($moradores as $morador)
                                    <option value="{{$morador->id}}">{{$morador->apartamento}} - {{$morador->nome}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{ $errors->has('morador_id') ? $errors->first('morador_id') : '' }}</span>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control" name="numero_boleto" placeholder="Número do Boleto">
                            <span class="text-danger">{{ $errors->has('numero_boleto') ? $errors->first('numero_boleto') : '' }}</span>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control" name="valor_condominio" step=".01" placeholder="Taxa do Condomínio">
                            <span class="text-danger">{{ $errors->has('valor_condominio') ? $errors->first('valor_condominio') : '' }}</span>
                        </div>
                        <div class="col">
                            <input type="date" class="form-control" name="data_vencimento" placeholder="Data de Vencimento">
                            <span class="text-danger">{{ $errors->has('data_vencimento') ? $errors->first('data_vencimento') : '' }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input type="number" class="form-control" name="valor_gas" step=".01" placeholder="Gás">
                            <span class="text-danger">{{ $errors->has('valor_gas') ? $errors->first('valor_gas') : '' }}</span>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control" name="valor_agua" step=".01" placeholder="Água">
                            <span class="text-danger">{{ $errors->has('valor_agua') ? $errors->first('valor_agua') : '' }}</span>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control" name="valor_lixo" step=".01" placeholder="Lixo">
                            <span class="text-danger">{{ $errors->has('valor_lixo') ? $errors->first('valor_lixo') : '' }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <select class="form-select" name="status">
                                <option value="">Pagamento</option>
                                <option value="0">Em aberto</option>
                                <option value="1">Pago</option>
                            </select>
                            <span class="text-danger">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control" name="valor_multa" step=".01" placeholder="Multa">
                            <span class="text-danger">{{ $errors->has('valor_multa') ? $errors->first('valor_multa') : '' }}</span>
                        </div>
                        <div class="col">
                            <input type="number" class="form-control" name="valor_juros" step=".01" placeholder="Juros">
                            <span class="text-danger">{{ $errors->has('valor_juros') ? $errors->first('valor_juros') : '' }}</span>
                        </div>
                        <div class="col">
                            <input type="date" class="form-control" name="data_pagamento" placeholder="Data de Pagamento">
                            <span class="text-danger">{{ $errors->has('data_pagamento') ? $errors->first('data_pagamento') : '' }}</span>
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
