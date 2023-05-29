@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <form action="{{route('lancamento.index')}}" method="GET">
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
        <div class="card-header">Lançamentos</div>
        <div class="card-body">
            @if (count($lancamentos) == 0 && $mes && $ano)
                <div class="d-flex justify-content-center">
                    <img src="{{asset('img/sem_registros.png')}}" class="img_sem_registros" alt="Sem registros">
                </div>
                <div class="d-flex justify-content-center">
                    Nada encontrado no mês {{$mes}} do ano de {{$ano}}. Procure novamente.
                </div>
            @elseif (count($lancamentos) == 0 && $mes)
                <div class="d-flex justify-content-center">
                    <img src="{{asset('img/sem_registros.png')}}" class="img_sem_registros" alt="Sem registros">
                </div>
                <div class="d-flex justify-content-center">
                    Nada encontrado no mês {{$mes}}. Procure novamente.
                </div>
            @elseif (count($lancamentos) == 0 && $ano)
                <div class="d-flex justify-content-center">
                    <img src="{{asset('img/sem_registros.png')}}" class="img_sem_registros" alt="Sem registros">
                </div>
                <div class="d-flex justify-content-center">
                    Nada encontrado no ano de {{$ano}}. Procure novamente.
                </div>
            @elseif (count($lancamentos) == 0)
                <div class="d-flex justify-content-center">
                    <img src="{{asset('img/sem_registros.png')}}" class="img_sem_registros" alt="Sem registros">
                </div>
                <div class="d-flex justify-content-center">
                    Nenhum dado cadastrado.
                </div>
            @else
                <table class="table table-hover"
                    style="text-align: center; border-left: 1px solid #dee2e6; border-right: 1px solid #dee2e6;">
                    <thead class="table-dark">
                        <tr>
                            <th>Data</th>
                            <th>Descrição</th>
                            <th>Tipo de Gasto</th>
                            <th>Valor</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lancamentos as $lancamento)
                            <tr>
                                <td>{{date('d/m/Y', strtotime($lancamento->data))}}</td>
                                <td>{{$lancamento->descricao}}</td>
                                <td>{{$lancamento->tipo_gasto == 0 ? 'Receita' : 'Despesa'}}</td>
                                <td>R${{number_format($lancamento->valor, 2, ',', '.')}}</td>
                                <td>
                                    <a href="" data-bs-toggle="modal" data-bs-target="#editar-{{$lancamento->id}}"><img src="img/pencil.png" alt="Icone para edição" class="icones_tabela"></a>
                                    @include('lancamento.edit')
                                </td>
                                <td>
                                    <a href="" data-bs-toggle="modal" data-bs-target="#remover-{{$lancamento->id}}"><img src="img/delete.png" alt="Icone para remoção" class="icones_tabela mx-2"></a>
                                    @include('lancamento.delete')
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
        <div class="card-footer">
            <span class="float-end">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#adicionarLancamento">Adicionar</button>
                @include('lancamento.create')
            </span>
        </div>
    </div>
</div>
@endsection
