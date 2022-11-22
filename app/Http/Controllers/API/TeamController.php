<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Team\TeamStoreRequest;
use App\Http\Requests\API\Team\TeamUpdateRequest;
use App\Http\Resources\API\Team\TeamDeleteResources;
use App\Http\Resources\API\Team\TeamResource;
use App\Models\Team;
use App\Helper\HttpNullHelper;
use App\Http\Resources\API\Team\TeamAllResources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class TeamController extends Controller
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
    public function index(Request $request)
    {

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
    public function store(TeamStoreRequest $request)
    {
        try {
            if($request->has('team_logo')){
                $file = $request->file('team_logo');
                $nameFile =Str::slug($request->name).'.'.$file->getClientOriginalExtension();
                $file->storeAs('team_logo',$nameFile);
                $request->merge(['logo'=>'team_logo/'.$nameFile]);
            }
            $model = Team::create($request->except('team_logo'));
            return response()->json(new TeamResource(null,$model),200);
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
        // dd($request->query('team-name'));
        if((int)$request->query('find') != 0){
            if($model = Team::find($request->query('find'))){
                return response()->json(['error'=>false,
                                        'message' => 'Team Founded',
                                        'data'=>new TeamAllResources($model)
                                        ]);
            }
            return response()->json($this->helper->nullJsonMessage("Team"),404);
        }
        if($request->query('team-name')){
            $name = $request->query('team-name');
            if($model = Team::where('name','like',"%$name%")->first()){
                return response()->json(['error'=>false,
                                        'message' => 'Team Founded',
                                        'data'=>new TeamAllResources($model)
                                        ]);
            }
            return response()->json($this->helper->nullJsonMessage("Find Team"),404);
        }
        return response()->json(['error'=>false,
                                 'message' => 'Get All Team',
                                 'data'=>TeamAllResources::collection(Team::all())
                                ]);
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
    public function update(Request $request,$id)
    {
        $model = new Team();
        if($data = $model->find($id)){
            if($request->has('team_logo')){
                Storage::delete($data->logo);
                $file = $request->file('team_logo');
                $nameFile =Str::slug($request->name).'.'.$file->getClientOriginalExtension();
                $file->storeAs('team_logo',$nameFile);
                $request->merge(['logo'=>'team_logo/'.$nameFile]);
            }
            $model->where('id',$id)->update($request->except('team_logo'));
            return response()->json(new TeamResource('Team Has Update',$model->find($id)));
        }
        return response()->json($this->helper->nullJsonMessage("Team $request->name"),400);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($model = Team::findOrFail($id)){
            return response()->json(new TeamDeleteResources($model));
        }
        return response()->json($this->helper->nullJsonMessage("Team"),400);
    }
}
