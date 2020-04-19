<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodelementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foodelements', function (Blueprint $table) {
            $table->id();
            $table->string('special');
        });

        $els = ['Cooking', 'Restaurant Search'];

        foreach($els as $el){
           
            DB::table('foodelements')->insert(
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
        Schema::dropIfExists('foodelements');
    }
}
