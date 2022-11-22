<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MatchLogView;
use App\Models\ScheduleMatch;
use Illuminate\Http\Request;

class MatchRepotingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $model = new MatchLogView();
        if((int)$request->query('match')!=0){
            // $model = $model->where('schedule_id',$request->query('match'));
            $Schedule = ScheduleMatch::find($request->query('match'));
            $resultHome= $model->where('team_id',$Schedule->home_team_id)->where('schedule_id',$request->query('match'))->count();
            $resultAway= $model->where('team_id',$Schedule->away_team_id)->where('schedule_id',$request->query('match'))->count();
            $resultMaxGoal= $model->select(\DB::raw('count(person_id)as goal'),'person_id','person_name','schedule_id','name')->where('schedule_id',$request->query('match'))->groupBy('person_id')->orderBy('goal','DESC')->first();
            // dd($resultMaxGoal);
            $finalResult = '';
            if($resultAway == $resultHome){
                $finalResult .='Draw';
            }
            if($resultAway > $resultHome){
                $finalResult .='Away Win';
            }
            if($resultAway < $resultHome){
                $finalResult .='Home Win';
            }
            $reponseJson = [
                'jadwal_pertandingan' => $Schedule->match_date.' '.$Schedule->match_time,
                'home_team' =>$Schedule->HomeTeam->name,
                'away_team' =>$Schedule->AwayTeam->name,
                'score' => [
                    'home' =>$resultHome,
                    'away' =>$resultAway,
                ],
                'goal_max_person'=>[
                    'person'=>$resultMaxGoal->person_name,
                    'goal' =>$resultMaxGoal->goal,
                    'team' =>$resultMaxGoal->name,
                ],
                'result_match' =>$finalResult
            ];
            return response()->json($reponseJson, 200);

        }
        if($request->query('goal')){

        }
    }


}
