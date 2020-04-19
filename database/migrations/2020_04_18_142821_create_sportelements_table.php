<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSportelementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sportelements', function (Blueprint $table) {
            $table->id();
            $table->string('special');
        });

        $els = ['Baseball', 'Football', 'Golf', 'Tennis', 'Soccer', 'Hockey'];

        foreach($els as $el){
           
            DB::table('sportelements')->insert(
                array(
                    'special' => $el,
                )
            );

        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sportelements');
    }
}
