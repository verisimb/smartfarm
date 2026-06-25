```php
   <?php

   use Illuminate\Database\Migrations\Migration;
   use Illuminate\Database\Schema\Blueprint;
   use Illuminate\Support\Facades\Schema;

   return new class extends Migration
   {
       public function up(): void
       {
           Schema::create('land_predictions', function (Blueprint $table) {
               $table->id();
               $table->foreignId('user_id')->constrained()->cascadeOnDelete();

               $table->float('N');
               $table->float('P');
               $table->float('K');
               $table->float('temperature');
               $table->float('humidity');
               $table->float('ph');
               $table->float('rainfall');

               $table->string('recommended_crop')->nullable();
               $table->integer('cluster')->nullable();
               $table->string('land_type')->nullable();

               $table->timestamps();
           });
       }

       public function down(): void
       {
           Schema::dropIfExists('land_predictions');
       }
   };
