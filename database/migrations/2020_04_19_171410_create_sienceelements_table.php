<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSienceelementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sienceelements', function (Blueprint $table) {
            $table->id();
            $table->string('special');
        });

        $els = ['Environment', 'Space & Cosmos'];

        foreach($els as $el){
           
            DB::table('sienceelements')->insert(
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
        Schema::dropIfExists('sienceelements');
    }
}
