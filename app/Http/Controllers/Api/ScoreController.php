<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CourseAnswer;
use App\Models\CourseAnswerQuestion;
use App\Models\CourseQuestion;
use App\Models\NationalAnswer;
use App\Models\NationalQuestion;
use App\Traits\ApiResponseTrait;
use App\Traits\ScoreTrait;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    use ApiResponseTrait;
    use ScoreTrait;
   
    public function show(Request $request)
    {
        $count =count($request->data);
        $correctAnswers = 0;
        $wrongAnswers =[];
        foreach($request->data as $data){
            $question = $this->getQuestionByUuid($data['question']);

            if(!$question){
                return $this->notfoundResponse("Not Found Question");
            }
            
            $answer =$this->getAnswerByUuid($data['answer']);
            
            if(!$answer){
                return $this->notfoundResponse("Not Found answer");
            }
            $question_uuid = $question->uuid;
            $answer_uuid = $answer->uuid;
            $answer_id =$answer->id;
            
            
            $check = $this->getCheckAnswer($answer_uuid,$answer_id);

            if($check->status == 1){
                $correctAnswers++ ;
            }else{
                $get_correct = $this->getQuestionByUuid($question_uuid);

                foreach($get_correct->answers as $corr_ans){
                    $status = $corr_ans->status ?? $corr_ans->pivot->status ?? 0;
                    if ($status === 1) {
                        $wrongAnswers[] = [
                            'question' => $question->uuid,
                            'correct_answer' => $corr_ans->uuid,
                            'reference' => optional($question->reference)->reference,
                        ];
                    }
                }
               
            }            
        }
        $all[]=[
            'count' => $count,
            'score' => $correctAnswers,
            'avg' => number_format(($correctAnswers * 100) / $count, 2) . '%',
            'wronge_Answers' => $wrongAnswers
        ];
        
        return $this->showResponse($all);
    }

   

    
}
