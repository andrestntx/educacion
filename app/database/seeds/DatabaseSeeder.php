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

        $this->call('TypeModuleTableSeeder');
        $this->call('GlobalModelTableSeeder');
        $this->call('ModuleTableSeeder');
        $this->call('SystemRoleTableSeeder');
		$this->call('CompanyTableSeeder');
		$this->call('UserTableSeeder');
		$this->call('UserRoleTableSeeder');
		$this->call('UsersHasRolesTableSeeder');
        $this->call('UsersHasCompaniesTableSeeder');
	}

}

class TypeModuleTableSeeder extends Seeder
{
    public function run()
    {
       DB::table('sys04_type_module')->insert(array(
            'sys04_name' => 'Eloquent',
            'sys04_description' => 'Object Management Module',
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        )); 

        DB::table('sys04_type_module')->insert(array(
            'sys04_name' => 'Prefix',
            'sys04_description' => 'Module Route Prefix',
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        ));
    }
}

class GlobalModelTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('sys03_table')->insert(array(
            'plural_name' => 'Modelos',
            'singular_name' => 'Modelo',
            'form' => 'model',
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        ));

        DB::table('sys03_table')->insert(array(
            'plural_name' => 'Instituciones',
            'singular_name' => 'Institución',
            'icon' => 'fa-building-o',
            'form' => 'company',
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        ));

        DB::table('sys03_table')->insert(array(
            'plural_name' => 'Usuarios',
            'singular_name' => 'Usuario',
            'form' => 'user',
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        ));

        DB::table('sys03_table')->insert(array(
            'plural_name' => 'Protocolos',
            'singular_name' => 'Protocolo',
            'form' => 'protocol',
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        ));

        DB::table('sys03_table')->insert(array(
            'plural_name' => 'Perfiles',
            'singular_name' => 'Perfil',
            'form' => 'role',
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        ));

        DB::table('sys03_table')->insert(array(
            'plural_name' => 'Areas',
            'singular_name' => 'Area',
            'form' => 'role',
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        ));

        DB::table('sys03_table')->insert(array(
            'plural_name' => 'Categorías',
            'singular_name' => 'Categoría',
            'form' => 'category',
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        ));
    }
}

class ModuleTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('sys02_module')->insert(array(
            'sys02_name' => 'Prefix dashboard',
            'route' => 'dashboard',
            'sys02_type_module_id' => 2,
            'sys02_top_module_id' => 1,
            'sys02_order' => 0,
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        )); 

        DB::table('sys02_module')->insert(array(
            'sys02_name' => 'Prefix config',
            'route' => 'config',
            'sys02_type_module_id' => 2,
            'sys02_top_module_id' => 1,
            'sys02_order' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        )); 

        DB::table('sys02_module')->insert(array(
            'sys02_name' => 'Eloquent Models',
            'route' => 'config.models',
            'controller' => 'Models',
            'sys02_type_module_id' => 1,
            'sys02_top_module_id' => 2,
            'sys02_order' => 1,
            'sys02_table_id' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        )); 

        DB::table('sys02_module')->insert(array(
            'sys02_name' => 'Eloquent Company',
            'route' => 'companies',
            'controller' => 'Companies',
            'sys02_type_module_id' => 1,
            'sys02_top_module_id' => 1,
            'sys02_order' => 1,
            'sys02_table_id' => 2,
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        )); 

        DB::table('sys02_module')->insert(array(
            'sys02_name' => 'Eloquent Users',
            'route' => 'users',
            'controller' => 'Users',
            'sys02_type_module_id' => 1,
            'sys02_top_module_id' => 1,
            'sys02_order' => 2,
            'sys02_table_id' => 3,
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        )); 

        DB::table('sys02_module')->insert(array(
            'sys02_name' => 'Eloquent Protocols',
            'route' => 'protocols',
            'controller' => 'Protocols',
            'sys02_type_module_id' => 1,
            'sys02_top_module_id' => 1,
            'sys02_order' => 3,
            'sys02_table_id' => 4,
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        )); 

        DB::table('sys02_module')->insert(array(
            'sys02_name' => 'Eloquent Users of Company',
            'route' => 'companies.users',
            'controller' => 'CompaniesUsers',
            'sys02_type_module_id' => 1,
            'sys02_top_module_id' => 1,
            'sys02_order' => 4,
            'sys02_table_id' => 3,
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        ));

        DB::table('sys02_module')->insert(array(
            'sys02_name' => 'Eloquent Roles of Auth Company',
            'route' => 'roles',
            'controller' => 'UserRole',
            'sys02_type_module_id' => 1,
            'sys02_top_module_id' => 1,
            'sys02_order' => 5,
            'sys02_table_id' => 5,
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        )); 

        DB::table('sys02_module')->insert(array(
            'sys02_name' => 'Eloquent Areas of Auth Company',
            'route' => 'areas',
            'controller' => 'Areas',
            'sys02_type_module_id' => 1,
            'sys02_top_module_id' => 1,
            'sys02_order' => 6,
            'sys02_table_id' => 6,
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        ));  

        DB::table('sys02_module')->insert(array(
            'sys02_name' => 'Eloquent Categories of Protocols',
            'route' => 'protocols.categories',
            'controller' => 'ProtocolCategories',
            'sys02_type_module_id' => 1,
            'sys02_top_module_id' => 1,
            'sys02_order' => 7,
            'sys02_table_id' => 7,
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        ));  
    }
}

class SystemRoleTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('sys01_system_role')->insert(array(
            'sys01_name' => 'Súper Administrador',
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        ));
        DB::table('sys01_system_role')->insert(array(
            'sys01_name' => 'Administrador de la Institución',
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        ));
        DB::table('sys01_system_role')->insert(array(
            'sys01_name' => 'Usuario registrado',
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        ));
    }
}

class CompanyTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('t01_company')->insert(array(
            't01_name' => 'Institución Administradora del Sistema',
            't01_url_logo' => 'images/logo_sistema.jpg',
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        ));

        DB::table('t01_company')->insert(array(
            't01_name' => 'Clinica Cooperativa',
            't01_url_logo' => 'images/logo_sistema.jpg',
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        ));
    }
}

class UserRoleTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('t03_user_role')->insert(array(
            't03_name' => 'Administrador del Sistema',
            't03_company_id' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        ));
    }
}

class UserTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('t02_user')->insert(array(
            'username' => 'superadmin',
            'email' => 'andres@nuestramarca.com',
            'password' => Hash::make('123'),
            't02_name' => 'Andrés Mauricio Pinzón Puentes',
            't02_tel' => '3142308171',
            't02_preferred_company_id' => 1,
            't02_system_role_id' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime            
        ));

        DB::table('t02_user')->insert(array(
            'username' => 'miguel',
            'email' => 'miguel@nuestramarca.com',
            'password' => Hash::make('123'),
            't02_name' => 'Miguel Mejía',
            't02_tel' => '3142308171',
            't02_preferred_company_id' => 2,
            't02_system_role_id' => 2,
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
            't04_role_id' => 1,
        ));

        DB::table('t04_users_has_roles')->insert(array(
            't04_user_id' => 2,
            't04_role_id' => 1,
        ));
    }
}

class UsersHasCompaniesTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('t05_users_has_companies')->insert(array(
            't05_user_id' => 1,
            't05_company_id' => 1,
            't05_active' => true
        ));

        DB::table('t05_users_has_companies')->insert(array(
            't05_user_id' => 2,
            't05_company_id' => 2,
            't05_active' => true
        ));
    }
}
