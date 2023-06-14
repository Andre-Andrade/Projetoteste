<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use ESolution\DBEncryption\Traits\EncryptedAttribute;

class Cliente extends Model
{
    use    HasFactory, EncryptedAttribute;

    public $timestamps = false;

    protected $fillable = ['cpf', 'nome', 'data_nascimento', 'endereco', 'sexo', 'estado', 'cidade'];

    protected $encryptable = [
        'cnpj'
    ];
}
