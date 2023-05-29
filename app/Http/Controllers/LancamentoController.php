<?php

namespace App\Http\Controllers;

use App\Models\Lancamento;
use App\Models\Tipo_lancamento;
use Illuminate\Http\Request;

class LancamentoController extends Controller
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
            $lancamentos = Lancamento::where('data', 'like', $ano.'-'.$mes.'-%')->orderBy('data')->get();
        } elseif($mes) {
            $lancamentos = Lancamento::where('data', 'like', '%-'.$mes.'-%')->orderBy('data')->get();
        } elseif($ano) {
            $lancamentos = Lancamento::where('data', 'like', $ano.'-%-%')->orderBy('data')->get();
        } else {
            $lancamentos = Lancamento::orderBy('data')->get();
        }

        $tipo_lancamentos = Tipo_lancamento::all();

        return view('lancamento.index', [
            'lancamentos' => $lancamentos,
            'tipo_lancamentos' => $tipo_lancamentos,
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
            'data' => 'required',
            'valor' => 'required|numeric',
            'tipo_gasto' => 'required',
            'tipo_lancamento_id' => 'required|exists:tipo_lancamentos,id',
            'descricao' => 'required'
        ],
        [
            'required' => 'Preenchimento obrigatório',
            'tipo_lancamento_id.exists' => 'O item não existe',
            'numeric' => 'O valor deve ser númerico',
        ]);

        $lancamento = Lancamento::create([
            'data' => $request->data,
            'valor' => $request->valor,
            'tipo_gasto' => $request->tipo_gasto,
            'tipo_lancamento_id' => $request->tipo_lancamento_id,
            'descricao' => $request->descricao
        ]);

        return redirect()->route('lancamento.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lancamento  $lancamento
     * @return \Illuminate\Http\Response
     */
    public function show(Lancamento $lancamento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lancamento  $lancamento
     * @return \Illuminate\Http\Response
     */
    public function edit(Lancamento $lancamento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lancamento  $lancamento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lancamento $lancamento)
    {
        request()->validate([
            'data' => 'required',
            'valor' => 'required|numeric',
            'tipo_gasto' => 'required',
            'tipo_lancamento_id' => 'required|exists:tipo_lancamentos,id',
            'descricao' => 'required'
        ],
        [
            'required' => 'Preenchimento obrigatório',
            'tipo_lancamento_id.exists' => 'O item não existe',
            'numeric' => 'O valor deve ser númerico'
        ]);

        $lancamento->update([
            'data' => $request->data,
            'valor' => $request->valor,
            'tipo_gasto' => $request->tipo_gasto,
            'tipo_lancamento_id' => $request->tipo_lancamento_id,
            'descricao' => $request->descricao
        ]);

        return redirect()->route('lancamento.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lancamento  $lancamento
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lancamento $lancamento)
    {
        $lancamento->delete();
        return redirect()->route('lancamento.index');
    }
}
