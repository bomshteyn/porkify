<?php

use App\Models\Album;
use App\Models\Artist;
use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignIdFor(Artist::class)
                  ->constrained()
                  ->cascadeOnDelete();
            $table->foreignIdFor(Album::class)
                  ->constrained()
                  ->cascadeOnDelete();
            $table->foreignIdFor(Category::class)
                  ->constrained()
                  ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('songs');
    }
};
