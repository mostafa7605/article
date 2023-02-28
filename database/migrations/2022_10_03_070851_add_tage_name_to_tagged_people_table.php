<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTageNameToTaggedPeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tagged_people', function (Blueprint $table) {
            //
            $table->bigInteger('user_id')->unsigned()->nullable()->change();
            $table->string('tagged_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tagged_people', function (Blueprint $table) {
            //
        });
    }
}
