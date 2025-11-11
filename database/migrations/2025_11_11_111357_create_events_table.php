<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('img')->nullable();
            $table->dateTime('begin_time');
            $table->dateTime('end_time');
            $table->unsignedBigInteger('max_people')->nullable();
            $table->boolean('limit')->default(false);
            $table->boolean('requires_payment')->default(false);
            $table->boolean('requires_membership')->default(false);
            $table->boolean('send_mail')->default(false);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
