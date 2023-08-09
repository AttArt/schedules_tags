<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Meeting_rooms;
use App\Models\Plan_dept;
use App\Models\Accessories;
use App\Models\Room_accessories;
use App\Models\Meeting_accessories_list;
use App\Models\Users;
use App\Models\Tag_meeting; 

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
 
class ScheduleController extends Controller
{
    public function index()
    {

        // if (Storage::exists('/public/dept-data-render.json')) {
        //      $data['json']  = Storage::get('/public/dept-data-render.json');
            //  $data['json'] = var_dump($json);

            // echo  $json;
            // exit();   

        // } else { echo 'JSON file not found.'; }
        // $data['schedules'] = Tag_meeting::all();
        // echo  $data['schedules'];
        // exit();   
        //$data['tags'] = Tag_meeting::whereRaw('active LIKE ?', 1)->get();
        $data['tags'] = Tag_meeting::all();
        // $data['schedules'] = Schedule::all();
        $data['meetingroom'] = Meeting_rooms::whereRaw('isopen LIKE ?', 1)->get();
        $data['dept'] = Plan_dept::all();
        $data['accessories'] = Accessories::all();
     
        return view('meetingplanner.index', compact('data'));

    }

    public function show(Request $request)
    {
        $content = $request->query('content');

        if($content == "schedulesOfRoomXMonth") {
            $month = $request->query('month');
            $year = $request->query('year');
            $room = $request->query('room');
            $data = Schedule::where([['mrid', '=', $room]])->whereYear('startdate', '=', $year)->whereMonth('startdate', '=', $month+1)->get();
            return response()->json($data);

        } else if($content == "get_user") {
            $id = $request->query('id');

            $data = Users::whereRaw('empno LIKE ?', $id)->get();
            return response()->json($data);

        } else if($content == "room_acc") {

            ///////////  data room accessories for create event day ///////////
            $id = $request->query('id');

            $data = Room_accessories::whereRaw('mrid LIKE ?', $id)->get();
            return response()->json($data);
            ///////////  data room accessories for create event day ///////////

        } else if($content == "meeting_acc") {

            ///////////  data room accessories for edit,view event day ///////////
            $id = $request->query('id');
            $id2 = $request->query('id2');

            $data1 = Room_accessories::whereRaw('mrid LIKE ?', $id)->get();

            if($id2 != 'null') {
                $data2 = Meeting_accessories_list::whereRaw('planid LIKE ?', $id2)->get();

            } else {
                $data2 = [];

            }

            $object = ['roomacc' => $data1, 'meetingacc' => $data2];

            return response()->json( $object );
            ///////////  data room accessories for edit,view event day ///////////

        }else if($content == "meeting_accview") {

            ///////////  data room accessories for edit,view event day ///////////
            $id = $request->query('id');
            $id2 = $request->query('id2');

            // $data1 = Accessories::all();

            if($id2 != 'null') {
                $data2 = Meeting_accessories_list::whereRaw('planid LIKE ?', $id2)->get();

            } else {
                $data2 = [];

            }

            $object = [ 'meetingacc' => $data2];

            return response()->json( $object );
            ///////////  data room accessories for edit,view event day ///////////

        }  else if($content == "chartSchedule") {
            $year = $request->query('year');
            ///////////  data room schedule for heatMap, chart ///////////
            $data = Schedule::orderBy('startdate', 'desc')->whereYear('startdate', '=', $year)->get();
            return response()->json( $data );
            ///////////  data room schedule for heatMap ///////////
 
        }  else if($content == "mytagmeeting") {

             ///////////  data room schedule for heatMap, chart ///////////
             $id = $request->query('id');
            //  $data = Tag_meeting::whereRaw('create_by LIKE ?', $id)->get();
             $data = Tag_meeting::where([
                                            ['create_by', '=', $id],
                                            ['active', '=', 1]

                                        ])->get();

             return response()->json( $data );
             ///////////  data room schedule for heatMap ///////////
        }
        
        // $request->validate([
        //     'mrid' => 'required',
        // ]);

        // $data['accessories'] = Accessories::all();
        // return view('meetingplanner.index', compact('data'));
    }

    public function create()
    {


        
    }

