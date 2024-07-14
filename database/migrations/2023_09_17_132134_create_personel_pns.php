<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonelPns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personel_pns', function (Blueprint $table) {
            $table->id();
            $table->string('nrp');
            $table->string('nama_pns');
            $table->date('tgl_lahir');
            $table->string('npwp');
            $table->tinyInteger('status_menikah')->default(0);
            $table->bigInteger('jumlah_anak')->nullable();
            $table->double('gajih_pokok');
            $table->string('no_whatsapp')->nullable();
            $table->bigInteger('id_pangkat')->unsigned()->index();
            $table->timestamps();
        });
        Schema::table('personel_pns', function ($table) {
            $table->foreign('id_pangkat')
            ->references('id')
            ->on('pangkat');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personel_pns');
    }
}
