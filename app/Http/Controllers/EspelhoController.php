<?php

namespace App\Http\Controllers;

use App\Models\Espelho;
use App\Models\Morador;
use Illuminate\Http\Request;

class EspelhoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mes = request('mes');
        $ano = request('ano');

        if ($mes && $ano) {
            $espelhos = Espelho::where('data_vencimento', 'like', $ano.'-'.$mes.'-%')->orderBy('numero_boleto')->get();
        } elseif($mes) {
            $espelhos = Espelho::where('data_vencimento', 'like', '%-'.$mes.'-%')->orderBy('numero_boleto')->get();
        } elseif($ano) {
            $espelhos = Espelho::where('data_vencimento', 'like', $ano.'-%-%')->orderBy('numero_boleto')->get();
        } else {
            $espelhos = Espelho::orderBy('numero_boleto')->get();
        }

        $moradores = Morador::all();
        $morador_sindico = Morador::where('funcao', 1)->first();
        $espelho_sindico = Espelho::where('morador_id', $morador_sindico->id)->get();
        return view('espelho.index', [
            'espelhos' => $espelhos,
            'moradores' => $moradores,
            'morador_sindico' => $morador_sindico,
            'espelho_sindico' => $espelho_sindico,
            'mes' => $mes,
            'ano' => $ano

        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'morador_id' => 'required|exists:moradores,id',
            'numero_boleto' => 'required|numeric',
            'valor_condominio' => 'required|numeric',
            'data_vencimento' => 'required',
            'valor_gas' => 'required|numeric',
            'valor_agua' => 'required|numeric',
            'valor_lixo' => 'required|numeric',
            'status' => 'required',
            'valor_multa' => $request->valor_multa != null ? 'numeric' : '',
            'valor_juros' => $request->valor_juros != null ? 'numeric' : '',
            'data_pagamento' => $request->status == 1 ? 'required' : ''
        ],
        [
            'required' => 'Preenchimento obrigatório',
            'morador_id.exists' => 'O item não existe',
            'numeric' => 'O valor deve ser númerico',
        ]);

        $sindico = Morador::where('funcao', 1)->first();
        $valor_fundo_reserva = $request->valor_condominio * 0.1;
        if ($request->morador_id == $sindico->id) {
            $valor_total = $request->valor_gas + $request->valor_agua + $request->valor_lixo + $request->valor_multa + $request->valor_juros + $valor_fundo_reserva;
        } else {
            $valor_total = $request->valor_condominio + $request->valor_gas + $request->valor_agua + $request->valor_lixo + $request->valor_multa + $request->valor_juros + $valor_fundo_reserva;
        }

        if($request->data_vencimento >= $request->data_pagamento && $request->status == 1){
            $valor_juros = 0;
            $valor_multa = 0;
        } else {
            $valor_juros = $request->valor_juros;
            $valor_multa = $request->valor_multa;
        }

        if($request->status == 0){
            $request->data_pagamento = null;
        }

        $espelho = Espelho::create([
            'morador_id' => $request->morador_id,
            'numero_boleto' => $request->numero_boleto,
            'valor_condominio' => $request->valor_condominio,
            'data_vencimento' => $request->data_vencimento,
            'valor_fundo_reserva' => $valor_fundo_reserva,
            'valor_total' => $valor_total,
            'valor_gas' => $request->valor_gas,
            'valor_agua' => $request->valor_agua,
            'valor_lixo' => $request->valor_lixo,
            'status' => $request->status,
            'valor_multa' => $valor_multa,
            'valor_juros' => $valor_juros,
            'data_pagamento' => $request->data_pagamento
        ]);

        return redirect()->route('espelho.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Espelho  $espelho
     * @return \Illuminate\Http\Response
     */
    public function show(Espelho $espelho)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Espelho  $espelho
     * @return \Illuminate\Http\Response
     */
    public function edit(Espelho $espelho)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Espelho  $espelho
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Espelho $espelho)
    {
        request()->validate([
            'morador_id' => 'required|exists:moradores,id',
            'numero_boleto' => 'required|numeric',
            'valor_condominio' => 'required|numeric',
            'data_vencimento' => 'required',
            'valor_gas' => 'required|numeric',
            'valor_agua' => 'required|numeric',
            'valor_lixo' => 'required|numeric',
            'status' => 'required',
            'valor_multa' => $request->valor_multa != null ? 'numeric' : '',
            'valor_juros' => $request->valor_juros != null ? 'numeric' : '',
            'data_pagamento' => $request->status == 1 ? 'required' : ''
        ],
        [
            'required' => 'Preenchimento obrigatório',
            'morador_id.exists' => 'O item não existe',
            'numeric' => 'O valor deve ser númerico',
        ]);

        $sindico = Morador::where('funcao', 1)->first();
        $valor_fundo_reserva = $request->valor_condominio * 0.1;
        if ($request->morador_id == $sindico->id) {
            $valor_total = $request->valor_gas + $request->valor_agua + $request->valor_lixo + $request->valor_multa + $request->valor_juros + $valor_fundo_reserva;
        } else {
            $valor_total = $request->valor_condominio + $request->valor_gas + $request->valor_agua + $request->valor_lixo + $request->valor_multa + $request->valor_juros + $valor_fundo_reserva;
        }

        if($request->data_vencimento >= $request->data_pagamento && $request->status == 1){
            $valor_juros = 0;
            $valor_multa = 0;
        } else {
            $valor_juros = $request->valor_juros;
            $valor_multa = $request->valor_multa;
        }

        if($request->status == 0){
            $request->data_pagamento = null;
        }

        $espelho->update([
            'morador_id' => $request->morador_id,
            'numero_boleto' => $request->numero_boleto,
            'valor_condominio' => $request->valor_condominio,
            'data_vencimento' => $request->data_vencimento,
            'valor_fundo_reserva' => $valor_fundo_reserva,
            'valor_total' => $valor_total,
            'valor_gas' => $request->valor_gas,
            'valor_agua' => $request->valor_agua,
            'valor_lixo' => $request->valor_lixo,
            'status' => $request->status,
            'valor_multa' => $valor_multa,
            'valor_juros' => $valor_juros,
            'data_pagamento' => $request->data_pagamento
        ]);

        return redirect()->route('espelho.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Espelho  $espelho
     * @return \Illuminate\Http\Response
     */
    public function destroy(Espelho $espelho)
    {
        $espelho->delete();
        return redirect()->route('espelho.index');
    }
}
