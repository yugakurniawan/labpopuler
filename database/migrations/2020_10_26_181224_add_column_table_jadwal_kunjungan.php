<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnTableJadwalKunjungan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('jadwal_kunjungan', function (Blueprint $table) {
            $table->boolean('dilihat_marketing')->default(0)->after('status');
            $table->boolean('dilihat_dokter')->default(0)->after('dilihat_marketing');
            $table->boolean('dilihat_manager_marketing')->default(0)->after('dilihat_dokter');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('jadwal_kunjungan', function (Blueprint $table) {
            $table->dropColumn(['dilihat_marketing','dilihat_dokter','dilihat_manager_marketing']);
        });
    }
}
