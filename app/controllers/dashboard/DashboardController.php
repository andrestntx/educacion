<?php 
/**
* 
*/
class DashboardController extends BaseController
{
	
	public function getIndex()
	{
		$user = Auth::user();
		if($user->isAdmin())
		{
			$user->load('preferredCompany');
			$number_areas = $user->preferredCompany->areas->count();
			$number_users = $user->preferredCompany->users()->registred()->count();
			$number_roles = $user->preferredCompany->roles->count();
			$number_protocols = $user->preferredCompany->protocols->count();
			$number_categories = $user->preferredCompany->protocolCategories->count();
			$number_checks = $user->preferredCompany->surveys()->count();

			return View::make('dashboard.pages.company.show', compact('number_areas', 'number_users',
				'number_roles', 'number_protocols', 'number_categories', 'number_checks'
			));
		}
		else if($user->isRegistred())
		{
			$protocols = $user->protocolsForStudy();
			return View::make('dashboard.pages.user.scores', compact('protocols', 'user'));
		}

		return Redirect::to('instituciones');
	}

	public function getLock()
	{
		return View::make('lock');
	}
}


?>