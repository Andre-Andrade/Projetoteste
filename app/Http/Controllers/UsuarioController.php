<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Validation\ValidationException;

class UsuarioController extends Controller
{
    public function authenticar(Request $request)
    {
        try {
            $validateur = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required|min:3'
            ]);
            $validateur->validate();
            $usuario = Usuario::where('email', $request->email)->first();
            if (!$usuario) {
                throw new \Exception('usuario nao existe.');
            }
            if (!Hash::check($request->password, $usuario->password)) {
                throw new \Exception('Password incorreta');
            }
            $token = JWTAuth::fromUser($usuario);
            return response()->json([
                'status' => 'success',
                'usuario' => $usuario,
                'token' => $token,
            ], 201);
        } catch (ValidationException $e) {
            return response()->json(['erro' => 'error email ou password incorreto'], 422);
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return response()->json(['error' => 'Falha no login'], 422);
        }
    }

    public function store(Request $request)
    {
        try {
            $validateur = Validator::make($request->all(), [
                'nome' => 'required',
                'email' => 'required|email',
                'password' => 'required|min:3',
                'password_confirmation' => 'required|same:password',
            ]);

            $validateur->validate();
            $usuario = new Usuario;
            $usuario->fill($request->all());
            $usuario->password = Hash::make($request->password);
            $usuario->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Usuario cadastrado com sucesso.',
                'usuario' => $usuario,

            ], 201);
        } catch (ValidationException $e) {
            $erros = $e->validator->errors();
            if ($erros->has('email')) {
                return response()->json(['message' => 'Já existe um usuário com este endereço de e-mail.'], 422);
            } else {
                return response()->json(['message' => 'Os dados são inválidos, por favor preencha os campos corretamente'], 422);
            }
        } catch (\Exception $e) {
            error_log($e->getMessage());

            return response()->json(['message' => 'Pedimos desculpas, ocorreu um erro no servidor. Por favor, tente novamente mais tarde.' . $e->getMessage()], 500);
        }
    }
    public function update($usuarioid, Request $request)
    {
        try {
            $validateur = Validator::make($request->all(), [
                'nome' => 'required',
                'email' => 'required|email',
            ]);
            $validateur->validate();
            $usuario = Usuario::findOrFail($usuarioid);
            $usuario->nome = $request->nome;
            $usuario->email = $request->email;
            if (trim($request->password) != trim($request->password_confirmation)) {
                return response()->json(['erro' => 'Password e confirmacao diferente !.'], 422);
            } elseif (trim(strlen($request->password)) <= 3 and trim($request->password) != '') {
                return response()->json(['erro' => 'Password deve contem no minimo 3 caracteres !.'], 422);
            } elseif (trim($request->password) != '') {
                $usuario->password = Hash::make($request->password);
            }
            $usuario->update();

            return response()->json([
                'status' => 'success',
                'message' => 'A conta foi criada com sucesso.',
                'usuario' => $usuario,
            ], 201);
        } catch (ValidationException $e) {
            $erros = $e->validator->errors();
            if ($erros->has('email')) {
                return response()->json(['erro' => 'Já existe um usuário com este endereço de e-mail.' . $e->getMessage()], 422);
            } else {
                return response()->json(['erro' => 'Os dados são inválidos, por favor preencha os campos corretamente'], 422);
            }
        } catch (\Exception $e) {
            error_log($e->getMessage());
            return response()->json(['erro' => 'Pedimos desculpas, ocorreu um erro no servidor. Por favor, tente novamente mais tarde.' . $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $usuario = usuario::find($id);
        return response()->json(['usuario' => $usuario]);
    }

    public function lista()
    {
        // $reembolso = Reembolso::all();
        $usuario = Usuario::paginate(5);
        return response()->json($usuario);
    }
    public function listatodos()
    {
        $empresa = Usuario::all();
        //$empresa = Empresa::paginate(5);
        return response()->json($empresa);
    }

    public function delete($usuarioid)
    {
        try {
            Usuario::where('id', $usuarioid)->delete();
            return response()->json(['Sucesso' => 'Registro deletado com sucesso']);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Nao foi possivel deletar o usuario!! ',
            ]);
        }
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'Usuario deslogado com sucesso']);
    }
}
