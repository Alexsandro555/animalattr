<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttributesTable extends Migration
{
    private $tableName = 'attributes';

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
          $table->unsignedInteger('sort')->comment('Сорт.');
          $table->string('title', 255)->comment('Наименование');
          $table->string('alias', 255)->comment('Псевдоним eng');
          $table->boolean('active')->default(false)->nullable()->comment('Актив.');
          $table->unsignedInteger('type')->nullable()->comment('Тип');
          $table->unsignedInteger('attribute_group_id')->comment('Группа атрибута');
          $table->unsignedInteger('unit_id')->comment('Еденица измерения атрибута');
          $table->foreign('attribute_group_id')->references('id')->on('attribute_groups')->onDelete('cascade');
          $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade');
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
        $table->dropForeign('attributes_attribute_group_id_foreign');
        $table->dropForeign('attributes_unit_id_foreign');
      });
      Schema::dropIfExists($this->tableName);
    }
}
