<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use GuzzleHttp\Client;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class ClienteController extends Controller
{
    public function update($clienteid, Request $request)
    {
        $cliente = Cliente::find($clienteid);
        if (!$cliente) {
            return response()->json([
                'message' => 'Registro nao encontrado'
            ]);
        };
        try {
            $validateur = Validator::make($request->all(), [
                'cpf' => 'required',
                'nome' => 'required',
                'data_nascimento' => 'required',
                'sexo' => 'required',
                'estado' => 'required',
                'cidade' => 'required',
                'endereco' => 'required',
            ]);
            $validateur->validate();
            $cliente->fill($request->all());
            $cliente->save();

            return response()->json(['sucess' => 'salvo com sucesso'], 201);
        } catch (ValidationException $e) {
            $erros = $e->validator->errors();
            return response()->json(['erro' => 'Os dados são inválidos, por favor preencha os campos corretamente' . $e->getMessage()], 422);
        } catch (\Exception $e) {
            error_log($e->getMessage());

            return response()->json(['erro' => 'Pedimos desculpas, ocorreu um erro no servidor. Por favor, tente novamente mais tarde.' . $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'cpf' => 'required',
                'nome' => 'required',
                'data_nascimento' => 'required',
                'sexo' => 'required',
                'estado' => 'required',
                'cidade' => 'required',
                'endereco' => 'required',
            ]);

            $validator->validate();
            $cliente = new Cliente();
            $cliente->fill($request->all());
            $cliente->save();

            return response()->json(['sucess' => 'salvo com sucesso'], 201);
        } catch (ValidationException $e) {
            $erros = $e->validator->errors();
            return response()->json(['erro' => 'Os dados são inválidos, por favor preencha os campos corretamente'], 422);
        } catch (\Exception $e) {
            error_log($e->getMessage());

            return response()->json(['erro' => 'Pedimos desculpas, ocorreu um erro no servidor. Por favor, tente novamente mais tarde.' . $e->getMessage()], 500);
        }
    }

    public function teste(Request $request)
    {
        return response()->json(['jallleeee' => 'jall'], 201);
    }

    public function edit($id)
    {
        return response()->json(['datwwf' => 'jall2'], 201);
    }

    public function show($id)
    {
        $cliente = Cliente::find($id);
        return response()->json(['cliente' => $cliente]);
    }

    public function lista()
    {
        $cliente = Cliente::paginate(5);
        return response()->json($cliente);
    }

    public function listatodos()
    {
        $cliente = Cliente::all();
        return response()->json($cliente);
    }

    public function delete($clienteid)
    {
        try {
            Cliente::where('id', $clienteid)->delete();
            return response()->json(['Sucesso' => 'Registro deletado com sucesso']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Nao foi possivel deletar o usuario!! ',
            ]);
        }
    }
}
