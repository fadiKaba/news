<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpinonelementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opinonelements', function (Blueprint $table) {
            $table->id();
            $table->string('special');
        });

        $els = ['Editorial', 'Sunday', 'Letters'];

        foreach($els as $el){
           
            DB::table('opinonelements')->insert(
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
        Schema::dropIfExists('opinonelements');
    }
}
