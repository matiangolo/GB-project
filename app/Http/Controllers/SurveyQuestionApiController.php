<?php

namespace App\Http\Controllers;

use App\Models\SurveyQuestion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SurveyQuestionApiController extends Controller
{
    /**
     * Get the survey question that should be shown on the survey question kiosk
     *
     * @return SurveyQuestion
     */
    function questionOfTheDay() {
        // For the first version this will return a "fake" survey question (that doesn't exist in the database)
        $question = new SurveyQuestion();
        $question->id = 1;
        $question->question = "Ben je tevreden met de wachtijden aan de kassa?";
        $question->type = 1;

        return $question;

        // return SurveyQuestion::first();
    }

    /**
     * Add an answer to a survey question
     *
     * @return Response
     */

//    TODO: 1.Controle op post request   2. Afwerken
    function answerQuestionOfTheDay($id, Request $request) {
        // For the first version this will do nothing
        // Later this will add a new answer for the specific question in the database

        //        $question = SurveyQuestion::find($id);
        //
        //        if($question == null) {
        //            return Response::json([], 404);
        //        }

        $givenAnswer = $request->input('answer');

        if($givenAnswer == null || $givenAnswer == "") {
            return Response()->json([ 'message' => 'The answer cannot be empty'], 405);
        }

        //        $answer = new SurveyQuestionAnswer();
        //        $answer->survey_question_id = $id;
        //        $answer->answer = $givenAnswer;
        //        $answer->save();

        return Response()->json([ 'answer' => $givenAnswer], 201);
    }

    /**
     * Register a feedback form submit
     *
     * @return String
     */
    function registerFeedbackForm(Request $request) {
        $email = $request->input("email");
        $message = $request->input("message");

        if(!isset($email) || $email == '') {
            return Response()->json([ 'message' => 'The email cannot be empty'], 405);
        }

        if(!isset($message) || $message == '') {
            return Response()->json([ 'message' => 'The message cannot be empty'], 405);
        }

        //TODO: Store the feedback in the database
        //TODO: Send an email to the Carrefour mailbox

        return Response("ok", 200);
    }
}
