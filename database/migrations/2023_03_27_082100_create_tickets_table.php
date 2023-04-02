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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('catalog_id')->constrained()->cascadeOnDelete();
            $table->dateTime('date');
            $table->string('title');
            $table->longText('desc')->nullable();
            $table->string('priority')->nullable();
            //agent
            $table->foreignId('agent_id')->nullable()->constrained('users')->nullOnDelete();
            $table->date('response_at')->nullable();
            $table->date('closed_at')->nullable();
            $table->tinyInteger('status')->default(0)
                ->comment('0 = Not responded yet, 1 = In process, 2 = Closed, 3 = Cancelled');
            $table->text('comment')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('tickets');
    }
};
