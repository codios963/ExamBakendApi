<?php

namespace App\Traits;

use Illuminate\Foundation\Mix;
use Nette\Utils\Random;
use Ramsey\Uuid\Generator\RandomGeneratorFactory;

trait BankQTrait
{
    public function formatQuestionData($questions)
    {
        $formattedQuestions = [];

        foreach ($questions as $question) {
            $questionData = [
                'question_ids' => $question->uuid,
                'question' => $question->question,
                'reference' => optional($question->reference)->reference?$question->reference->reference : null,
                'answers' => [],
            ];

            foreach ($question->answers as $answer) {
                $answerData = [
                    'answer_id' => $answer->uuid,
                    'answer' => $answer->answer,
                    'status' => $answer->status??$answer->pivot->status
                ];

                $questionData['answers'][] = $answerData;
            }

            $formattedQuestions[] = $questionData;
        }

        
        $questionAll[] = shuffle($formattedQuestions);
        return $formattedQuestions;

    }
   
}