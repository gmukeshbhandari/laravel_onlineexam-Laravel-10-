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
        Schema::create('provinces', function (Blueprint $table) {
			$table->id();
			// $table->string('Province');
            $table->enum('Province',['Koshi', 'Madhesh', 'Bagmati', 'Gandaki', 'Lumbini', 'Karnali', 'Sudhurpaschim']);
            $table->foreignId('country_id')->constrained();
			$table->timestamps();
        });
    }
		/**
		*In Laravel migrations, the constrained() method is used to define foreign key constraints when creating a foreign key column. This method is typically used in conjunction with the foreignId method to set up relationships between tables.

		*Here's how it works:

		*In $table->foreignId('country_id')->constrained();
		
		*foreignId('country_id'): This creates a foreign key column named country_id in the current table.

		*constrained(): This method tells Laravel to automatically create a foreign key constraint on the country_id column, referencing the id column of the table associated with the foreign key. In this case, it's assumed to be the countries table, since the column name is country_id. The constrained() method assumes that the referenced table has a primary key named id.

		*This helps in maintaining referential integrity between the tables. If you delete a record from the referenced table (countries in this case), the foreign key constraint ensures that corresponding records in the current table (provinces) are also appropriately handled (e.g., cascading the delete or setting the foreign key column to NULL).

		*So, using constrained() is a convenient way to define foreign key constraints without explicitly specifying the referenced table and column, as Laravel can infer them based on naming conventions.
		*/
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('provinces');
    }
};
