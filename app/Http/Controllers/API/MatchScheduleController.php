<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\ScheduleMatch;
use App\Helper\HttpNullHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\MatchSchedule\CreateMatchScheduleRequest;
use App\Http\Resources\API\MatchSchedule\FindOrUpdateMatchScheduleResource;
use App\Http\Resources\API\MatchSchedule\GetMatchScheduleResource;

class MatchScheduleController extends Controller
{
    public $helper;
    public function __construct(HttpNullHelper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateMatchScheduleRequest $request)
    {
        try {
            $request->merge([
                'home_team_id' => $request->home_team,
                'away_team_id' => $request->away_team,
            ]);
            $model = ScheduleMatch::create($request->except('home_team','away_team'));
            return response()->json(new FindOrUpdateMatchScheduleResource('Schedule Has Create',$model),200);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $model = new ScheduleMatch();
        if((int)$request->query('find')!=0){
            if($model = $model->find($request->query('find'))){
                return response()->json(new FindOrUpdateMatchScheduleResource("Schedule Match Found",$model), 200);
            }
            return response()->json($this->helper->nullJsonMessage("Schedule Match"), 404);
        }
        if($request->query('match-location')){
            $data = $request->query('match-location');
            $model = $model->where('location','like',"%$data%")->get();
            return response()->json(new GetMatchScheduleResource("Get Match By Location",$model), 200);
        }
        if($request->query('match-date')){
            $data = $request->query('match-date');
            $model = $model->where('match_date','like',"%$data%")->get();
            return response()->json(new GetMatchScheduleResource("Get Match By Date",$model), 200);
        }
        $model = $model->latest('match_date')->get();
        return response()->json(new GetMatchScheduleResource("Get All Match ",$model), 200);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateMatchScheduleRequest $request, $id)
    {
        if($model = ScheduleMatch::find($id)){
            $request->merge([
                'home_team_id' => $request->home_team,
                'away_team_id' => $request->away_team,
            ]);
            $model->fill($request->except('home_team','away_team'));
            $model->save();
            return response()->json(new FindOrUpdateMatchScheduleResource(null,$model),200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * View a log resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewLogMatch(Request $request,$id)
    {
        # code...
    }
    /**
     * Store a newly created log resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function storeLogMatch(Request $request)
    {
        # code...
    }

    /**
     * Remove the specified log record from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function removeLogMatch(Request $request)
    {
        # code...
    }
}
