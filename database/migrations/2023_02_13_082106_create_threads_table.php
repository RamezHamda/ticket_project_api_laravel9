<?php

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
        Schema::create('threads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained()->cascadeOnDelete();
            $table->tinyInteger('type')->nullable()->comment('1 = Normal Response, 2 = Forward, 3 = Change TK Status, 4 = Change TK SC ID');
            $table->foreignId('fw_user_id')->nullable()->constrained('users')->cascadeOnDelete();
            $table->foreignId('catalog_id')->nullable()->constrained()->cascadeOnDelete();
            $table->dateTime('response_date');
            $table->longText('desc')->nullable();
            $table->string('priority')->nullable();
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
        Schema::dropIfExists('threads');
    }
};
