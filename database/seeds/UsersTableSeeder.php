<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => '学会伪装',
                'email' => '898682800@qq.com',
                'email_status' => 2,
                'password' => 'fd855b1120dcddca49dbf0ddc9248402',
                'alternate_password' => 'fd855b1120dcddca49dbf0ddc9248402',
                'salt' => 'SJmK',
                'status' => 1,
                'overdue_date' => '2016-08-03 18:35:15',
                'validation_code' => '6Iih3Y',
                'expire_date' => NULL,
                'reset_password_code' => NULL,
                'remember_token' => '3zQve9cxOWavIrpoX7Am8xx3cUCurS3v2aTpSJOtN8lFn8IGa7Ib3hf63EqK',
                'last_login_time' => '2016-08-03 15:35:15',
                'source' => 1,
                'created_at' => '2016-08-03 15:35:15',
                'updated_at' => '2016-08-03 16:48:40',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'kekezu123',
                'email' => 'kekezu123@sina.com',
                'email_status' => 2,
                'password' => '0937bad9c8946a81fef16b958a194de7',
                'alternate_password' => '0937bad9c8946a81fef16b958a194de7',
                'salt' => 'p1G3',
                'status' => 1,
                'overdue_date' => '2016-08-03 18:41:33',
                'validation_code' => 'zV9GUn',
                'expire_date' => NULL,
                'reset_password_code' => NULL,
                'remember_token' => 'nABR4NbwsxZGE81On3RgcjOXWokn9jauhqcXvmY9U00N4urwLUpY8MkjJPve',
                'last_login_time' => '2016-08-03 15:41:33',
                'source' => 1,
                'created_at' => '2016-08-03 15:41:33',
                'updated_at' => '2016-08-03 18:27:31',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'test',
                'email' => '1817997420@qq.com',
                'email_status' => 2,
                'password' => '842a42851e22ae7b2d8c77a63d10806e',
                'alternate_password' => '842a42851e22ae7b2d8c77a63d10806e',
                'salt' => 'jpRh',
                'status' => 1,
                'overdue_date' => '2016-08-03 18:44:30',
                'validation_code' => 'Bit9pR',
                'expire_date' => NULL,
                'reset_password_code' => NULL,
                'remember_token' => NULL,
                'last_login_time' => '2016-08-03 15:44:30',
                'source' => 1,
                'created_at' => '2016-08-03 15:44:30',
                'updated_at' => '2016-08-03 15:45:14',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'kekezu456',
                'email' => 'kekezu456@sina.com',
                'email_status' => 2,
                'password' => '9804a1fae4e1c686ade71c0703da7170',
                'alternate_password' => '9804a1fae4e1c686ade71c0703da7170',
                'salt' => 'FyXn',
                'status' => 1,
                'overdue_date' => '2016-08-03 18:54:37',
                'validation_code' => 'ZYXMzI',
                'expire_date' => NULL,
                'reset_password_code' => NULL,
                'remember_token' => '6wI2arhrLwhF7shNyQAWAFcHnbGnYEPR2UAVXYjlYMWxboaKm5ZGQ04r2zbX',
                'last_login_time' => '2016-08-03 15:54:37',
                'source' => 1,
                'created_at' => '2016-08-03 15:54:37',
                'updated_at' => '2016-08-03 18:24:26',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => '只是当时已惘然',
                'email' => '3385866786@qq.com',
                'email_status' => 2,
                'password' => 'b3462568a1cfdf5ca0098e21b7666a17',
                'alternate_password' => 'b3462568a1cfdf5ca0098e21b7666a17',
                'salt' => 'N6j6',
                'status' => 1,
                'overdue_date' => '2016-08-03 19:11:01',
                'validation_code' => 'RnD7hQ',
                'expire_date' => NULL,
                'reset_password_code' => NULL,
                'remember_token' => 'Mt2BnrAlE0QAHtzDxV1rfaVB6Uai61C2l2Z8MSj1DY6ZA0BiA9EMgmjBYJZi',
                'last_login_time' => '2016-08-03 16:11:01',
                'source' => 1,
                'created_at' => '2016-08-03 16:11:01',
                'updated_at' => '2016-08-03 16:25:47',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'kekezu789',
                'email' => 'kekezu789@sina.com',
                'email_status' => 2,
                'password' => '21d057eeedd43550838fa243d5e9a1c3',
                'alternate_password' => '21d057eeedd43550838fa243d5e9a1c3',
                'salt' => 'wJhk',
                'status' => 1,
                'overdue_date' => '2016-08-03 21:24:48',
                'validation_code' => 'P8psFc',
                'expire_date' => NULL,
                'reset_password_code' => NULL,
                'remember_token' => NULL,
                'last_login_time' => '2016-08-03 18:24:48',
                'source' => 1,
                'created_at' => '2016-08-03 18:24:48',
                'updated_at' => '2016-08-03 18:27:39',
            ),
        ));
        
        
    }
}
