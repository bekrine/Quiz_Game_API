<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use function PHPUnit\Framework\throwException;

class AnswerController extends Controller
{
    public function answers($id)
    {
        try {
            
            $answers = DB::table('answer')
                             ->join('question','answer.question_id','=','question.question_id')
                            ->where('answer.question_id','=',$id)
                            ->get();

                if ($answers->isEmpty()) throw new Exception('Answer not found.');
                
            return response()->json($answers);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function checkAnswer($id)
    {
        try {

            $isCorrecte = DB::table('answer')
                ->select('is_correct')
                ->where('id', '=', $id)
                ->get();
            if ($isCorrecte->isEmpty()) throw new Exception('Answer not found.');
            return response()->json($isCorrecte, 200);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
