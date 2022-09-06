<?php 
namespace Database\Seeders;
use App\Models\User; 
use Illuminate\Database\Seeder; 
use Illuminate\Support\Facades\DB;

class UsersSeeder extends Seeder { 
    /** 
    * Run the database seeds. 
    * 
    * @return void */

 
   public function run() { 
            DB::table('users')->insert(

            [ 
              'name' => 'Admin',
              'email' => 'admin@gmail.com',
              'password' => '123456',
              'is_admin' => '1',
            ],
            [
              'name' => 'User',
              'email' => 'user@gmail.com',
              'password' => '13456',
              'is_admin' => null,
            ],
             [
              'name' => 'Client',
              'email' => 'client@gmail.com',
              'password' => '13456',
              'is_admin' => null,
            ] 
          
             );
    }
}
