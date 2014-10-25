<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('CompanyTableSeeder');
		$this->call('UserTableSeeder');
		$this->call('UserRoleTableSeeder');
		$this->call('UsersHasRolesTableSeeder');
	}

}

class CompanyTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('t01_company')->insert(array(
            't01_name' => 'Institución Administradora del Sistema',
            't01_url_logo' => 'images/logo_sistema.jpg'
        ));
    }
}

class UserRoleTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('t03_user_role')->insert(array(
            't03_name' => 'Administrador del Sistema',
            't03_company_id' => 1
        ));
    }
}

class UserTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('t02_user')->insert(array(
            'username' => 'andrestntx',
            'email' => 'andres@nuestramarca.com',
            'password' => Hash::make('123'),
            't02_name' => 'Andrés Mauricio Pinzón Puentes',
            't02_tel' => '3142308171',
            't02_company_id' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime            
        ));
    }
}

class UsersHasRolesTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('t04_users_has_roles')->insert(array(
            't04_user_id' => 1,
            't04_role_id' => 1
        ));
    }
}