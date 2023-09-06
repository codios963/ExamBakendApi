<?php

namespace App\Http\Controllers\Api\Courses;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseQuestion;
use App\Models\Spacialization;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class CourseAnswerQuestionController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $questions = CourseQuestion::all();
        $responseData = $this->formatQuestionsWithAnswers($questions);

        return $this->indexResponse($responseData);
    }

    public function showAll($uuid)
    {
        $spacialization = Spacialization::where('uuid', $uuid)->first();

        if (!$spacialization) {
            return $this->notfoundResponse('Spacialization Not Found');
        }

        $courses = Course::where('spacialization_id', $spacialization->id)->get();

        if ($courses->isEmpty()) {
            return $this->notfoundResponse('Courses Not Found');
        }

        $responseData = [];


            $questions = CourseQuestion::all();
            $randomQuestions = $questions->shuffle()->take(min(50, $questions->count()));
            $courseData = $this->formatQuestionsWithAnswers($randomQuestions);
            $responseData[] = $courseData;
        

        return $this->showResponse($responseData);
    }

    public function show($uuid)
    {
        $course = Course::where('uuid', $uuid)->first();

        if (!$course) {
            return $this->notfoundResponse('Course Not Found');
        }

        $questions = CourseQuestion::all();
        $randomQuestions = $questions->shuffle()->take(min(50, $questions->count()));
        $courseData = $this->formatQuestionsWithAnswers($randomQuestions);
        $responseData = [$courseData];

        return $this->showResponse($responseData);
    }

    
    
}