    public function store(Request $request)
    {

        if($request->content == 'schedule') {
            $request->validate([
                'planid' => 'required',
                'planner' => 'required',
                'tag' => 'required',
                'title' => 'required',
                'mrid' => 'required',
                'deptid' => 'required',
                'startdate' => 'required',
                'enddate' => 'required',
                'count' => 'required'
            ]);
    
            try {

                $schedules = new Schedule;
                $schedules->planid = $request->planid;
                $schedules->planner = $request->planner;
                $schedules->tag = $request->tag;
                $schedules->title = $request->title;
                $schedules->detail = $request->detail;
                $schedules->mrid = $request->mrid;
                $schedules->deptid = $request->deptid;
                $schedules->startdate = $request->startdate;
                $schedules->enddate = $request->enddate;
                $schedules->save();
    
               // protected $fillable = ['listid', 'planid', 'accid', 'quantity']; 
            
                $tagCheck = Tag_meeting::whereRaw('name LIKE ?',$request->tag)->first();
                // echo $tagCheck ;
                if($tagCheck) {
            
                    $tagCheck->tagcount += $request->count;
                    $tagCheck->save();

                }  

                foreach ($request->items as $obj){ 
                    $acclist = new Meeting_accessories_list;
                    $acclist->listid = 'list-'.'00'.substr($request->planid, 4);
                    $acclist->planid = $request->planid;

                    if(explode('+/-*',$obj)[0] == 'acc-B2iaW-26072023-its') {
                        $acclist->accid = explode('+/-*',$obj)[0];
                        $acclist->comment = explode('+/-*',$obj)[1];
                    } else {
                        $acclist->accid = $obj;
                    }

                    $acclist->quantity = 1;
                    $acclist->save();
                }
                
                // for($i=0; $i<count($request->items); $i++) {
                    

                //     $acclist = new Meeting_accessories_list;
                //     $acclist->listid = 'list-'.$i.substr($request->planid, 4);
                //     $acclist->planid = $request->planid;

                //     if(explode('+/-*',$request->items[$i])[0] == 'acc-B2iaW-26072023-its') {
                //         $acclist->accid = explode('+/-*',$request->items[$i])[0];
                //         $acclist->comment = explode('+/-*',$request->items[$i])[1];
                //     } else {
                //         $acclist->accid = $request->items[$i];
                //     }

                //     $acclist->quantity = 1;
                //     $acclist->save();
                // }
    

               

                $message = 'success';
                return response()->json( $message);
                
            } catch(\Exception $e) {
                //\Log::error($e->getMessage());
                $message = $e;
                return response()->json( $message);
            }
    
        } else if($request->content == 'createtag') {

            // $request->validate([
            //     'id' => 'required',
            //     'name' => 'required' 
            // ]);

            // try {
            //     $tagCheck = Tag_meeting::whereRaw('name LIKE ?',$request->name)->first();

            //     if($tagCheck) {
         
            //         $tagCheck->tagcount = $tagCheck->tagcount + 1;
            //         $tagCheck->save();

            //     } else {

            //         // $tag = new Tag_meeting;
            //         // $tag->id = $request->id;
            //         // $tag->name = $request->name; 
            //         // $tag->create_by = $request->create_by;
            //         // $tag->tagcount = 1;
            //         // $tag->active = 1;
            //         // $tag->save();

            //     }

            //     $message = 'success';
            //     return response()->json( $message);
                
            // } catch(\Exception $e) {
            //     // \Log::error($e->getMessage());
            //     $message = 'error';
            //     return response()->json( $message);
            // }

        } else if($request->content == 'createtagOnly') {

            $request->validate([
                'id' => 'required',
                'name' => 'required' 
            ]);

            try {
                $tagCheck = Tag_meeting::whereRaw('name LIKE ?',$request->name)->first();

                if(!$tagCheck) {

                    $tag = new Tag_meeting;
                    $tag->id = $request->id;
                    $tag->name = $request->name; 
                    $tag->create_by = $request->create_by;
                    $tag->tagcount = 0;
                    $tag->active = 1;
                    $tag->save();

                } else {
                    $message = 'meyuu';
                    return response()->json( $message);

                }

                $message = 'success';
                return response()->json( $message);
                
            } catch(\Exception $e) {
                // \Log::error($e->getMessage());
                $message = 'error';
                return response()->json( $message);
            }
        }
        
    }

