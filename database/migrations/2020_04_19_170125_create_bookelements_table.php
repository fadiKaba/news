<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookelementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookelements', function (Blueprint $table) {
            $table->id();
            $table->string('special');
        });

        $els = ['Best sellers', 'By the Book', 'The Book Review'];

        foreach($els as $el){
           
            DB::table('bookelements')->insert(
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
        Schema::dropIfExists('bookelements');
    }
}
