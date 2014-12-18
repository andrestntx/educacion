<?php 
/**
* 
*/
class DashboardController extends BaseController
{
	
	public function getIndex()
	{
		if(Auth::user()->isAdmin())
		{
			$number_areas = $models = Auth::user()->preferredCompany->areas()->count();
			$number_users = $models = Auth::user()->preferredCompany->users()->registred()->count();
			$number_roles = $models = Auth::user()->preferredCompany->roles()->count();
			$number_protocols = $models = Auth::user()->preferredCompany->protocols()->count();
			$number_categories = $models = Auth::user()->preferredCompany->protocolCategories()->count();

			return View::make('dashboard.pages.company.show', compact('number_areas', 'number_users',
				'number_roles', 'number_protocols', 'number_categories'
			));
		}
		else if(Auth::user()->isRegistred())
		{
			$user = Auth::user();
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