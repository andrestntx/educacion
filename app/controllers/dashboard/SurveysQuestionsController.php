<?php

class SurveysQuestionsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */

	public function index($survey_id)
	{
		$survey = Survey::findOrFail($survey_id);
		$survey->load('questions');
		return View::make('dashboard.pages.survey.question.lists-table', compact('survey'));	
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create($survey_id)
	{
		$survey = Survey::findOrFail($survey_id);
		$question = new Question;		
		$form_data = array('route' => array('formularios.preguntas.store', $survey_id), 'method' => 'POST');

		$number_answers = Input::get('respuestas');
		if(is_null($number_answers))
		{
			$type_id = 2;
			return View::make('dashboard.pages.survey.question.simple.form', compact('question', 'form_data', 'survey', 'type_id'));
		}
		else
		{
			$type_id = 1;
			if($survey->type->isCheck())
			{
				return View::make('dashboard.pages.survey.question.multiple.form-check', compact('question', 'form_data', 'survey', 'number_answers', 'type_id'));
			}
			else if($survey->type->isMath())
			{
				return View::make('dashboard.pages.survey.question.multiple.form-math', compact('question', 'form_data', 'survey', 'number_answers', 'type_id'));
			}
			else if($survey->type->isObservations())
			{
				return View::make('dashboard.pages.survey.question.multiple.form-observation', compact('question', 'form_data', 'survey', 'number_answers', 'type_id'));
			}
		}	
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($survey_id)
	{
        $question = new Question;
        $data = Input::all();

        if ($question->validAndSave($data))
        {
            return Redirect::route('formularios.preguntas.index', $survey_id);
        }
        else
        {
			return Redirect::route('formularios.preguntas.create', array($survey_id, 'respuestas='.count($data['answers'])))->withInput()->withErrors($question->errors);
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
	public function edit($survey_id, $id)
	{
		$survey = Survey::findOrFail($survey_id);
		$question = $survey->questions()->findOrFail($id);
		
		$form_data = array(
			'route' => array('formularios.preguntas.update', $survey->id, $question->id), 
			'method' => 'PUT', 
			'files' => true
		);

		if($question->isMultiple())
		{
			$type_id = 1;
			if($survey->type->isCheck())
			{
				return View::make('dashboard.pages.survey.question.multiple.form-check', compact('question', 'form_data', 'survey', 'type_id'));
			}
			else if($survey->type->isMath())
			{
				return View::make('dashboard.pages.survey.question.multiple.form-math', compact('question', 'form_data', 'survey', 'type_id'));
			}
			else if($survey->type->isObservations())
			{
				return View::make('dashboard.pages.survey.question.multiple.form-observation', compact('question', 'form_data', 'survey', 'type_id'));
			}
			
		}
		else
		{
			$type_id = 2;
			return View::make('dashboard.pages.survey.question.simple.form', compact('question', 'form_data', 'survey', 'type_id'));
		}
		
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($survey_id, $id)
	{
		$survey = Survey::findOrFail($survey_id);
        $question = $survey->questions()->findOrFail($id);
        $data = Input::all();

        if ($question->validAndSave($data))
        {
            return Redirect::route('formularios.preguntas.index', $survey_id);
        }
        else
        {
			return Redirect::route('formularios.preguntas.edit', array($survey_id, $id))->withInput()->withErrors($question->errors);
        } 
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($protocol_id, $id)
	{
    	$question = Question::findOrFail($id);
        $question->delete();

        if (Request::ajax())
        {
            return Response::json(array (
                'success' => true,
                'msg'     => 'Pregunta "' . $question->text . '" eliminada',
                'id'      => $question->id
            ));
        }
        else
        {
            return Redirect::route('protocolos.show', $protocol_id);
        }
	}


}
