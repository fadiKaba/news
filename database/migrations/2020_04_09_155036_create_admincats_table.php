<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmincatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admincats', function (Blueprint $table) {
            $table->id();
            $table->string('category');
            $table->timestamps();
        });
        

        $cats = ['mainpage', 'arts', 'sport', 'business', 'Health', 'food', 'travel', 'magazine', 'books', 'style', 'opinion'];
        
        foreach($cats as $cat){
           
            DB::table('admincats')->insert(
                array(
                    'category' => $cat,
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
        Schema::dropIfExists('admincats');
    }
}
