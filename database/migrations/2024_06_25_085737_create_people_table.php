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
            Schema::create('people', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->enum('gender', ['male', 'female']);
                $table->date('birth_date')->nullable();
                $table->date('death_date')->nullable();
                $table->integer('parent_id');
                $table->string('profile_picture')->nullable();
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('people');
        }
    };
