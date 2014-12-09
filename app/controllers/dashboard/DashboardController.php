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
			$number_users = $models = Auth::user()->preferredCompany->users()->count();
			$number_roles = $models = Auth::user()->preferredCompany->roles()->count();
			$number_protocols = $models = Auth::user()->preferredCompany->protocols()->count();
			$number_categories = $models = Auth::user()->preferredCompany->protocolCategories()->count();

			return View::make('dashboard/pages/hello-admin', compact('number_areas', 'number_users',
				'number_roles', 'number_protocols', 'number_categories'
			));
		}
		else if(Auth::user()->isRegistred())
		{
			$protocol_id = Auth::user()->protocolsForStudy()[0]->t06_id;
			return Redirect::to('dashboard/estudiar'.'/'.$protocol_id);
		}

		return View::make('dashboard/pages/timeline');
	}

	public function getLock()
	{
		return View::make('dashboard/lock');
	}
}


?>