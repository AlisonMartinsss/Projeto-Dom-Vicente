<div class="modal" id="editar-{{$espelho->id}}">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Editar</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form method="POST" action="{{route('espelho.update', $espelho->id)}}">
                @method('PATCH')
                @csrf
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col">
                            <select class="form-select" name="morador_id">
                                <option value="">Unidade</option>
                                @foreach ($moradores as $morador)
                                    <option value="{{$morador->id}}" @if(isset($morador->id)) {{ old('morador_id', $espelho->morador_id) == $morador->id ? 'selected' : '' }} @endif>
                                        {{$morador->apartamento}} - {{$morador->nome}}
                                    </option>
                                @endforeach
                            </select>
                            <span class="text-danger">{{ $errors->has('morador_id') ? $errors->first('morador_id') : '' }}</span>
                        </div>
                        <div class="col">
                            <input type="number" name="numero_boleto" class="form-control" placeholder="Número do Boleto" value="{{$espelho->numero_boleto ?? old('numero_boleto')}}">
                            <span class="text-danger">{{ $errors->has('numero_boleto') ? $errors->first('numero_boleto') : '' }}</span>
                        </div>
                        <div class="col">
                            <input type="number" name="valor_condominio" step=".01" class="form-control" placeholder="Taxa do Condomínio" value="{{$espelho->valor_condominio ?? old('valor_condominio')}}">
                            <span class="text-danger">{{ $errors->has('valor_condominio') ? $errors->first('valor_condominio') : '' }}</span>
                        </div>
                        <div class="col">
                            <input type="date" name="data_vencimento" step=".01" class="form-control" value="{{$espelho->data_vencimento ?? old('data_vencimento')}}">
                            <span class="text-danger">{{ $errors->has('data_vencimento') ? $errors->first('data_vencimento') : '' }}</span>
                        </div>
                        <input type="hidden" name="valor_fundo_reserva" class="form-control" value="">
                        <input type="hidden" name="valor_total" class="form-control" value="">
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <input type="number" name="valor_gas" step=".01" class="form-control" placeholder="Gás" value="{{$espelho->valor_gas ?? old('valor_gas')}}">
                            <span class="text-danger">{{ $errors->has('valor_gas') ? $errors->first('valor_gas') : '' }}</span>
                        </div>
                        <div class="col">
                            <input type="number" name="valor_agua" step=".01" class="form-control" placeholder="Água" value="{{$espelho->valor_agua ?? old('valor_agua')}}">
                            <span class="text-danger">{{ $errors->has('valor_agua') ? $errors->first('valor_agua') : '' }}</span>
                        </div>
                        <div class="col">
                            <input type="number" name="valor_lixo" step=".01" class="form-control" placeholder="Taxa de Lixo" value="{{$espelho->valor_lixo ?? old('valor_lixo')}}">
                            <span class="text-danger">{{ $errors->has('valor_lixo') ? $errors->first('valor_lixo') : '' }}</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <select class="form-select" name="status">
                                <option value="">Pagamento</option>
                                <option value="0" {{ $espelho->status == 0 ? "selected='selected'" : ""}}>Em aberto</option>
                                <option value="1" {{ $espelho->status == 1 ? "selected='selected'" : ""}}>Pago</option>
                            </select>
                            <span class="text-danger">{{ $errors->has('status') ? $errors->first('status') : '' }}</span>
                        </div>
                        <div class="col">
                            <input type="number" name="valor_multa" step=".01" class="form-control" placeholder="Multa" value="{{$espelho->valor_multa ?? old('valor_multa')}}">
                            <span class="text-danger">{{ $errors->has('valor_multa') ? $errors->first('valor_multa') : '' }}</span>
                        </div>
                        <div class="col">
                            <input type="number" name="valor_juros" step=".01" class="form-control" placeholder="Juros" value="{{$espelho->valor_juros ?? old('valor_juros')}}">
                            <span class="text-danger">{{ $errors->has('valor_juros') ? $errors->first('valor_juros') : '' }}</span>
                        </div>
                        <div class="col">
                            <input type="date" name="data_pagamento" class="form-control" value="{{$espelho->data_pagamento ?? old('data_pagamento')}}">
                            <span class="text-danger">{{ $errors->has('data_pagamento') ? $errors->first('data_pagamento') : '' }}</span>
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
