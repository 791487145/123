<?php

use Illuminate\Database\Seeder;

class ManagerTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('manager')->delete();
        
        \DB::table('manager')->insert(array (
            0 => 
            array (
                'id' => 1,
                'username' => 'admin',
                'realname' => NULL,
                'password' => 'ce9fd430dd6e45fb9da910516fd1f8de',
                'salt' => '12dz',
                'telephone' => NULL,
                'QQ' => NULL,
                'email' => NULL,
                'birth' => NULL,
                'status' => 1,
                'created_at' => '2016-07-12 11:49:42',
                'updated_at' => '2016-07-12 11:49:46',
            ),
        ));
        
        
    }
}
