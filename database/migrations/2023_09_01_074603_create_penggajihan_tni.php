<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggajihanTni extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penggajihan_tni', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_personel_tni')->unsigned()->index();
            $table->string('bulan_penggajihan');
            $table->double('gapok')->default(0);
            $table->double('t_keluarga')->default(0);
            $table->double('t_anak')->default(0);
            $table->double('g_bruto')->default(0);
            $table->double('t_struktural')->default(0);
            $table->double('t_fungsional')->default(0);
            $table->double('t_umum')->default(0);
            $table->double('t_beras')->default(0);
            $table->double('t_kowan')->default(0);
            $table->double('t_sandi')->default(0);
            $table->double('t_babinsa')->default(0);
            $table->double('t_papua')->default(0);
            $table->double('t_terluar')->default(0);
            $table->double('t_lainnya')->default(0);
            $table->double('t_tpp')->default(0);
            $table->double('t_pph')->default(0);
            $table->double('pot_pembulatan')->default(0);
            $table->double('penghasilan_kotor')->default(0);
            $table->double('p_beras')->default(0);
            $table->double('p_pensiunan')->default(0);
            $table->double('p_bpjs')->default(0);
            $table->double('p_tht')->default(0);
            $table->double('p_bpjs_lainnya')->default(0);
            $table->double('p_sewa_rumah')->default(0);
            $table->double('pot_lainnya')->default(0);
            $table->double('jumlah_potongan')->default(0);
            $table->double('penghasilan_bersih')->default(0);
            $table->double('laukpauk')->default(0);
            $table->timestamps();
        });

        Schema::table('penggajihan_tni', function ($table) {
            $table->foreign('id_personel_tni')
            ->references('id')
            ->on('personel_tni');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('penggajihan_tni');
    }
}
