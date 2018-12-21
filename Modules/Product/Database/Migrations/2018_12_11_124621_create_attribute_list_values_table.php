<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeListValuesTable extends Migration
{
    private $tableName = 'attribute_list_values';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
          $table->increments('id')->comment('Идентефикатор');
          $table->unsignedInteger('attribute_id')->comment('Атрибут');
          $table->unsignedInteger('product_id')->comment('Продукт');
          $table->unsignedInteger('value')->comment('Значение');
          $table->foreign('attribute_id')->references('id')->on('attributes')->onDelete('cascade');
          $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
          $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
          $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table($this->tableName, function (Blueprint $table) {
        $table->dropForeign('attribute_list_values_attribute_id_foreign');
      });
      Schema::dropIfExists($this->tableName);
    }
}
