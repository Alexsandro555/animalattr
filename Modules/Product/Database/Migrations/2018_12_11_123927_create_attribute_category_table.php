<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributeCategoryTable extends Migration
{
  private $tableName = 'attribute_category';

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create($this->tableName, function (Blueprint $table) {
      $table->unsignedInteger('category_id')->length(11);
      $table->unsignedInteger('attribute_id')->length(11);
      $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
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
      $table->dropForeign('attribute_category_category_id_foreign');
      $table->dropForeign('attribute_category_attribute_id_foreign');
    });
    Schema::dropIfExists($this->tableName);
  }
}
