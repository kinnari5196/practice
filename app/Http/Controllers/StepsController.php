<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Steps;
use DB;
use Validator;
use Session;
use Auth;

class StepsController extends Controller
{
    public function index(Request $request)
    {


        $disease_id = $request->get('disease');
        $level_id = $request->get('level');
       
        
        if($disease_id==NULL && $level_id==NULL)
        {
            $data = DB::table('steps')
            ->join('level', 'steps.level_id', '=', 'level.level_id')
            ->join('disease', 'steps.disease_id', '=', 'disease.disease_id')
            ->join('users', 'steps.id', '=', 'users.id')
            ->select('steps.*', 'disease.*', 'users.*','level.*')
            ->paginate(8);

               
                
        }
        else
        {

    	   $data = DB::table('steps')
            ->join('level', 'steps.level_id', '=', 'level.level_id')
            ->join('disease', 'steps.disease_id', '=', 'disease.disease_id')
            ->join('users', 'steps.id', '=', 'users.id')
            ->select('steps.*', 'disease.*', 'users.*','level.*')
            ->where('steps.level_id',$level_id)
            ->where('disease.disease_id',$disease_id)
            ->paginate(8);
            
            
                
            
        //   echo $data;
        }

       

            $levels = DB::table('level')->select('level_id','level_name')->get();
        
        $diseases = DB::table('disease')->select('disease_id','disease_name')->get();

    	return View('steps.list',compact('data','diseases','levels','disease_id','level_id'));
    }

    public function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'level' => ['required'],
            'disease' =>['required'],
            'steps_desc' =>['required'.$request->post('level_id')],
             ]);

    }


    public function add()
    {
    	$levels = DB::table('level')->select('level_id','level_name')->get();
    	$disease = DB::table('disease')->select('disease_id','disease_name')->get();
    	return View('steps.add',compact('levels','disease'));
    }

    public function create(Request $request)
    {
    	
    		$validator = $this->validator($request);

    		$level_id = $request->post('level');
    		$disease_id = $request->post('disease');
    		$id = Auth::id();
    		$steps_desc = $request->post('steps_desc');


    		$result = DB::table('steps')->select('disease_id','level_id')
    						->where('level_id',$level_id)
    						->where('disease_id',$disease_id)
    						->get();   

    		//echo $result;
    		if(!count($result))
    		{
    			if(!$validator->fails())
    			{
    					Steps::create(['level_id' => $level_id,
    								'disease_id' => $disease_id,
    								'id' => $id,
    								'steps_desc' => $steps_desc, 
    								]);
    				return redirect('steps');	
    			}
    			else
    				{
    				return redirect('steps/add')
    							->withErrors($validator);	
    				}
    		
    		}
    		else
    		{
    			$error ="steps for this Disease for this level exists!! If you want to change is then please edit it. ";
    			$levels = DB::table('level')->select('level_id','level_name')->get();
    			$disease = DB::table('disease')->select('disease_id','disease_name')->get();
    			return View('steps.add',compact('error','levels','disease'));
    		}
    		
    }

    public function edit($steps_id)
    {

    	$data = DB::table('steps')->select('steps_id','steps_desc')
    							  ->where('steps_id',$steps_id)
    							  ->first();
    	return View('steps.edit',compact('data'));
    }

    public function update(Request $request)
    {

    	$validator = Validator::make($request->all(), [
            'steps_desc' =>['required'.$request->post('level_id')],
             ]);
       
    	if(!$validator->fails())
    	{

    		DB::table('steps')->where('steps_id',$request->post('steps_id'))->update(['steps_desc'=>$request->post('steps_desc')]);
    	 return redirect('steps');
    		
    	}
    	 else 
    	 {
    		return redirect('steps/edit/'.$request->post('steps_id'))->withErrors($validator);	
    	 }
    }

    public function delete($steps_id)
    {
    	$result = DB::table('steps')->where('steps_id',$steps_id)->delete();
    	if(!$result)
    	{
    		echo "not deleted";
    	}
    	return redirect('steps');
    }

}
