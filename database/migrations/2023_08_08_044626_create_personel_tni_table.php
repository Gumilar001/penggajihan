<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonelTniTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personel_tni', function (Blueprint $table) {
            $table->id();
            $table->string('nrp');
            $table->string('nama_tni');
            $table->date('tgl_lahir');
            $table->string('npwp');
            $table->tinyInteger('status_menikah')->default(0);
            $table->bigInteger('jumlah_anak')->nullable();
            $table->double('gajih_pokok');
            $table->bigInteger('id_pangkat_tni')->unsigned()->index();
            $table->string('no_whatsapp');
            $table->timestamps();
        });

        Schema::table('personel_tni', function ($table) {
            $table->foreign('id_pangkat_tni')
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
        Schema::dropIfExists('personel_tni');
    }
}
