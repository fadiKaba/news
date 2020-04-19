<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStylelementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stylelements', function (Blueprint $table) {
            $table->id();
            $table->string('special');
        });

        $els = ['Men\' s Style', 'On The Runway', 'Love'];

        foreach($els as $el){
           
            DB::table('stylelements')->insert(
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
        Schema::dropIfExists('stylelements');
    }
}
