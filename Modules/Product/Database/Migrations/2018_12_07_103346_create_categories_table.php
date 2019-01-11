<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
  private $tableName = 'categories';

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
      $table->string('title', 28)->comment('Наименование');
      $table->string('url_key', 255)->unique()->comment('url');
      $table->unsignedInteger('sort')->comment('Сорт.');
      $table->text('description')->nullable()->comment('Описание');
      $table->boolean('active')->default(false)->comment('Актив.');
      $table->unsignedInteger('parent_id')->nullable();
      $table->unsignedInteger('lft')->nullable();
      $table->unsignedInteger('rgt')->nullable();
      $table->unsignedInteger('depth')->nullable();
      $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
      $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
      $table->softDeletes();
    });

    DB::statement("ALTER TABLE `$this->tableName` comment 'Категории'");
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists($this->tableName);
  }
}
