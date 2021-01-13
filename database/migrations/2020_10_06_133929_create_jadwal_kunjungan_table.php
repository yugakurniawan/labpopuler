<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJadwalKunjunganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_kunjungan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('dokter_id',4)->default('');
            $table->timestamp('jadwal');
            $table->boolean('status')->default(0);
            $table->boolean('dilihat_marketing')->default(0);
            $table->boolean('dilihat_dokter')->default(0);
            $table->boolean('dilihat_manager_marketing')->default(0);
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
        Schema::dropIfExists('jadwal_kunjungan');
    }
}
