<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArtelementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('artelements', function (Blueprint $table) {
            $table->id();
            $table->string('special');
        });

        $artEl = ['Art & Design', 'Movies', 'Dance', 'Music', 'Television', 'Theater'];

        foreach($artEl as $art){
           
            DB::table('artelements')->insert(
                array(
                    'special' => $art,
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
        Schema::dropIfExists('artelements');
    }
}
