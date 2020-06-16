<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('users');
            $table->string('name',200);
            $table->string('abn', 15);
            $table->string('phone', 25);
            $table->text('address_line_1');
            $table->text('address_line_2');
            $table->integer('zip',false);
            $table->string('email',200);
            $table->string('email_altenate',200);
            $table->string('email_communication',200);
            $table->boolean('receive_notification')->default(0);
            $table->dateTime('notification_status_updated_at');
            $table->boolean('status')->default(0);
            $table->dateTime('status_updated_at')->nullable()->default(NULL);
            $table->dateTime('verified_at')->nullable()->default(NULL);
            $table->softDeletes('deleted_at',0);
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
        Schema::dropIfExists('stores');
    }
}
