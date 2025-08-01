<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id');
    $table->string('uploaded_by')->nullable(); // optional
    $table->string('filename');
    $table->string('path'); // where the encrypted file is stored
    $table->string('type')->nullable();
    $table->text('comment')->nullable();
    $table->text('encryption_key')->nullable(); // <-- for storing encrypted key
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
