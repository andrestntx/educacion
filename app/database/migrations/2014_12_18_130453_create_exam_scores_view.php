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
			select exam.id, protocol_id, user_id, correct_answers, total_answers, (total_answers - correct_answers) as incorrect_answers,   
				(correct_answers::double precision / total_answers::double precision)*100 as score, created_at, updated_at 
			from exam 
			join(
				select exam.id, count(answer.correct) as correct_answers from exam
				join exams_has_answers on
				exams_has_answers.exam_id = exam.id
				join answer on
				exams_has_answers.answer_id = answer.id
				and answer.correct = true
				group by exam.id, exam.user_id, protocol_id
			) as corrects on corrects.id = exam.id
			join(
				select exam.id, count(answer.id) as total_answers from exam
				join exams_has_answers on
				exams_has_answers.exam_id = exam.id
				join answer on
				exams_has_answers.answer_id = answer.id
				group by exam.id, exam.user_id, protocol_id
			) as total on  total.id = exam.id"
		);

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::statement("DROP VIEW exam_scores");
	}

}
