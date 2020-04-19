<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthelementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('healthelements', function (Blueprint $table) {
            $table->id();
            $table->string('special');
        });

        $els = ['Money & policy', 'Health Guide'];

        foreach($els as $el){
           
            DB::table('healthelements')->insert(
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
        Schema::dropIfExists('healthelements');
    }
}
