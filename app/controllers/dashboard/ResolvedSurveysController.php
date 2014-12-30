<?php

class ResolvedSurveysController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index($survey_id)
	{
		$survey = Survey::findOrFail($survey_id);
		$resolvedSurveys = Auth::user()->resolvedSurveys()->whereSurveyId($survey->id)->get();
		return View::make('dashboard.pages.resolvedsurvey.lists-table', compact('resolvedSurveys', 'survey'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($survey_id)
	{
		$survey = Survey::findOrFail($survey_id);
		$survey->load('questions');
		$resolvedSurvey = new ResolvedSurvey;
		$form_data = array('route' => array('formularios.registros.store', $survey->id), 'method' => 'POST');
		return View::make('dashboard.pages.resolvedsurvey.form', compact('survey', 'resolvedSurvey', 'form_data'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($survey_id)
	{
		$survey = Survey::findOrFail($survey_id);

		$multipleAnswers = Input::get('answers');
		$simpleAnswers = Input::get('simpleAnswers');

		$resolvedSurvey = new ResolvedSurvey;
		$resolvedSurvey->validAndSave($survey->id, Auth::user(), $multipleAnswers, $simpleAnswers);
		
		return Redirect::route('formularios.registros.show', array($survey->id, $resolvedSurvey->id));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function show($survey_id, $id)
	{
		$survey = Survey::findOrFail($survey_id);
		$resolvedSurvey = ResolvedSurvey::findOrFail($id);
		return View::make('dashboard.pages.resolvedsurvey.show', compact('survey', 'resolvedSurvey'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */

	public function export($survey_id, $id)
	{
		$survey = Survey::findOrFail($survey_id);
		$resolvedSurvey = ResolvedSurvey::findOrFail($id);
		$pdf = $resolvedSurvey->generatePdf();
		return $pdf->download('formulario.pdf');
	}

	public function send($survey_id, $id)
	{
		$survey = Survey::findOrFail($survey_id);
		$resolvedSurvey = ResolvedSurvey::findOrFail($id);
		$resolvedSurvey->sendViaEmail(Auth::user());

		return Redirect::route('formularios.registros.show', array($survey->id, $resolvedSurvey->id));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
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
