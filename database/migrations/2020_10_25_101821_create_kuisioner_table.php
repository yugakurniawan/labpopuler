<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKuisionerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kuisioner', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jenis_pertanyaan_id')->constrained('jenis_pertanyaan')->onUpdate('cascade')->onDelete('cascade');
            $table->text('pertanyaan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kuisioner');
    }
}
