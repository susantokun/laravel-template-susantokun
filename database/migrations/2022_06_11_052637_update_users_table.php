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
        Schema::table('users', function (Blueprint $table) {
            $table->string('username', 60)->unique()->after('id');
            $table->string('first_name')->after('username');
            $table->string('last_name')->after('first_name')->nullable();
            $table->renameColumn('name', 'full_name')->after('last_name');
            $table->string('phone', 13)->after('name')->nullable();
            $table->string('image_name')->nullable()->after('remember_token');
            $table->string('image_file')->nullable()->after('image_name');
            $table->string('status')->default('active')->after('image_file');
            $table->datetime('last_login_at')->nullable()->after('status');
            $table->string('last_login_ip')->nullable()->after('last_login_at');
            $table->string('created_by')->nullable()->after('created_at');
            $table->string('updated_by')->nullable()->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('full_name');
            $table->string('name');
            $table->dropColumn('phone');
            $table->dropColumn('image_name');
            $table->dropColumn('image_file');
            $table->dropColumn('status');
            $table->dropColumn('last_login_at');
            $table->dropColumn('last_login_ip');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
        });
    }
};
