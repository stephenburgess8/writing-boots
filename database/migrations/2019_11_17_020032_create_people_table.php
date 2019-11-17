<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->uuid('uuid');
            $table->string('uid');

            $table->boolean('banned')->default(false);
            $table->boolean('muted')->default(false);
            $table->boolean('flagged')->default(false);
            $table->boolean('sensitive')->default(false);
            $table->boolean('bot')->default(false);

            $table->jsonb('meta');
            $table->jsonb('permissioning');
            $table->jsonb('languages');
            $table->jsonb('tags');

            $table->text('profile')->nullable();

            $table->string('display_name')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('gender')->nullable();
            $table->string('pronouns')->nullable();

            $table->string('url')->nullable();
            $table->binary('thumbnail')->nullable();
            $table->binary('emoji')->nullable();

            $table->string('location')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);

            $table->dateTimeTz('created_at')->useCurrent();
            $table->dateTimeTz('discovered_at')->useCurrent();

            $table->dateTimeTz('retire_at')->nullable();
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
        Schema::dropIfExists('people');
    }
}
