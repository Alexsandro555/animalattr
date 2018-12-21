<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeProductsTable extends Migration
{
  private $tableName = 'type_products';

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
      $table->unsignedInteger('category_id')->comment('Категория');
      $table->unsignedBigInteger('tnved_id')->comment('ТНВЭД');
      $table->string('title', 50)->comment('Наименование');
      $table->string('url_key', 255)->unique();
      $table->unsignedInteger('sort')->comment('Сорт.');
      $table->text('description')->nullable()->comment('Описание');
      $table->boolean('active')->default(false)->comment('Актив.');
      $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
      $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
      $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
      $table->softDeletes();
    });

    DB::statement("ALTER TABLE `$this->tableName` comment 'Типы продукции'");
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table($this->tableName, function (Blueprint $table) {
      $table->dropForeign('type_products_category_id_foreign');
    });
    Schema::dropIfExists($this->tableName);
  }
}
