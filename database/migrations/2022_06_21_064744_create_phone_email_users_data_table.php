<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhoneEmailUsersDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_data_extra_fields', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('import_data_id');
            $table->foreign('import_data_id')->references('id')->on('import_data')->onDelete('cascade');
            $table->string("fields");
            $table->string("type");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phone_email_users_data');
    }
}
