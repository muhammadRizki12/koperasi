<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('savings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            // $table->enum('description', ['simpan', 'tarik']);
            $table->enum('description', ['simpanan pokok', 'simpanan wajib', 'simpanan sukarela', 'tarik tunai']);
            $table->date('savings_date');
            $table->bigInteger('amount');

            // Join table
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mandatory_savings');
    }
};
