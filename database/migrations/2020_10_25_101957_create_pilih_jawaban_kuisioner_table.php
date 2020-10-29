<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePilihJawabanKuisionerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pilih_jawaban_kuisioner', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kuisioner_id')->constrained('kuisioner')->onUpdate('cascade')->onDelete('cascade');
            $table->text('opsi');
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
        Schema::dropIfExists('pilih_jawaban_kuisioner');
    }
}
