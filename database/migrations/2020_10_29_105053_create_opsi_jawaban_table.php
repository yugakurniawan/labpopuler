<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpsiJawabanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opsi_jawaban', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hasil_kuisioner_id')->constrained('hasil_kuisioner')->onUpdate('cascade')->onDelete('cascade');
            $table->text('opsi')->nullable();
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
        Schema::dropIfExists('opsi_jawaban');
    }
}
