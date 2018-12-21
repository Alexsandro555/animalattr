<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeTypeFieldAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('attributes', function(Blueprint $table) {
        $table->renameColumn('type', 'type_id');
        $table->foreign('type_id')->references('id')->on('types')->onDelete('cascade');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('attributes', function(Blueprint $table) {
        $table->dropForeign('attributes_type_id_foreign');
        $table->renameColumn('type_id', 'type');
      });
    }
}
