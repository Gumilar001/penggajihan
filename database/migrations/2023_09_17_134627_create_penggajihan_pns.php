<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggajihanPns extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penggajihan_pns', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_personel_pns')->unsigned()->index();
            $table->string('bulan_penggajihan')->nullable();
            $table->double('gapok')->default(0);
            $table->double('t_keluarga')->default(0);
            $table->double('t_anak')->default(0);
            $table->double('t_umum_tambahan')->default(0);
            $table->double('t_umum')->default(0);
            $table->double('t_papua')->default(0);
            $table->double('t_terpencil')->default(0);
            $table->double('t_jabatan')->default(0);
            $table->double('t_beras')->default(0);
            $table->double('t_khusus_pajak')->default(0);
            $table->double('penghasilan_kotor')->default(0);
            $table->double('pot_pembulatan')->default(0);
            $table->double('pot_beras')->default(0);
            $table->double('pot_pensiunan')->default(0);
            $table->double('pot_bpjs')->default(0);
            $table->double('pot_tht')->default(0);
            $table->double('pot_pajak_penghasilan')->default(0);
            $table->double('pot_sewa_rmh')->default(0);
            $table->double('pot_tunggakan_hutang')->default(0);
            $table->double('pot_lebih')->default(0);
            $table->double('pot_lain_taperrum')->default(0);
            $table->double('jumlah_potongan')->default(0);
            $table->double('penghasilan_bersih')->default(0);
            $table->timestamps();
        });
        Schema::table('penggajihan_pns', function ($table) {
            $table->foreign('id_personel_pns')
            ->references('id')
            ->on('personel_pns');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penggajihan_pns');
    }
}
