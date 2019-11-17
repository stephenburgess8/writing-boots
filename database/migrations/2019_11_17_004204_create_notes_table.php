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
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->string('uid');

            $table->integer('user')->index('users');

            $table->boolean('published')->default(false);
            $table->boolean('composted')->default(false);
            $table->boolean('positive')->default(true);
            $table->boolean('sensitive')->default(false);

            $table->jsonb('meta');
            $table->jsonb('permissioning');
            $table->jsonb('languages');
            $table->jsonb('tags');

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
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);

            $table->dateTimeTz('created_at')->useCurrent();
            $table->dateTimeTz('discovered_at')->useCurrent();
            $table->dateTimeTz('updated_at')->useCurrent();

            $table->dateTimeTz('compost_at')->nullable();
            $table->dateTimeTz('expire_at')->nullable();
            $table->dateTimeTz('start_at')->nullable();
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
