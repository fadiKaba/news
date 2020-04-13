<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFourthbarelementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fourthbarelements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body');
            $table->string('src');
            $table->timestamps();
        });

        for($i = 0; $i < 3; $i++){
            DB::table('fourthbarelements')->insert(
                array(
                    'title' => 'test '.$i,
                    'body' => 'test body'. $i,
                    'src' => 'img1.jpg',
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
        Schema::dropIfExists('fourthbarelements');
    }
}
