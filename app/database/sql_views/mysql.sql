
CREATE VIEW users_has_access_surveys AS 
	SELECT DISTINCT users_has_areas.user_id, surveys_has_roles.survey_id
	FROM users
	join users_has_areas on 
		users_has_areas.user_id = users.id
	join users_has_roles on 
		users_has_roles.user_id = users.id
	join surveys_has_areas on 
		surveys_has_areas.area_id = users_has_areas.area_id
	join surveys_has_roles on 
		surveys_has_roles.role_id = users_has_roles.role_id
		and surveys_has_roles.survey_id = surveys_has_areas.survey_id;

CREATE VIEW count_correct_answers_survey AS
	SELECT resolved_survey.id, count(answer.correct) AS correct_answers
	FROM resolved_survey 
	JOIN resolved_survey_has_answer ON resolved_survey.id = resolved_survey_has_answer.resolved_survey_id
	JOIN answer ON resolved_survey_has_answer.answer_id = answer.id AND answer.correct = true
	GROUP BY resolved_survey.id;

CREATE VIEW count_total_answers_survey AS
SELECT resolved_survey.id, count(answer.correct) AS total_answers
    FROM resolved_survey
	JOIN resolved_survey_has_answer ON resolved_survey.id = resolved_survey_has_answer.resolved_survey_id
    JOIN answer ON resolved_survey_has_answer.answer_id = answer.id AND answer.correct IS NOT NULL
  GROUP BY resolved_survey.id

CREATE VIEW exam_scores AS 
	SELECT resolved_survey.id, resolved_survey.survey_id, resolved_survey.user_id, total.total_answers,
	    COALESCE(corrects.correct_answers, 0),
	    COALESCE(total.total_answers - corrects.correct_answers, 0) AS incorrect_answers,
	    COALESCE(corrects.correct_answers / total.total_answers * 100, 0) AS score,
	    resolved_survey.created_at,
	    resolved_survey.updated_at
   FROM resolved_survey
   LEFT JOIN count_correct_answers_survey ON 
   	count_correct_answers_survey.id = resolved_survey.id
   JOIN count_total_answers_survey ON 
   	count_total_answers_survey.id = resolved_survey.id;