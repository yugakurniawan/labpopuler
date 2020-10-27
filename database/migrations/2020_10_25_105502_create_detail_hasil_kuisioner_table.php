<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailHasilKuisionerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_hasil_kuisioner', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hasil_kuisioner_id')->constrained('hasil_kuisioner')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('jenis_pertanyaan_id')->constrained('jenis_pertanyaan')->onUpdate('cascade')->onDelete('cascade');
            $table->text('pertanyaan');
            $table->text('jawaban');
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
        Schema::dropIfExists('detail_hasil_kuisioner');
    }
}
