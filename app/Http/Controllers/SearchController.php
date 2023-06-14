<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Models\Cliente;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $request->password;
        $cpf = $request->cpf;
        $estado = $request->estado;
        $cidade = $request->cidade;
        $data_nascimento = $request->data_nascimento;
        $nome = $request->nome;
        $sexo = $request->sexo;
        $Cliente = Cliente::where(
            'nome',
            'LIKE',
            '%' . $nome . '%'
        )
            ->Where('cpf', 'LIKE', '%' . $cpf . '%')
            ->Where('cidade', 'LIKE', '%' . $cidade . '%')
            ->Where('estado', 'LIKE', '%' . $estado . '%')
            ->Where('data_nascimento', 'LIKE', '%' . $data_nascimento . '%')
            ->Where('nome', 'LIKE', '%' . $nome . '%')
            ->Where('sexo', 'LIKE', '%' . $sexo . '%')

            ->paginate(5);
        return response()->json($Cliente);
    }
}
