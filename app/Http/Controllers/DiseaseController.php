<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Disease;
use Validator;
class DiseaseController extends Controller
{
    


    public function index()
    {
    	$data = Disease::all();
	 	return View('disease.list',compact('data'));
    }

    public function validator(Request $request)
    {
    	return Validator::make($request->all(), [
            'disease_name' => ['required','unique:disease,disease_name,'.$request->post('disease_id').',disease_id', 'string', 'max:255'],
   			  ]);
    }

    public function add()
    {
    	return View('disease.add');
    }

    public function create(Request $request)
    {

    	$validator = $this->Validator($request);


    	$disease_name = $request->get('disease_name');

    		if (!$validator->fails()) 
    		{

    			$result = Disease::create([
            	'disease_name' => $disease_name,
            	 ]);
           
        	}
        else
        {
        	 return redirect('disease/add')
                        ->withErrors($validator);
        }
        
    
    	if(!$result)
    	{
    		echo "not inserted";
    	}

    	$data = Disease::all();
    	return View('disease.list',compact('data'));

    }


    public function edit($disease_id)
    {
    	$data = DB::table('disease')
    				->select('disease_id','disease_name')
    				->where('disease_id',$disease_id)
    				->first();

    	return View('disease.edit',compact('data'));
    }

    public function update(Request $request)
    {
    	$validator = $this->validator($request);

    	if($validator->fails())
    	{

    		return redirect('disease/edit/'.$request->post('disease_id'))
    				->withErrors($validator);
    	}
    	else
    	{
    		DB::table('disease')
    			->where('disease_id',$request->post('disease_id'))
    			->update(['disease_name'=>$request->post('disease_name')]);

    	 	return redirect('disease');
    	}
    }

    public function delete($disease_id)
    {
        $result = DB::table('disease')->where('disease_id',$disease_id)->delete();
        if(!$result)
        {
            echo "not deleted";
        }
        return redirect('disease');
    }

    
}
