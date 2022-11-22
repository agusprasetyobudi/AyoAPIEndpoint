<?php

namespace App\Http\Controllers\API;

use App\Helper\HttpNullHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\API\TeamPerson\CreateTeamPersonRequest;
use App\Http\Resources\API\TeamPerson\AllTeamPersonResource;
use App\Http\Resources\API\TeamPerson\TeamPersonResource;
use App\Models\TeamPerson;
use Illuminate\Http\Request;

class TeamPersonController extends Controller
{
    public $helper;
    public function __construct(HttpNullHelper $helper)
    {
        $this->helper = $helper;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateTeamPersonRequest $request)
    {
        try {
            $model = new TeamPerson();
            if($model->where(['nomor_punggung'=>$request->nomor_punggung,'team_id'=>$request->team_id])->first()){
                return response()->json([
                    'error'=>true,
                    'message'=> 'Nomor Punggung tidak boleh sama',
                    'data'=> null
                ], 400);
            }
            $data = $model->create($request->all());
            return response()->json(new TeamPersonResource(null,$data), 200);
        } catch (\Throwable $th) {
            //throw $th;
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
        $model = new TeamPerson();
        if(!$request->query('teams')){
            return response()->json([
                'error'=> true,
                'message' => 'Team wajib diisi',
                'data' => null
            ], 400);
        }
        if((int)$request->query('find')!=0){
            if($model = $model->where(['id'=>$request->query('find'),'team_id'=>$request->query('teams')])->first()){
                return response()->json([
                                'error'=>false,
                                'message' => 'Person has found',
                                'data'=>new AllTeamPersonResource($model)
                ], 200);
            }
            return response()->json($this->helper->nullJsonMessage("Find Person"), 400);

        }
        if($name = $request->query('name-person')){
            if($model = $model->where('person_name','like',"%$name%")->where('team_id',$request->query('teams'))->first()){
                return response()->json([
                                'error'=>false,
                                'message' => 'Person has found',
                                'data'=>new AllTeamPersonResource($model)
                ], 200);
            }
            return response()->json($this->helper->nullJsonMessage("Find Person"), 400);
        }
        if(!$request->query('find') && !$request->query('name-person')){
            $model = $model->where('team_id',$request->query('teams'))->get();
            return response()->json([
                                'error'=>false,
                                'message' => 'Person has found',
                                'data'=>AllTeamPersonResource::collection($model)
            ], 200);
        }
        return response()->json($this->helper->nullJsonMessage("Find Person"), 400);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $model = new TeamPerson();
        if($model = TeamPerson::find($id)){
            $model->fill($request->all());
            $model->save();
            return response()->json(new TeamPersonResource("Team Person Has Updated",$model), 200);
        }
        return response()->json($this->helper->nullJsonMessage("Team Person"), 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($model = TeamPerson::find($id)){
            $model->delete();
            return response()->json(new TeamPersonResource("Team Person Has Deleted",$model), 200);
        }
        return response()->json($this->helper->nullJsonMessage("Person"), 404);
    }
}
