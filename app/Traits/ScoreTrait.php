<?php
namespace App\Traits;

use App\Models\CourseAnswer;
use App\Models\CourseAnswerQuestion;
use App\Models\CourseQuestion;
use App\Models\NationalAnswer;
use App\Models\NationalQuestion;

trait ScoreTrait
{
    
protected function getQuestionByUuid($uuid)
{
    return CourseQuestion::where('uuid', $uuid)->first()
        ?? NationalQuestion::where('uuid', $uuid)->first();
}

protected function getAnswerByUuid($uuid)
{
    return CourseAnswer::where('uuid', $uuid)->first()
        ?? NationalAnswer::where('uuid', $uuid)->first();
}
protected function getCheckAnswer($answer_uuid,$answer_id){
    return NationalAnswer::where('uuid',$answer_uuid)->first()
                ??  CourseAnswerQuestion::where('course_answer_id',$answer_id)->first();
}



protected function findIncorrectAnswers($question)
{
    return $question->answers->filter(function ($answer) {
        return !$this->isAnswerCorrect($answer);
    });
}


}