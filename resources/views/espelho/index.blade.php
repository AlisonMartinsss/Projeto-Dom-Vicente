@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <form action="{{route('espelho.index')}}" method="GET">
        <div class="card">
            <div class="card-header">Buscar</div>
            <div class="card-body">
                <div class="row mt-3">
                    <div class="col-6">
                        <select class="form-select" name="mes">
                            <option value="">Selecione o mês</option>
                            <option value="01">Janeiro</option>
                            <option value="02">Fevereiro</option>
                            <option value="03">Março</option>
                            <option value="04">Abril</option>
                            <option value="05">Maio</option>
                            <option value="06">Junho</option>
                            <option value="07">Julho</option>
                            <option value="08">Agosto</option>
                            <option value="09">Setembro</option>
                            <option value="10">Outubro</option>
                            <option value="11">Novembro</option>
                            <option value="12">Dezembro</option>
                        </select>
                    </div>
                    <div class="col-6">
                        <select class="form-select" name="ano">
                            <option value="">Selecione o ano</option>
                            <option value="2021">2021</option>
                            <option value="2022">2022</option>
                            <option value="2023">2023</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <span class="float-end">
                    <button type="submit" class="btn btn-primary">Procurar</button>
                </span>
            </div>
        </div>
    </form>

    <div class="card mt-4">
        <div class="card-header">Espelhos</div>
        <div class="card-body">
            @if (count($espelhos) == 0 && $mes && $ano)
                <div class="d-flex justify-content-center">
                    <img src="{{asset('img/sem_registros.png')}}" class="img_sem_registros" alt="Sem registros">
                </div>
                <div class="d-flex justify-content-center">
                    Nada encontrado no mês {{$mes}} do ano de {{$ano}}. Procure novamente.
                </div>
            @elseif (count($espelhos) == 0 && $mes)
                <div class="d-flex justify-content-center">
                    <img src="{{asset('img/sem_registros.png')}}" class="img_sem_registros" alt="Sem registros">
                </div>
                <div class="d-flex justify-content-center">
                    Nada encontrado no mês {{$mes}}. Procure novamente.
                </div>
            @elseif (count($espelhos) == 0 && $ano)
                <div class="d-flex justify-content-center">
                    <img src="{{asset('img/sem_registros.png')}}" class="img_sem_registros" alt="Sem registros">
                </div>
                <div class="d-flex justify-content-center">
                    Nada encontrado no ano de {{$ano}}. Procure novamente.
                </div>
            @elseif (count($espelhos) == 0)
                <div class="d-flex justify-content-center">
                    <img src="{{asset('img/sem_registros.png')}}" class="img_sem_registros" alt="Sem registros">
                </div>
                <div class="d-flex justify-content-center">
                    Nenhum dado cadastrado.
                </div>
            @else
                <div class="table-responsive">
                    <table class="table table-hover" style="text-align: center; border-left: 1px solid #dee2e6; border-right: 1px solid #dee2e6;">
                        <thead class="table-dark">
                            <tr>
                                <th>Unidade</th>
                                <th>N° Boleto</th>
                                <th>Valor Condomínio</th>
                                <th>Fundo de Reserva</th>
                                <th>Gás</th>
                                <th>Água</th>
                                <th>Lixo</th>
                                <th>Isenção</th>
                                <th>Multa</th>
                                <th>Juros</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($espelhos as $espelho)
                                <tr>
                                    <td>{{$espelho->morador->apartamento}} - {{$espelho->morador->nome}}</td>
                                    <td>{{$espelho->numero_boleto}}</td>
                                    <td>R${{number_format($espelho->valor_condominio, 2, ',', '.')}}</td>
                                    <td>R${{number_format($espelho->valor_fundo_reserva, 2, ',', '.')}}</td>
                                    <td>R${{number_format($espelho->valor_gas, 2, ',', '.')}}</td>
                                    <td>R${{number_format($espelho->valor_agua, 2, ',', '.')}}</td>
                                    <td>R${{number_format($espelho->valor_lixo, 2, ',', '.')}}</td>
                                    <td>
                                        @if ($espelho->morador_id == $morador_sindico->id)
                                            R$-{{number_format($espelho->valor_condominio, 2, ',', '.')}}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>R${{number_format($espelho->valor_multa, 2, ',', '.')}}</td>
                                    <td>R${{number_format($espelho->valor_juros, 2, ',', '.')}}</td>
                                    <td>{{$espelho->status == 0 ? 'Em aberto' : 'Pago'}}</td>
                                    <td>R${{number_format($espelho->valor_total, 2, ',', '.')}}</td>
                                    <td>
                                        <a href="" data-bs-toggle="modal" data-bs-target="#editar-{{$espelho->id}}"><img src="img/pencil.png" alt="Icone para edição" class="icones_tabela"></a>
                                        @include('espelho.edit')
                                    </td>
                                    <td>
                                        <a href="" data-bs-toggle="modal" data-bs-target="#remover-{{$espelho->id}}"><img src="img/delete.png" alt="Icone para remoção" class="icones_tabela mx-2"></a>
                                        @include('espelho.delete')
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                            <tr class="table-secondary">
                                <td colspan="2">Total: {{$espelhos->count('numero_boleto')}}</td>
                                <td>R${{number_format($espelhos->sum('valor_condominio'), 2, ',', '.')}}</td>
                                <td>R${{number_format($espelhos->sum('valor_fundo_reserva'), 2, ',', '.')}}</td>
                                <td>R${{number_format($espelhos->sum('valor_gas'), 2, ',', '.')}}</td>
                                <td>R${{number_format($espelhos->sum('valor_agua'), 2, ',', '.')}}</td>
                                <td>R${{number_format($espelhos->sum('valor_lixo'), 2, ',', '.')}}</td>
                                <td>
                                    @if ($espelho_sindico->sum('valor_condominio') == 0)
                                        R${{number_format($espelho_sindico->sum('valor_condominio'), 2, ',', '.')}}
                                    @else
                                        R$-{{number_format($espelho_sindico->sum('valor_condominio'), 2, ',', '.')}}
                                    @endif
                                </td>
                                <td>R${{number_format($espelhos->sum('valor_multa'), 2, ',', '.')}}</td>
                                <td>R${{number_format($espelhos->sum('valor_juros'), 2, ',', '.')}}</td>
                                <td>-</td>
                                <td>R${{number_format($espelhos->sum('valor_total'), 2, ',', '.')}}</td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
        <div class="card-footer">
            <span class="float-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adicionarEspelho">Adicionar</button>
                @include('espelho.create')
            </span>
        </div>
    </div>
</div>
@endsection
