<?php

namespace App\Http\Controllers;
use App\Level;
use DB;
use Validator;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class LevelContoller extends Controller
{
 
	public function index()
    {

    	$data = Level::all();
	 	return View('level.list',compact('data'));
    }

    public function validator(Request $request)
    {
        return Validator::make($request->all(), [
            'level_name' => ['required','unique:level,level_name,'.$request->post('level_id').',level_id', 'string', 'max:255'],
             ]);

    }

    public function edit($level_id)
    {

    	$data = DB::table('level')->select('level_id','level_name')->where('level_id',$level_id)->first();

    	//echo $data->level_id;
    	//echo $data;
    	return View('level.edit',compact('data'));
    }

	public function update(Request $request)
    {
    	$validator = $this->validator($request);
       
    	if($validator->fails()) {
    		return redirect('level/edit/'.$request->post('level_id'))->withErrors($validator);
    	} else {
    		DB::table('level')->where('level_id',$request->post('level_id'))->update(['level_name'=>$request->post('level_name')]);
    	 return redirect('level');
    	}
    	 
    }

    public function add()
    {
    	return View('level.add');
    }



 


    protected function create(Request $request)
    {

    		$validator = $this->validator($request);

    		$level_name = $request->post('level_name');

    	/*$get_level_names = DB::table('level')->select('level_name')->get();
    
    	
    	foreach ($get_level_names as $level) {
    		//echo $level->level_name;

    		if($level_name == $level->level_name)
    		{	

    			$error ="Level name Alredy Exist!";
    			return View('level-add',compact('error'));
                        		
    		} 
    	}
		*/
    	
    	if (!$validator->fails()) {

    		$result = Level::create([
            	'level_name' => $level_name,
            
         	 ]);
           
        }
        else
        {
        	 return redirect('level/add')
                        ->withErrors($validator)
                        ->withInput();
        }
        
    
    	if(!$result)
    	{
    		echo "not inserted";
    	}
    	$data = Level::all();
    	return View('level.list',compact('data'));
    }


    

    public function delete($level_id)
    {
    	$result = DB::table('level')->where('level_id',$level_id)->delete();
    	if(!$result)
    	{
    		echo "not deleted";
    	}
    	return redirect('level');
    }
}
