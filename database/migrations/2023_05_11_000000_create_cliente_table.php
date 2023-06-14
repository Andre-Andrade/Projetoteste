<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id();
            $table->text('cpf')->unique();
            $table->date('data_nascimento');
            $table->string('endereco');
            $table->string('estado');
            $table->string('cidade');
            //   $table->char('sexo', 1);
            $table->enum('sexo', array('M', 'F'));
            $table->timestamps();

            // cpf,nome,data_nascimento,endereco,sexo,estado,cidade
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
