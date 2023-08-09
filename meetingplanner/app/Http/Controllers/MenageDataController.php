<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Meeting_rooms;
use App\Models\Accessories;
use App\Models\Room_accessories;
use App\Models\Plan_dept;
// use App\Models\Users; 
// use App\Models\Public_dept; 
use App\Models\Tag_meeting; 

class MenageDataController extends Controller {

    public function index()
    {
   
        $data['meetingroom'] = Meeting_rooms::all();
        // $data['dept'] = Public_dept::all();

        // echo $data['dept'];
        // exit();
        
        return view('meetingplanner.admin', compact('data'));
    }

    public function show(Request $request)
    {
        $content = $request->query('content');

        if($content == "meetingroom") {

            ///////////  data accessories for admin /////////// 
            $value = $request->query('value');

            $data = Meeting_rooms::whereRaw('LOWER(mrid) LIKE ?', ["%".strtolower($value)."%"])
            ->orWhereRaw('LOWER(mrname) LIKE ?', ["%".strtolower($value)."%"])->orderBy('created_at', 'asc')->get();

            return response()->json($data);
            ///////////  data accessories for admin ///////////

        } else if($content == "accessories") {

            ///////////  data accessories for admin /////////// 
            $value = $request->query('value');

            $data = Accessories::whereRaw('LOWER(accname) LIKE ?', ["%".strtolower($value)."%"])
            ->orWhereRaw('LOWER(accid) LIKE ?', ["%".strtolower($value)."%"])->orderBy('created_at', 'asc')->get();

            return response()->json($data);
            ///////////  data accessories for admin ///////////

        } else if($content == "roomsAccessories") {

            ///////////  data room accessories for admin ///////////
            $id = $request->query('id');

            $dataRoomAcc = Room_accessories::with('accessories')->whereRaw('mrid LIKE ?', $id)->orderBy('created_at', 'asc')->get();

            return response()->json( $dataRoomAcc );
            ///////////  data room accessories for admin ///////////

        } else if($content == "depts") {

            ///////////  data dept for admin ///////////
            $value = $request->query('value');
            $value = str_replace('-_-', '#', $value);

            $dataDept = Plan_dept::whereRaw('LOWER(id) LIKE ?', ["%".strtolower($value)."%"])
            ->orWhereRaw('LOWER(name) LIKE ?', ["%".strtolower($value)."%"])
            ->orWhereRaw('LOWER(color) LIKE ?',["%".strtolower( $value)."%"])->get();

            return response()->json( $dataDept );
            ///////////  data dept for admin ///////////

        } else if($content == "tagsMeetings") {

            ///////////  data dept for admin ///////////
            $value = $request->query('value');
            $value = str_replace('-_-', '#', $value);

            $dataTags = Tag_meeting::whereRaw('LOWER(name) LIKE ?', ["%".strtolower($value)."%"])
            ->orWhereRaw('LOWER(color) LIKE ?', ["%".strtolower($value)."%"])
            ->orWhereRaw('LOWER(create_by) LIKE ?', ["%".strtolower($value)."%"])
            ->orWhereRaw('LOWER(created_at) LIKE ?',["%".strtolower($value)."%"])->orderBy('created_at', 'asc')->get();

            return response()->json( $dataTags );
            ///////////  data dept for admin ///////////

        }
    }
    
    
    public function store(Request $request)
    {
        try {
            if($request->content == 'addroom') {

                $request->validate([
                    'mrid' => 'required',
                    'mrname' => 'required'
                ]);
        
               
                $meetigRoom = new Meeting_rooms;
                $meetigRoom->mrid = $request->mrid;
                $meetigRoom->mrname = $request->mrname;
                $meetigRoom->isopen = 1; 
                $meetigRoom->save();
               
            } else if($request->content == 'addacc') {
               
                $request->validate([
                    'accid' => 'required',
                    'accname' => 'required'
                ]);
        
                $accessories = new Accessories;
                $accessories->accid = $request->accid;
                $accessories->accname = $request->accname;
                $accessories->save();

            } else if($request->content == 'addroomacc') {

                // echo $request->rlistid;
                // echo $request->accid;
                // echo $request->mrid;
                // echo $request->value;

                $xxx =  Room_accessories::where([
                        ['mrid', '=', $request->mrid],
                        ['accid', '=', $request->accid]])->get();
                        
                if( count($xxx) != 0 && $request->value != 1 ) {
                    
                    Room_accessories::where([
                        ['mrid', '=', $request->mrid],
                        ['accid', '=', $request->accid]])->delete();

                }  else {
                    
                    $roomAccessories = new Room_accessories;
                    $roomAccessories->rlistid = $request->rlistid;
                    $roomAccessories->mrid = $request->mrid;
                    $roomAccessories->accid = $request->accid;
                    $roomAccessories->active = $request->value;
                    $roomAccessories->save();
                }

               


            } else if($request->content == 'adddept') {

                // $request->validate([
                //     'id' => 'required',
                //     'accname' => 'required',
                //     'color' => 'required'
                // ]);  {"id":"boiler","name":"Boiler","color":"#00A9FF","rgb":,"class":"dept-boiler","active":1} "#e6e6e6,#e6e6e6,#e6e6e6,#e6e6e6,#e6e6e6"

         
                $dept = new Plan_dept;
              
                $dept->id = $request->id;
                $dept->name = $request->name;
                $dept->color = $request->color;
                $dept->rgb = '';
                $dept->class = '';
                $dept->active = 1;
                $dept->timestamps = false;
                $dept->save();

            } else if($request->content == 'addtag') {
 
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
                
            }
 
            $message = 'success';
            return response()->json( $message);

        } catch(\Exception $e) {
            //\Log::error($e->getMessage());
            $message = $e;
            return response()->json( $message);
        }
    }


//     use Illuminate\Http\Request;
// use App\Models\Meeting_rooms;
// use App\Models\Accessories;
// use App\Models\Room_accessories; 
// use App\Models\Plan_dept;


