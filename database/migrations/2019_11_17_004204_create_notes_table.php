<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('uid')->nullable();

            // $table->integer('user')->index('users');

            $table->boolean('published')->default(false);
            $table->boolean('composted')->default(false);
            $table->boolean('positive')->default(true);
            $table->boolean('sensitive')->default(false);

            $table->jsonb('meta')->nullable();
            $table->jsonb('permissioning')->nullable();
            $table->jsonb('languages')->nullable();
            $table->jsonb('tags')->nullable();

            $table->longText('content')->nullable();

            $table->string('title')->nullable();
            $table->string('type')->default('private');
            $table->string('comment')->nullable();

            $table->string('url')->nullable();
            $table->string('featured_image_url')->nullable();

            $table->binary('thumbnail')->nullable();
            $table->binary('emoji')->nullable();

            $table->string('mood')->nullable();
            $table->string('current_music')->nullable();
            $table->string('weather')->nullable();

            $table->string('location')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();

            $table->dateTimeTz('created_at')->useCurrent();
            $table->dateTimeTz('updated_at')->useCurrent();
            $table->unsignedBigInteger('discovered_at')->nullable();
            $table->unsignedBigInteger('compost_at')->nullable();
            $table->unsignedBigInteger('expire_at')->nullable();
            $table->unsignedBigInteger('start_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
}