    public function update(Request $request, $planid)
    {
        if($request->content == 'updateschedule') {
            try {
            
                $request->validate([
                    'tag' => 'required',
                    'title' => 'required',
                    'mrid' => 'required',
                    'deptid' => 'required',
                    'startdate' => 'required',
                    'enddate' => 'required'
                ]);
    
                $schedules = Schedule::find($planid);
                $schedules->tag = $request->tag;
                $schedules->title = $request->title;
                $schedules->detail = $request->detail;
                $schedules->mrid = $request->mrid;
                $schedules->deptid = $request->deptid;
                $schedules->startdate = $request->startdate;
                $schedules->enddate = $request->enddate;
                $schedules->save();
    
                Meeting_accessories_list::whereRaw('planid LIKE ?',$planid)->delete();
    
                for($i=0; $i<count($request->items); $i++) {
                    $acclist = new Meeting_accessories_list;
                    $acclist->listid = 'list-'.$i.substr($request->planid, 4);
                    $acclist->planid = $request->planid;
                    
                    if(explode('+/-*',$request->items[$i])[0] == 'acc-B2iaW-26072023-its') {
                        $acclist->accid = explode('+/-*',$request->items[$i])[0];
                        $acclist->comment = explode('+/-*',$request->items[$i])[1];

                    } else {
                        $acclist->accid = $request->items[$i];
                    }

                    $acclist->quantity = 1;
                    $acclist->save();
                }
    
    
                $message = 'success';
                return response()->json( $message);
    
            } catch(\Exception $e) {
    
                $message = 'error';
                return response()->json( $message);
            }

        } else if($request->content == 'updatetag') {
            
            $request->validate([
                'id' => 'required',
                'name' => 'required' 
            ]);

            try {
                $schedules = Schedule::find($planid);
                
                $tagCheck = Tag_meeting::whereRaw('name LIKE ?',$request->name)->first();
                $tagOldCheck = Tag_meeting::whereRaw('name LIKE ?',$schedules->tag)->first();

                if($tagCheck && $schedules->tag != $request->name ) {

                    $tagOldCheck->tagcount = $tagOldCheck->tagcount - 1;
                    $tagOldCheck->save();

                    $tagCheck->tagcount = $tagCheck->tagcount + 1;
                    $tagCheck->save();
                    

                } else if(!$tagCheck && $schedules->tag == $request->name) {

                        // $tag = new Tag_meeting;
                        // $tag->id = $request->id;
                        // $tag->name = $request->name; 
                        // $tag->create_by = $request->create_by;
                        // $tag->tagcount = 1;
                        // $tag->active = 1;
                        // $tag->save();
    
                } else if(!$tagCheck && $schedules->tag != $request->name) {

                    // $tagOldCheck->tagcount = $tagOldCheck->tagcount - 1;
                    // $tagOldCheck->save();

                    // $tag = new Tag_meeting;
                    // $tag->id = $request->id;
                    // $tag->name = $request->name; 
                    // $tag->create_by = $request->create_by;
                    // $tag->tagcount = 1;
                    // $tag->active = 1;
                    // $tag->save();

                }
                
                $message = 'success';
                return response()->json( $message);
                
            } catch(\Exception $e) {
                // \Log::error($e->getMessage());
                $message = 'error';
                return response()->json( $message);
            }
        } else if($request->content == 'updatetagcolor') {

            $request->validate([
                'name' => 'required',
                'color' => 'required' 
            ]);


            $tag = Tag_meeting::whereRaw('name LIKE ?',$request->name)->first();
            $tag->color = $request->color;
            $tag->save();
        }
        

    }

    public function destroy($content)
    {
        $func = explode('+',$content)[1];
        $id = explode('+',$content)[0];

        

        try {
            if($func == 'delevent') {

                $schedule = Schedule::whereRaw('planid LIKE ?',$id)->first();
                $tagCheck = Tag_meeting::whereRaw('name LIKE ?',$schedule->tag )->first();
                
                if( $tagCheck->tagcount != 0) {
                    $tagCheck->tagcount = $tagCheck->tagcount - 1;
                    $tagCheck->save();
                }
               
                $schedule->delete();
                // Schedule::whereRaw('planid LIKE ?',$planid)->delete();

                Meeting_accessories_list::whereRaw('planid LIKE ?',$id)->delete();

            } else if($func == 'deltag') {
                $tag = Tag_meeting::whereRaw('name LIKE ?',$id)->first();
                $tag->active = 0;
                $tag->save();
            } 

            $message = 'success';
            return response()->json( $message);

        } catch(\Exception $e) {
            $message = 'error';
            return response()->json( $message);
        }

    }
}
