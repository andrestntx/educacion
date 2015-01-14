<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExamScoresView extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::statement("
			CREATE view exam_scores AS 
				SELECT resolved_survey.id,
			    resolved_survey.survey_id,
			    resolved_survey.user_id,
			    total.total_answers,
			    COALESCE(corrects.correct_answers, 0),
			    COALESCE(total.total_answers - corrects.correct_answers, 0) AS incorrect_answers,
			    COALESCE(corrects.correct_answers / total.total_answers * 100, 0) AS score,
			    resolved_survey.created_at,
			    resolved_survey.updated_at
			   FROM resolved_survey
			   LEFT JOIN ( SELECT resolved_survey_1.id,
			            count(answer.correct) AS correct_answers
			           FROM resolved_survey resolved_survey_1
			      JOIN resolved_survey_has_answer ON resolved_survey_1.id = resolved_survey_has_answer.resolved_survey_id
			   JOIN answer ON resolved_survey_has_answer.answer_id = answer.id AND answer.correct = true
			  GROUP BY resolved_survey_1.id) corrects ON corrects.id = resolved_survey.id
			   JOIN ( SELECT resolved_survey_1.id,
			       count(answer.correct) AS total_answers
			      FROM resolved_survey resolved_survey_1
			   JOIN resolved_survey_has_answer ON resolved_survey_1.id = resolved_survey_has_answer.resolved_survey_id
			   JOIN answer ON resolved_survey_has_answer.answer_id = answer.id AND answer.correct IS NOT NULL
			  GROUP BY resolved_survey_1.id) total ON total.id = resolved_survey.id;"
		);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//DB::statement("DROP VIEW exam_scores");
	}

}
