<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            // create Foreign Key column
            $table->unsignedBigInteger('type_id')->after('id');

            // define column as Foreign Key
            $table->foreign('type_id')->references('id')->on('types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            // Drop Foreign Key
            $table->dropForeign('projects_user_id_foreign');

            // Drop Column for Foreign Key
            $table->dropColumn('type_id');
        });
    }
};
