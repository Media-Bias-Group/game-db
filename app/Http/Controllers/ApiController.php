<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \Cache;
use App\Models\Outlet;
use App\Models\Survey;
use App\Models\SurveyOutlet;
use App\Models\TutorialAnswer;
use App\Models\Word;
use App\Models\SentenceWord;
use App\Models\GameUser;
use App\Models\Topic;
use App\Models\TopicDailyProgress;
use App\Models\SentenceAnswer;
use App\Models\WordsAnswer;
use App\Models\TutorialWordsAnswers;
use App\Models\SentenceProgress;
use App\Models\TopicProgress;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public $topics = "null";
    public function create(Request $req)
    {
        $data = json_decode(file_get_contents("php://input") , true);
        $sql = "insert into " . $data[0]["tablename"] . " values (";
        for ($i = 0;$i < count($data[1]["values"]);$i++)
        {
            if ($i == 0 && is_int($data[1]["values"][$i]))
            {
                $sql .= "" . $data[1]["values"][$i];
            }
            elseif ($i == 0 && is_string($data[1]["values"][$i]))
            {
                $sql .= "'" . $data[1]["values"][$i] . "'";
            }
            elseif ($i != 0 && is_int($data[1]["values"][$i]))
            {
                $sql .= "," . $data[1]["values"][$i];
            }
            else
            {
                $sql .= ", '" . $data[1]["values"][$i] . "'";
            }
        }
        $sql .= ")";

        DB::statement($sql);
    }
    public function createWithColumns()
    {
        $data = json_decode(file_get_contents("php://input") , true);
        $sql = "insert into " . $data[0]["tablename"] . "(";
        for ($i = 0;$i < count($data[1]["cols"]);$i++)
        {
            if ($i == 0)
            {
                $sql .= $data[1]["cols"][$i];
            }
            else
            {
                $sql .= ", " . $data[1]["cols"][$i];
            }
        }
        $sql .= ") values (";
        for ($i = 0;$i < count($data[2]["values"]);$i++)
        {
            if ($i == 0 && is_int($data[2]["values"][$i]))
            {
                $sql .= "" . $data[2]["values"][$i];
            }
            elseif ($i == 0 && is_string($data[2]["values"][$i]))
            {
                $sql .= "'" . $data[2]["values"][$i] . "'";
            }
            elseif ($i != 0 && is_int($data[2]["values"][$i]))
            {
                $sql .= "," . $data[2]["values"][$i];
            }
            else
            {
                $sql .= ", '" . $data[2]["values"][$i] . "'";
            }
        }
        $sql .= ")";
        DB::statement($sql);
    }
    public function updateOrInsert()
    {
        $data = json_decode(file_get_contents("php://input") , true);

        DB::table($data[0]["tablename"])->updateOrInsert([$data[1]["uniqueCols"][0] => $data[3]["values"][0], $data[1]["uniqueCols"][1] => $data[3]["values"][1], ], [$data[2]["changedValue"] => $data[3]["values"][2]]);
    }
    public function updateValue()
    {
        $data = json_decode(file_get_contents("php://input") , true);
        
        if (is_int($data[2]["values"][0]))
        {
            $value = $data[2]["values"][0];
        }
        else
        {
            $value = "'" . $data[2]["values"][0] . "'";
        }

        DB::table($data[0]["tablename"])->where($data[3]["condition"], $data[4]["conditionValue"])->update([$data[1]["col"] => $value]);
    }
    public function singleSelect(Request $req)
    {
        $tableName = $req->input("tableName");
        $col = $req->input("col");
        $condition = $req->input("condition");
        $conditionValue = $req->input("conditionValue");
        $value = DB::table($tableName)->select($col)->where($condition, "=", $conditionValue)->get();
        $value = (array)$value[0];

        $key = array_keys($value);
        echo $value[$key[0]];
    }
    public function randomQuestions()
    {
        $questions = DB::table("sentences")->select("id", "Sentence")
            ->OrderByRaw("RAND()")
            ->limit(10)
            ->get();
        foreach ($questions as $question)
        {
            echo $question->Sentence . "|" . $question->id . "|";
        }
        // $sql="select id , Sentence FROM sentences ORDER BY RAND() LIMIT 10";
        // $result=mysqli_query($conn,$sql);
        // if(mysqli_num_rows($result)>0){
        //     while($row=mysqli_fetch_assoc($result)){
        //         echo(($row["Sentence"]."|".$row["id"]."|"));
        //     }
        // }
        
    }

    public function increment(Request $req)
    {

        $tableName = $req->input("tableName");
        $col = $req->input("col");
        $condition = $req->input("condition");
        $conditionValue = $req->input("conditionValue");
        DB::table($tableName)->where($condition, $conditionValue)->increment($col);
    }
    public function calculateBias(Request $req)
    {
        $sentenceId = $req->input("sentenceId");
        $sentence = DB::table("sentences")->where("id", $sentenceId);
        $sentenceStatus = $sentence->pluck("SentenceStatus")
            ->first();
        $sentenceCount = $sentence->pluck("SentenceCount")
            ->first();
        $biasedCount = DB::table('answers')->where("sentence_id", $sentenceId)->where("annotation", 1)
            ->count();
        $nonBiasedCount = DB::table('answers')->where("sentence_id", $sentenceId)->where("annotation", -1)
            ->count();
        //calculate ratio of biased to non biased
        if ($biasedCount < $nonBiasedCount)
        {
            $agreementRatio = $biasedCount / $nonBiasedCount;
        }
        else if ($biasedCount > $nonBiasedCount)
        {
            $agreementRatio = $nonBiasedCount / $biasedCount;
        }
        //changing sentence type
        if ($sentenceStatus == "fresh" && $sentenceCount == 10 && $agreementRatio < 0.7)
        {
            DB::table('sentences')->where("id", $sentenceId)->update(["SentenceStatus" => "golden-fresh"]);
        }
        //calculating Bias
        $sentenceStatus = $sentence->pluck("SentenceStatus")
            ->first();
        if ($sentenceStatus == "golden-fresh")
        {
            $biasMark = DB::table("answers")->where("sentence_id", $sentenceId)->sum("annotation");
            if ($biasMark > 0)
            {
                DB::table("sentences")->where("id", $sentenceId)->update(["SentenceBias" => "Biased"]);
            }
            elseif ($biasMark < 0)
            {
                DB::table("sentences")->where("id", $sentenceId)->update(["SentenceBias" => "Non-biased"]);
            }
            else
            {
                DB::table("sentences")
                    ->where("id", $sentenceId)->update(["SentenceBias" => "No agreement"]);
            }
        }

    }
    public function getDailyTopics()
    {
        $topics = Cache::get('topics');
        foreach ($topics as $topic)
        {
            echo ($topic->topic) . "|";
        }
    }
    public function submitSurvey(Request $req)
    { //save survey data
        $survey = Survey::create(['user_id' => $req->user_id, 'gender' => $req->gender, 'age' => $req->age, 'education' => $req->education, 'proficiency' => $req->proficiency, 'behaviour' => $req->behaviour, 'averageNewsCheck' => $req->averageNewsCheck],);
        $surveyId = $survey->id;
        $selectedOutlets = explode(",", $req->selectedOutlets);
        foreach ($selectedOutlets as $outlet)
        {
            SurveyOutlet::updateOrCreate(['survey_id' => $surveyId, 'outlet_id' => $outlet]);
        }

    }
    public function submitTutorial(Request $req)
    { //save survey data
        TutorialAnswer::create(['user_id' => $req->user_id, 'tutorial_question_id' => $req->DBQuestionNo, 'answer' => $req->answer]);
       
    }

    public function createUser(Request $req)
    { //save user data

        GameUser::updateOrCreate(['id'=> $req->id],['global_skill'=> $req->global_skill,'global_XP'=> $req->global_XP,'game_finished'=> $req->game_finished]);
       
    }

    public function insertWrongAnswer(Request $req){
        $word=Word::firstOrCreate(['word' => $req->word], ['word' => $req->word]);
        WordsAnswer::create(['word_id' => $word->id, 'user_id' => $req->user_id, 'annotaion' => 1, 'answer' => 0]);
    }

    public function getLevel6()
    {
          $questions = DB::table("sentences")->select("id", "Sentence","SentenceBias")
            ->whereIn('id',[2,3,4,6,15,16,29,45,50,122])
            ->get();
           
        foreach ($questions as $question)
        {
            echo $question->Sentence . "|" . $question->id . "|".$question->SentenceBias."|";
        }
    }
    public function getLevel7()
    {
          $questions = DB::table("sentences")->select("id", "Sentence","SentenceBias")
            ->whereIn('id',[30,36,62,78,90,111,173,190,196,231])
            ->get();
           
        foreach ($questions as $question)
        {
            echo $question->Sentence . "|" . $question->id . "|".$question->SentenceBias."|";
        }
    }
    public function getWords(Request $req)  
    {
        
        $words = Word::join('sentence_words', 'words.id', '=', 'sentence_words.word_id')
        ->where('sentence_words.game_sentence_id', '=',$req->sentenceId)->get(['*']);
          
        foreach ($words as $word)
        {
            echo $word->word."|".$word->id."|";
        }
    }

    public function getTopics(Request $req)  
    {
        $topics = Topic::select('topic_name')->get();

          
        foreach ($topics as $topic)
        {
            echo $topic->topic_name."|";
        }
    }
    public function getTopicsDailyProgress(Request $req)  
    {
        
        $topics = TopicDailyProgress::select('topic_id')->where('user_id', $req->user_id)->get();

          
        foreach ($topics as $topic)
        {
            echo $topic->topic_id."|";
        }
    }
    public function getSentencePackage(Request $req)  
    {
        $progress = DB::table('sentence_progress')
                   ->where('user_id', $req->user_id);

        $sentences = DB::table('game_sentences')
        ->leftJoinSub($progress, 'sentence_progress', function ($join) {
            $join->on('game_sentences.id', '=', 'sentence_progress.sentence_id');
        })->where('topic',$req->topic)
        ->select('game_sentences.id','sentence','SentenceBias')
        ->whereNull('user_id')
        ->inRandomOrder()
        ->limit(10)
        ->get();


        
         foreach ($sentences as $sentence)
        {
            echo $sentence->id . "|" . $sentence->sentence . "|".$sentence->SentenceBias."|";
        }
        
          
        // foreach ($sentences as $sentence)
        // {
        //     echo $sentence->sentence . "|" . $sentence->id . "|".$sentence->SentenceBias."|";
        // }
    }

    public function getWordSentences(Request $req)  
    {
       
        $sentences = DB::table('game_sentences')
        ->select('game_sentences.id','sentence')
        ->inRandomOrder()
        ->limit(10)
        ->get();


        
         foreach ($sentences as $sentence)
        {
            echo $sentence->id . "|" . $sentence->sentence . "|";
        }
        
          
        // foreach ($sentences as $sentence)
        // {
        //     echo $sentence->sentence . "|" . $sentence->id . "|".$sentence->SentenceBias."|";
        // }
    }

    public function submitSentenceAnswer(Request $req)
    {
        SentenceAnswer::create(['sentence_id' => $req->sentence_id, 'user_id' => $req->user_id, 'annotaion' => $req->annotaion, 'answer' => $req->answer,'skill'=>$req->skill]);
    }
    public function submitWordAnswer(Request $req)
    {
        WordsAnswer::create(['word_id' => $req->word_id, 'user_id' => $req->user_id, 'annotaion' => $req->annotaion, 'answer' => $req->answer]);
    }
    public function submitTutorialWordAnswer(Request $req)
    {
        $word=Word::firstOrCreate(['word' => $req->word], ['word' => $req->word]);
        TutorialWordsAnswers::create(['word_id' => $word->id, 'user_id' => $req->user_id, 'annotaion' => $req->annotation, 'answer' => $req->answer]);
        
    }
    public function submitSentenceProgress(Request $req)
    {
    SentenceProgress::create(['user_id'=>$req->user_id,'sentence_id' => $req->sentence_id]);
    }
    public function submitTopicDailyProgress(Request $req)
    {
    TopicDailyProgress::create(['user_id'=>$req->user_id,'topic_id' => $req->topic_id]);
    }
    public function submitTopicProgress(Request $req)
    {
    TopicProgress::create(['user_id'=>$req->user_id,'topic_id' => $req->topic_id]);
    }
    public function getXPValue(Request $req){
        $XPValue = GameUser::where('id',  $req->id)->pluck('global_xp')->first();
echo $XPValue;
    }

      public function getSkillValue(Request $req){
        $SkillValue = GameUser::where('id',  $req->id)->pluck('global_skill')->first();
echo $SkillValue;
    }

     public function updateXPValue(Request $req){
       $affectedRows = GameUser::where('id',$req->id )->update(['global_XP' => $req->xp]);
    }

     public function calculateGlobalSkill(Request $req){
$sum=SentenceAnswer::where('user_id', $req->user_id)->sum('skill');
$count = SentenceAnswer::where('user_id', $req->user_id)->count();
$affectedRows = GameUser::where('id',$req->user_id )->update(['global_skill' =>$sum/$count ]);

    //    $affectedRows = GameUser::where('id',$req->id )->update(['global_XP' => $req->xp]);
    }
    

}

