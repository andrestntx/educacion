<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersCanStudyProtocolsView extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement("
			CREATE view users_can_study_protocols AS 
			select DISTINCT ON (users_has_areas.user_id, protocols_has_roles.protocol_id) users_has_areas.user_id, protocols_has_roles.protocol_id
			from users
			join users_has_areas on 
				users_has_areas.user_id = users.id
			join users_has_roles on 
				users_has_roles.user_id = users.id
			join protocols_has_areas on 
				protocols_has_areas.area_id = users_has_areas.area_id
			join protocols_has_roles on 
				protocols_has_roles.role_id = users_has_roles.role_id
				and protocols_has_roles.protocol_id = protocols_has_areas.protocol_id
		");	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement("DROP VIEW users_can_study_protocols");
	}

}