    public function update(Request $request, $tableDB)
    {

   
        try {
            //วิศวะกรรม/ช่างซ่อมบำรุง
            if($tableDB == 'mroom') {

                if($request->name == 'mrname') {

                    $mroom = Meeting_rooms::whereRaw('mrid LIKE ?',$request->id)->first();
                   
                    $mroom->mrname = $request->value; 
                    $mroom->save();

                } else if($request->name == 'isopen') {

                    $mroom = Meeting_rooms::whereRaw('mrid LIKE ?',$request->id)->first();

                    $mroom->isopen = $request->value; 
              
                    $mroom->save();
                    // echo $request->value;  ;
                    // exit();
                } 

            } else if($tableDB == 'acc') {

                if($request->name == 'accname') {

                    $acc = Accessories::whereRaw('accid LIKE ?',$request->id)->first();

                    $acc->accname = $request->value; 
                    $acc->save();

                } else if($request->name == 'detail') {

                    $acc = Accessories::whereRaw('accid LIKE ?',$request->id)->first();

                    $acc->detail = $request->value;
                    $acc->save();
                    
                }

            }  else if($tableDB == 'dept') {
              
                if($request->name == 'name') {
                   
                    $dept = Plan_dept::whereRaw('id LIKE ?',$request->id)->first();
                    $dept->name = $request->value;  
                    $dept->timestamps = false;
                    $dept->save();

                    

                } else if($request->name == 'color') {

                    $dept = Plan_dept::whereRaw('id LIKE ?',$request->id)->first();
                    // echo $dept;  
                    // exit();
                    $dept->timestamps = false;
                    $dept->color = $request->value; 
                    $dept->save();

                } 
            } else if($tableDB == 'tag') {
              
                if($request->name == 'active') {
                   
                    $tag = Tag_meeting::whereRaw('id LIKE ?',$request->id)->first();
                    $tag->active = $request->value;  
                    $tag->save();

                } else if($request->name == 'color') {
                    $tag = Tag_meeting::whereRaw('id LIKE ?',$request->id)->first();
                    $tag->color = $request->value;  
                    $tag->save();
                }
            } 
            
            $message = 'success';
            return response()->json( $message);

        } catch(\Exception $e) {
            // \Log::error($e->getMessage());
            $message = $e;
            return response()->json( $message);
        }

    }

    

    public function destroy($content)
    {
 
        $func = explode('+',$content)[1];
        $id = explode('+',$content)[0];
        
        try {
            if($func == 'delroom') {
                Meeting_rooms::whereRaw('mrid LIKE ?',$id)->delete();

            } else if($func == 'delacc') {

                if($id != 'acc-B2iaW-26072023-its') {
                    
                    Accessories::whereRaw('accid LIKE ?',$id)->delete();
                    Room_accessories::whereRaw('accid LIKE ?',$id)->delete();
    
                }
              
            } else if($func == 'delroomacc') {
                Room_accessories::whereRaw('rlistid LIKE ?',$id)->delete();

            } else if($func == 'deldept') {
                Plan_dept::whereRaw('id LIKE ?',$id)->delete();

            } else if($func == 'deltag') {
                Tag_meeting::whereRaw('id LIKE ?',$id)->delete();

            } 

            $message = 'success';
            return response()->json( $message);

        } catch(\Exception $e) {
        
            $message = 'error';
            return response()->json( $message);
        }

    }

}