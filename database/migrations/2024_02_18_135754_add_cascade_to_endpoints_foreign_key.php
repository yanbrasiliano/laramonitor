<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCascadeToEndpointsForeignKey extends Migration
{
  public function up()
  {
    Schema::table('endpoints', function (Blueprint $table) {
      $table->dropForeign(['site_id']);

      $table->foreign('site_id')
        ->references('id')->on('sites')
        ->onDelete('cascade');
    });
  }

  public function down()
  {
    Schema::table('endpoints', function (Blueprint $table) {
      $table->dropForeign(['site_id']);

      $table->foreign('site_id')
        ->references('id')->on('sites');
    });
  }
}
