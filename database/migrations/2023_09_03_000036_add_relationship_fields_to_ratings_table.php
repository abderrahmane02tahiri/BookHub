<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToRatingsTable extends Migration
{
    public function up()
    {
        Schema::table('ratings', function (Blueprint $table) {
            $table->unsignedBigInteger('book_id')->nullable();
            $table->foreign('book_id', 'book_fk_8953843')->references('id')->on('books');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_8953842')->references('id')->on('users');
        });
    }
}
