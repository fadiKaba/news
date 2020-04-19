<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusinesselementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesselements', function (Blueprint $table) {
            $table->id();
            $table->string('special');
        });

        $els = ['Technology', 'Economy', 'Media', 'Money', 'DealBook'];

        foreach($els as $el){
           
            DB::table('businesselements')->insert(
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
        Schema::dropIfExists('businesselements');
    }
}
