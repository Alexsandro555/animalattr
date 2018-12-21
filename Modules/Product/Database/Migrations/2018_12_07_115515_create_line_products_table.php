<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLineProductsTable extends Migration
{
  private $tableName = 'line_products';

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create($this->tableName, function (Blueprint $table) {
      $table->increments('id')->comment('Идентефикатор');
      $table->unsignedInteger('remote_id')->nullable();
      $table->unsignedInteger('type_product_id')->comment('Тип продукта');
      $table->string('title', 50)->comment('Наименование');
      $table->string('url_key', 255)->unique();
      $table->unsignedInteger('sort')->comment('Сорт.');
      $table->text('description')->nullable()->comment('Описание');
      $table->boolean('active')->default(false)->comment('Актив.');
      $table->foreign('type_product_id')->references('id')->on('type_products')->onDelete('cascade');
      $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
      $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
      $table->softDeletes();
    });

    DB::statement("ALTER TABLE `$this->tableName` comment 'Линейки продукции'");
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table($this->tableName, function (Blueprint $table) {
      $table->dropForeign('line_products_type_product_id_foreign');
    });
    Schema::dropIfExists($this->tableName);
  }
}
