<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('forum', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // relasi ke users
            $table->string('judul');
            $table->text('isi');
            $table->unsignedBigInteger('views')->default(0);
            $table->enum('status', ['open', 'closed'])->default('closed');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('forum');
    }
};
