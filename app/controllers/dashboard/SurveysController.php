<?php

class SurveysController  extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$surveys = Auth::user()->preferredCompany->surveysTypeCheck();
		return View::make('dashboard.pages.survey.lists-table', compact('surveys'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$survey = new Survey;
		$user = Auth::user();
		$type_id = 2;
		$form_data = array('route' => 'formularios.store', 'method' => 'POST', 'files' => false);
		return View::make('dashboard.pages.survey.form', compact('survey', 'form_data', 'user', 'type_id'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$survey = new Survey;
        $data = Input::all();

        if ($survey->validAndSave($data))
        {
            return Redirect::route('formularios.preguntas.index', $survey->id);
        }
        else
        {
			return Redirect::route('formularios.create')->withInput()->withErrors($survey->errors);
        }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$survey = Survey::findOrFail($id);
		$user = Auth::user();
		$type_id = 2;
		$form_data = array('route' => array('formularios.update', $survey->id), 'method' => 'PUT', 'files' => false);
		return View::make('dashboard.pages.survey.form', compact('survey', 'form_data', 'user', 'type_id'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$survey = Survey::findOrFail($id);
        $data = Input::all();

        if ($survey->validAndSave($data))
        {
            return Redirect::route('formularios.preguntas.index', $survey->id);
        }
        else
        {
			return Redirect::route('formularios.edit', $survey->id)->withInput()->withErrors($survey->errors);
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
		//
	}


}
