<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTypeColumnAttendeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendees', function($table) {
            $table->enum('type', ['NOT_DEFINED', 'VEGAN', 'VEGETARIAN', 'CELIAC'])->default('NOT_DEFINED');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendees', function($table) {
            $table->dropColumn('type');
        });
    }
}
