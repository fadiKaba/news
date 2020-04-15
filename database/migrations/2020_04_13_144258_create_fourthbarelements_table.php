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
            $table->string('title_ar');
            $table->text('body');
            $table->text('body_ar');
            $table->string('src');
            $table->integer('admincat_id');
            $table->timestamps();
            $table->integer('special');
            $table->integer('user_id');
        });

        for($i = 0; $i < 3; $i++){
            DB::table('fourthbarelements')->insert(
                array(
                    'title' => 'test '.$i,
                    'title_ar' => 'test ar'.$i,
                    'body' => 'test body'. $i,
                    'body_ar' => 'test body ar'. $i,
                    'src' => 'img'.($i + 1).'.jpg',
                    'admincat_id' => 1,
                    'user_id' => 1,
                    'special' => 1,
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
