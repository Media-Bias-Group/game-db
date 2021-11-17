<?php

namespace App\Http\Controllers;
use App\Models\GameSentence;
use App\Models\SentenceWord;
use App\Models\Word;
use Illuminate\Http\Request;

class ManualController extends Controller
{
    public function store(Request $request)
    {
        
        $attributes = request()->validate([
            'sentence' => 'required',
            'link' => '',
            'outlet' => 'required',
            'topic' => 'required',
            'type' => 'required',
            'SentenceBias' => 'required',
            'SentenceStatus' => 'required',
        ]);
      
        $attributes+=['SentenceCount' => 0];
        $sentence=GameSentence::create($attributes);
        $sentenceId=$sentence->id;
        if($request->biased_words){
$words=explode(" ",$request->biased_words);
        foreach ($words as $word){
            $word=Word::create(['word'=>$word]);
            $wordId=$word->id;
            SentenceWord::create(['game_sentence_id'=>$sentenceId,'word_id'=>$wordId]);
        }   
        }
        

        return redirect('/manual');
    }
}
