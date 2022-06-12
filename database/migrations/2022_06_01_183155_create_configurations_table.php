<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            $table->string('code', 60)->unique();
            $table->string('title');
            $table->string('title_short');
            $table->text('desc');
            $table->string('slogan');
            $table->string('author');
            $table->string('favicon_name');
            $table->string('favicon_file');
            $table->string('logo_name');
            $table->string('logo_file');
            $table->string('logo2_name')->nullable();
            $table->string('logo2_file')->nullable();
            $table->string('address');
            $table->string('email');
            $table->string('phone');
            $table->longText('map_src');
            $table->string('map_link');
            $table->string('place_of_birth');
            $table->date('date_of_birth');
            $table->string('keywords');
            $table->string('metatext');
            $table->string('api_key')->nullable();

            $table->text('about');
            $table->text('privacy_policy');
            $table->text('term_and_condition');

            $table->boolean('status')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
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
        Schema::dropIfExists('configurations');
    }
};
