<?php

namespace App\Http\Controllers;

use App\Models\Espelho;
use App\Models\Lancamento;
use App\Models\Tipo_lancamento;
use Illuminate\Http\Request;

class DemonstrativoController extends Controller
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
            $espelhos = Espelho::where('data_vencimento', 'like', $ano.'-'.$mes.'-%')->where('status', 1)->get();
            $lancamentos = Lancamento::where('data', 'like', $ano.'-'.$mes.'-%')->get();
        } elseif($mes) {
            $espelhos = Espelho::where('data_vencimento', 'like', '%-'.$mes.'-%')->where('status', 1)->get();
            $lancamentos = Lancamento::where('data', 'like', '%-'.$mes.'-%')->get();
        } elseif($ano) {
            $espelhos = Espelho::where('data_vencimento', 'like', $ano.'-%-%')->where('status', 1)->get();
            $lancamentos = Lancamento::where('data', 'like', $ano.'-%-%')->get();
        } else {
            $espelhos = Espelho::where('status', 1)->get();
            $lancamentos = Lancamento::get();
        }

        $tipo_lancamentos = Tipo_lancamento::get();

        return view('demonstrativo.index', [
            'espelhos' => $espelhos,
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Demonstrativo  $demonstrativo
     * @return \Illuminate\Http\Response
     */
    public function show(Demonstrativo $demonstrativo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Demonstrativo  $demonstrativo
     * @return \Illuminate\Http\Response
     */
    public function edit(Demonstrativo $demonstrativo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Demonstrativo  $demonstrativo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Demonstrativo $demonstrativo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Demonstrativo  $demonstrativo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Demonstrativo $demonstrativo)
    {
        //
    }
}
