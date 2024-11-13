<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Topic;
use Exception;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuestionController extends Controller
{
    public function index(){
        try{
            $topics =  DB::table('topic')
            ->inRandomOrder()
            ->limit(4)
            ->get()
            ->map(function($topic){
             $topic->questions = DB::table('question')
             ->where('question.topic_id',$topic->id)
             ->inRandomOrder()    
             ->limit(4)  
             ->select('question_id','difficulty')         
             ->get();
             return $topic;
            });

            return response()->json($topics,200);
        }catch(Exception $e){
            return response()->json(['error' => 'Failed to retrieve data. Please try again later.'], 500);
        }
       
    
    }

   
}
