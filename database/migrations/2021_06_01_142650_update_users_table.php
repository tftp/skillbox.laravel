<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Role;

class UpdateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->default('2')->constrained()->onDelete('cascade');
        });

        $roleAdmin = Role::where('name', 'Administrator')->first();

        User::create([
            'name' => config('admin.name'),
            'email' => config('admin.email'),
            'password' => Hash::make(config('admin.password')),
            'role_id' => $roleAdmin->id,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $table->dropForeign(['role_id']);
    }
}
