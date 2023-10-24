<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('author');
            $table->longText('notes_and_description')->nullable();
            $table->string('language');
            $table->string('isbn')->nullable();
            $table->string('publisher')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
