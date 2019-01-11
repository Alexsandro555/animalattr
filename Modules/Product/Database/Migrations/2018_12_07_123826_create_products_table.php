<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
  private $tableName = 'products';

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
      $table->string('title', 255)->comment('Название продукта');
      $table->string('url_key', 255)->unique()->comment('url');
      $table->decimal('price',10,2)->comment('Цена');
      $table->text('description')->nullable()->comment('Описание');
      $table->integer('qty')->nullable()->comment('количество');
      $table->boolean('active')->default(false)->nullable()->comment('Актив.');
      $table->unsignedInteger('sort')->nullable()->comment('Сорт.');
      $table->boolean('onsale')->nullable()->comment('Скидка');
      $table->boolean('special')->nullable()->comment('Спецпредложение');
      $table->boolean('need_order')->nullable()->comment('Необходимо заказывать');
      $table->unsignedInteger('category_id')->comment('Категория');
      $table->string('vendor')->nullable()->comment('Артикул');
      $table->string('IEC')->nullable()->comment('IEC');
      $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
      $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
      $table->softDeletes();
      $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
    });

    DB::statement("ALTER TABLE `$this->tableName` comment 'Продукция'");
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table($this->tableName, function (Blueprint $table) {
      $table->dropForeign('products_category_id_foreign');
    });
    Schema::dropIfExists($this->tableName);
  }
}
