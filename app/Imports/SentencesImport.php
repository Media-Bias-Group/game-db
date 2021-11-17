<?php

namespace App\Imports;

use App\Models\GameSentence;
use App\Models\SentenceWord;
use App\Models\Word;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithUpserts;

class SentencesImport implements ToModel,WithHeadingRow, WithBatchInserts, WithUpserts
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
       preg_match_all('([\w\-]+)', $row['biased_words'], $matches, PREG_SET_ORDER, 0);
      $words=array_column($matches, 0);
        $sentence = array(
    'sentence'     => $row["text"],
           'link'    => $row["news_link"], 
           'outlet' => $row["outlet"],
           'type' => $row["type"],
           'topic' => $row["topic"],
           'SentenceBias' => $row["label_bias"],
           'SentenceStatus'=>"gold",
           'SentenceCount'=>0
);
$sentence = GameSentence::create($sentence);

        $sentenceId=$sentence->id;
        if($words){

        foreach (array_column($matches, 0) as $word){
            $word=Word::create(['word'=>$word]);
            $wordId=$word->id;
            SentenceWord::create(['game_sentence_id'=>$sentenceId,'word_id'=>$wordId]);
        }   
        }
        
        // return new GameSentence([
        //     'sentence'     => $row["text"],
        //    'link'    => $row["news_link"], 
        //    'outlet' => $row["outlet"],
        //    'type' => $row["type"],
        //    'topic' => $row["topic"],
        //    'SentenceBias' => $row["label_bias"],
        //    'SentenceStatus'=>"gold",
        //    'SentenceCount'=>0
        // ]);
    }
     public function batchSize(): int
    {
        return 1000;
    }
     public function uniqueBy()
    {
        return 'sentence';
    }
}
