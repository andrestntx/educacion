<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersHasAccessSurveysView extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement("
			CREATE view users_has_access_surveys AS 
			select DISTINCT users_has_areas.user_id, surveys_has_roles.survey_id
			from users
			join users_has_areas on 
				users_has_areas.user_id = users.id
			join users_has_roles on 
				users_has_roles.user_id = users.id
			join surveys_has_areas on 
				surveys_has_areas.area_id = users_has_areas.area_id
			join surveys_has_roles on 
				surveys_has_roles.role_id = users_has_roles.role_id
				and surveys_has_roles.survey_id = surveys_has_areas.survey_id
		");	
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//DB::statement("DROP VIEW users_has_access_surveys");
	}
}
