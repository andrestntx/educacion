<?php

class ProtocolsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index()
	{	
		$protocols = Auth::user()->preferredCompany->protocols()->orderBy('id')->get();
		return View::make('dashboard.pages.protocol.lists-table', compact('protocols'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$protocol = new Protocol;
		$roles = Auth::user()->preferredCompany->roles()->lists('name', 'id');
		$areas = Auth::user()->preferredCompany->areas()->lists('name', 'id');
		$categories = Auth::user()->preferredCompany->protocolCategories()->lists('name', 'id');
		
		$form_data = array('route' => 'protocolos.store', 'method' => 'POST', 'files' => true);
		return View::make('dashboard.pages.protocol.form', compact('protocol', 'form_data', 'roles', 'areas', 'categories'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
        $protocol = new Protocol;
        $data = Input::all();
        $pdf = Input::file('url_pdf');
        
	    if($protocol->validAndSave($data, $pdf))
        {
            return Redirect::route('protocolos.index');
        }

		return Redirect::route('protocolos.create')->withInput()->withErrors($protocol->errors);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$protocol = Protocol::findOrFail($id);
		$protocol->load('annex', 'questions');

		$annex = $protocol->annex->filter(function($annex)
		{
		    return $annex->isFile();
		});

		$links = $protocol->annex->filter(function($annex)
		{
		    return $annex->isLink();
		});

		$number_annex = $annex->count();
		$number_links = $links->count();
		$number_questions = $protocol->questions->count();

		return View::make('dashboard.pages.protocol.show-admin', compact('protocol', 
			 'number_questions', 'number_annex', 'annex', 'number_links', 'links'
		));
	}

	public function stats($id)
	{
		$protocol = Protocol::findOrFail($id);
		$users = User::with(array('examScores' => function($query) use($protocol)
		{
		    $query->whereProtocolId($protocol->id);

		}))->canStudyProtocol($protocol->id)->get();	

		return View::make('dashboard.pages.protocol.exams', compact('protocol', 'users'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$protocol = Protocol::findOrFail($id);
		
		$roles = Auth::user()->preferredCompany->roles()->lists('name', 'id');
		$areas = Auth::user()->preferredCompany->areas()->lists('name', 'id');
		$categories = Auth::user()->preferredCompany->protocolCategories()->lists('name', 'id');

		$form_data = array('route' => array('protocolos.update', $protocol->id), 'method' => 'PUT', 'files' => true);
		return View::make('dashboard.pages.protocol.form', compact('roles', 
			'protocol', 'form_data',  'areas', 'categories'
		));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$protocol = Protocol::findOrFail($id);
		$data = Input::all();
		$pdf = Input::file('url_pdf');
        
        if ($protocol->validAndSave($data, $pdf))
        {
            return Redirect::route('protocolos.index');
        }
        else
        {
			return Redirect::route('protocolos.edit', $protocol->id)->withInput()->withErrors($protocol->errors);
        }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$protocol = Protocol::findOrFail($id);
    	
        $protocol->delete();

        if (Request::ajax())
        {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Protocolo "' . $protocol->name . '" eliminado',
                'id'      => $protocol->id
            ));
        }
        else
        {
            return Redirect::route('protocolos.index');
        }
	}


}
