@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <form action="{{route('demonstrativo.index')}}" method="GET">
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
    <div class="card my-4">
        <div class="card-header">Demonstrativo</div>
        <div class="card-body">
            @if (count($espelhos) == 0 && count($lancamentos) == 0 && $mes && $ano)
                <div class="d-flex justify-content-center">
                    <img src="{{asset('img/sem_registros.png')}}" class="img_sem_registros" alt="Sem registros">
                </div>
                <div class="d-flex justify-content-center">
                    Nada encontrado no mês {{$mes}} do ano de {{$ano}}. Procure novamente.
                </div>
            @elseif (count($espelhos) == 0 && count($lancamentos) == 0 && $mes)
                <div class="d-flex justify-content-center">
                    <img src="{{asset('img/sem_registros.png')}}" class="img_sem_registros" alt="Sem registros">
                </div>
                <div class="d-flex justify-content-center">
                    Nada encontrado no mês {{$mes}}. Procure novamente.
                </div>
            @elseif (count($espelhos) == 0 && count($lancamentos) == 0 && $ano)
                <div class="d-flex justify-content-center">
                    <img src="{{asset('img/sem_registros.png')}}" class="img_sem_registros" alt="Sem registros">
                </div>
                <div class="d-flex justify-content-center">
                    Nada encontrado no ano de {{$ano}}. Procure novamente.
                </div>
            @else
                <table class="table table-hover" style="border-left: 1px solid #dee2e6; border-right: 1px solid #dee2e6;">
                    <thead class="table-dark">
                        <tr>
                            <th colspan="2" style="text-align: center">RECEITAS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-5">Taxa de Condomínio</td>
                            <td>R${{number_format($espelhos->sum('valor_condominio'), 2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td class="px-5">Fundo de Reserva</td>
                            <td>R${{number_format($espelhos->sum('valor_fundo_reserva'), 2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td class="px-5">Consumo de Gás</td>
                            <td>R${{number_format($espelhos->sum('valor_gas'), 2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td class="px-5">Consumo Água / Esgoto / Lixo</td>
                            <td>R${{number_format($espelhos->sum('valor_agua') + $espelhos->sum('valor_lixo'), 2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td class="px-5">Cobrança de Juro / Multa / C Monetária</td>
                            <td>R${{number_format($espelhos->sum('valor_multa') + $espelhos->sum('valor_juros'), 2, ',', '.')}}</td>
                        </tr>
                        @for ($i = 0; $i < 2; $i++)
                            <tr>
                                <td class="px-5">{{$tipo_lancamentos[$i]->descricao}}</td>
                                <td>R${{number_format($lancamentos->where('tipo_lancamento_id', $i+1)->sum('valor'), 2, ',', '.')}}</td>
                            </tr>
                        @endfor
                        <tr class="table-secondary">
                            <td class="px-5"></td>
                            <td>R${{number_format($lancamentos->where('tipo_gasto', 0)->sum('valor') + $espelhos->sum('valor_multa') + $espelhos->sum('valor_juros') + $espelhos->sum('valor_agua') + $espelhos->sum('valor_lixo') + $espelhos->sum('valor_gas') + $espelhos->sum('valor_fundo_reserva') + $espelhos->sum('valor_condominio'), 2, ',', '.')}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-hover" style="border-left: 1px solid #dee2e6; border-right: 1px solid #dee2e6;">
                    <thead class="table-dark">
                        <tr>
                            <th colspan="2" style="text-align: center">DESPESAS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 2; $i < 21; $i++)
                            <tr>
                                <td class="px-5">{{$tipo_lancamentos[$i]->descricao}}</td>
                                <td>R${{number_format($lancamentos->where('tipo_lancamento_id', $i+1)->sum('valor'), 2, ',', '.')}}</td>
                            </tr>
                        @endfor
                        <tr class="table-secondary">
                            <td></td>
                            <td>R${{number_format($lancamentos->where('tipo_gasto', 1)->sum('valor'), 2, ',', '.')}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table table-hover" style="border-left: 1px solid #dee2e6; border-right: 1px solid #dee2e6;">
                    <thead class="table-dark">
                        <tr>
                            <th colspan="2" style="text-align: center">SALDO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="px-5">Total de Receitas</td>
                            <td>R${{number_format($lancamentos->where('tipo_gasto', 0)->sum('valor') + $espelhos->sum('valor_multa') + $espelhos->sum('valor_juros') + $espelhos->sum('valor_agua') + $espelhos->sum('valor_lixo') + $espelhos->sum('valor_gas') + $espelhos->sum('valor_fundo_reserva') + $espelhos->sum('valor_condominio'), 2, ',', '.')}}</td>
                        </tr>
                        <tr>
                            <td class="px-5">Total de Despesas</td>
                            <td>R${{number_format($lancamentos->where('tipo_gasto', 1)->sum('valor'), 2, ',', '.')}}</td>
                        </tr>
                        <tr class="table-secondary">
                            <td class="px-5"></td>
                            <td>R${{number_format($lancamentos->where('tipo_gasto', 0)->sum('valor') + $espelhos->sum('valor_multa') + $espelhos->sum('valor_juros') + $espelhos->sum('valor_agua') + $espelhos->sum('valor_lixo') + $espelhos->sum('valor_gas') + $espelhos->sum('valor_fundo_reserva') + $espelhos->sum('valor_condominio') - $lancamentos->where('tipo_gasto', 1)->sum('valor'), 2, ',', '.')}}</td>
                        </tr>
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection
