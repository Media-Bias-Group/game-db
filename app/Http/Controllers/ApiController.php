<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    public function create(Request $req)
    {
        $data = json_decode(file_get_contents('php://input') , true);
        $sql = "insert into " . $data[0]["tablename"] . " values (";
        for ($i = 0;$i < count($data[1]["values"]);$i++)
        {
            if ($i == 0 && is_int($data[1]["values"][$i]))
            {
                $sql .= "" . $data[1]["values"][$i];
            }
            else if ($i == 0 && is_string($data[1]["values"][$i]))
            {
                $sql .= "'" . $data[1]["values"][$i] . "'";
            }
            else if ($i != 0 && is_int($data[1]["values"][$i]))
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
        $data = json_decode(file_get_contents('php://input') , true);
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
            else if ($i == 0 && is_string($data[2]["values"][$i]))
            {
                $sql .= "'" . $data[2]["values"][$i] . "'";
            }
            else if ($i != 0 && is_int($data[2]["values"][$i]))
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
    public function updateValue()
    {
        $data = json_decode(file_get_contents('php://input') , true);
        echo (print_r($data));
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
    public function singleSelect(Request $req){
         $tableName = $req->input('tableName');
         $col = $req->input('col');
         $condition = $req->input('condition');
         $conditionValue = $req->input('conditionValue');
         $value = DB::table($tableName)
            ->select($col)
            ->where($condition,'=',$conditionValue)
            ->get();
            $value=(array)$value[0];
            
           $key = array_keys($value);
         echo($value[$key[0]]);


    }
    public function randomQuestions(){
        
        $questions=DB::table("sentences")
                    ->select("id","Sentence")
                    ->OrderByRaw("RAND()")
                    ->limit(10)
                    ->get();
        foreach($questions as $question){
            echo($question->Sentence."|".$question->id."|");
        }
// $sql="select id , Sentence FROM sentences ORDER BY RAND() LIMIT 10";

// $result=mysqli_query($conn,$sql);
// if(mysqli_num_rows($result)>0){
//     while($row=mysqli_fetch_assoc($result)){
//         echo(($row["Sentence"]."|".$row["id"]."|"));
//     }
// }


    }
    
}

