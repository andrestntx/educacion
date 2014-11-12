<?php 
/**
* 
*/
class DashboardController extends BaseController
{
	
	public function getIndex()
	{
		return View::make('dashboard/pages/timeline');
	}

	public function getLock()
	{
		return View::make('dashboard/lock');
	}
}


?>