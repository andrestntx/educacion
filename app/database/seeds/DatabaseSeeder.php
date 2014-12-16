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

        $this->call('SystemRoleTableSeeder');
		$this->call('CompanyTableSeeder');
		
        $this->call('UserTableSeeder');
		$this->call('UserRoleTableSeeder');
		$this->call('UsersHasRolesTableSeeder');
        $this->call('UsersHasCompaniesTableSeeder');
        
        $this->call('AreaTableSeeder');
        
        $this->call('ProtocolCategoryTableSeeder');
        $this->call('ProtocolTableSeeder');
        $this->call('ProtocolHasCategoriesTableSeeder');
        $this->call('ProtocolHasRolesTableSeeder');
        $this->call('ProtocolHasAreasTableSeeder');
	}

}

class SystemRoleTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('system_role')->insert(array(
            'name' => 'Súper Administrador',
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        ));
        DB::table('system_role')->insert(array(
            'name' => 'Administrador de la Institución',
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        ));
        DB::table('system_role')->insert(array(
            'name' => 'Usuario registrado',
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        ));
    }
}

class CompanyTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('company')->insert(array(
            'name' => 'Institución Administradora del Sistema',
            'url_logo' => 'img/logo_sistema.jpg',
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        ));

        DB::table('company')->insert(array(
            'name' => 'Angiografía de Colombia',
            'url_logo' => 'img/logo_sistema.jpg',
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        ));
    }
}

class UserRoleTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('user_role')->insert(array(
            'name' => 'Administrador del Sistema',
            'company_id' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        ));

        DB::table('user_role')->insert(array(
            'name' => 'Perfil de Prueba',
            'description' => 'Perfil de Prueba',
            'company_id' => 2,
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        )); 

        DB::table('user_role')->insert(array(
            'name' => 'MEDICO GENERAL',
            'description' => 'MEDG',
            'company_id' => 2,
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        )); 

        DB::table('user_role')->insert(array(
            'name' => 'MEDICO GENERAL',
            'description' => 'MEDG',
            'company_id' => 2,
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        )); 

        DB::table('user_role')->insert(array(
            'name' => 'MEDICO ESPECIALISTA',
            'description' => 'MEDE',
            'company_id' => 2,
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        )); 

        DB::table('user_role')->insert(array(
            'name' => 'ENFERMERA PROFESIONAL',
            'description' => 'ENFA',
            'company_id' => 2,
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        )); 

        DB::table('user_role')->insert(array(
            'name' => 'TERAPEUTA RESPIRATORIA',
            'description' => 'TERR',
            'company_id' => 2,
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        )); 

        DB::table('user_role')->insert(array(
            'name' => 'ESTUDIANTE',
            'description' => 'ESTUDIA MEDICINA',
            'company_id' => 2,
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        )); 
    }
}

class UserTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('user')->insert(array(
            'username' => 'superadmin',
            'email' => 'andres@nuestramarca.com',
            'password' => Hash::make('123'),
            'name' => 'Andrés Mauricio Pinzón Puentes',
            'tel' => '3142308171',
            'preferred_company_id' => 1,
            'system_role_id' => 1,
            'created_at' => new DateTime,
            'updated_at' => new DateTime            
        ));

        DB::table('user')->insert(array(
            'username' => 'miguel',
            'email' => 'miguel@nuestramarca.com',
            'password' => Hash::make('123'),
            'name' => 'Miguel Mejía',
            'tel' => '3142308171',
            'preferred_company_id' => 2,
            'system_role_id' => 2,
            'created_at' => new DateTime,
            'updated_at' => new DateTime            
        ));

        DB::table('user')->insert(array(
            'username' => 'invitado',
            'email' => 'invitado@nuestramarca.com',
            'password' => Hash::make('123'),
            'name' => 'Usuario Invitado',
            'tel' => '3142308171',
            'preferred_company_id' => 2,
            'system_role_id' => 3,
            'created_at' => new DateTime,
            'updated_at' => new DateTime            
        ));
    }
}

class UsersHasRolesTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('users_has_roles')->insert(array(
            'user_id' => 1,
            'role_id' => 1,
        ));

        DB::table('users_has_roles')->insert(array(
            'user_id' => 2,
            'role_id' => 1,
        ));

        DB::table('users_has_roles')->insert(array(
            'user_id' => 3,
            'role_id' => 1,
        ));
    }
}

class UsersHasCompaniesTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('users_has_companies')->insert(array(
            'user_id' => 1,
            'company_id' => 1,
            'active' => true
        ));

        DB::table('users_has_companies')->insert(array(
            'user_id' => 2,
            'company_id' => 2,
            'active' => true
        ));

        DB::table('users_has_companies')->insert(array(
            'user_id' => 3,
            'company_id' => 2,
            'active' => true
        ));
    }
}

class AreaTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('area')->insert(array(
            'name' => 'Toda la Institución',
            'description' => 'Área general',
            'company_id' => 2,
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        )); 

        DB::table('area')->insert(array(
            'name' => 'CUIDADOS INTENSIVOS ADULTOS',
            'description' => 'UCI ADULTOS',
            'company_id' => 2,
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        )); 

        DB::table('area')->insert(array(
            'name' => 'UNIDAD DE CUIDADOS INTERMEDIOS ADULTOS',
            'description' => 'UCMA',
            'company_id' => 2,
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        )); 

        DB::table('area')->insert(array(
            'name' => 'FACULTAD DE MEDICINA',
            'description' => 'UNIVERSIDAD COOPERATIVA',
            'company_id' => 2,
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        )); 
    }
}

class ProtocolCategoryTableSeeder extends Seeder
{
    public function run()
    {
       DB::table('protocol_category')->insert(array(
            'name' => 'Todos los Protocolos',
            'description' => 'Categoría general',
            'company_id' => 2,
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        )); 

       DB::table('protocol_category')->insert(array(
            'name' => 'CUIDADO POST OPERATORIO',
            'description' => 'POSQX',
            'company_id' => 2,
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        )); 

       DB::table('protocol_category')->insert(array(
            'name' => 'CARDIOLOGIA',
            'description' => 'CARD',
            'company_id' => 2,
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        )); 

       DB::table('protocol_category')->insert(array(
            'name' => 'INFECCION',
            'description' => 'INFE',
            'company_id' => 2,
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        )); 
    }
}

class ProtocolTableSeeder extends Seeder
{
    public function run()
    {
       DB::table('protocol')->insert(array(
            'name' => 'Protocolo de Prueba',
            'description' => 'Protocolo de Prueba',
            'user_id' => 2,
            'created_at' => new DateTime,
            'updated_at' => new DateTime 
        )); 
    }
}

class ProtocolHasCategoriesTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('protocols_has_categories')->insert(array(
            'protocol_id' => 1,
            'category_id' => 1,
        ));
    }
}

class ProtocolHasRolesTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('protocols_has_roles')->insert(array(
            'protocol_id' => 1,
            'role_id' => 1,
        ));
    }
}

class ProtocolHasAreasTableSeeder extends Seeder {
 
    public function run()
    {
        DB::table('protocols_has_areas')->insert(array(
            'protocol_id' => 1,
            'area_id' => 1,
        ));
    }
}