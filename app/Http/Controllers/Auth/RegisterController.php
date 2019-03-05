<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Auth;
use DB;
use Session;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('guest');
    }*/

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

    public function index()
    {
        return View('profile');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'age' => ['required', 'integer'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'levels' =>['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' =>['required','string','min:8'],
            'profile_photo' =>['required','max:2048','image','mimes:jpeg,png,jpg'],
            'role' => ['required'],


        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */



    protected function create(request $request)
    {

        $image = $request->file('profile_photo');
        $tmp = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $tmp);

        Session::put('level_id',$request->post('level_id'));
        Session::put('role',$request->post('role'));
        //Session::get('role');

        
        return User::create([
            'first_name' => $request->post('first_name'),
            'last_name' => $request->post('last_name'),
            'age' => $request->post('age'),
            'email' => $request->post('email'),
            'contact_no' => $request->post('contact_no'),
            'level_id' => $request->post('levels'),
            'password' => Hash::make($request->post('password')),
            'profile_photo' => $tmp,
            'role' => $request->post('role'),
            
        ]);
    }

    public function edit()
    {
       $id = Auth::id();
        
        $data = DB::table('users')->select('*')->where('id',$id)->first();
      
        return View('profile.edit',compact('data'));
    }

    public function update(Request $request)
    {

        $id = Auth::id();
        $validator = Validator::make($request->all(), [

            'first_name' =>['required'],
            'last_name' =>['required'],
            'age' =>['required'],
            'email' => ['required','unique:users,email,'.$id.',id','max:30'],
            'contact_no' =>['required'],

             ]);

       
       $data = DB::table('users')->select('*')->where('id',$id)->first();
       $profile_photo = $data->profile_photo;


       if($request->file('profile_photo')!=NULL)
       {

        if(file_exists('images/'.$profile_photo))
        {
        unlink('images/'.$profile_photo);
        }

        $image = $request->file('profile_photo');
        $tmp = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $image->move($destinationPath, $tmp);

        if($validator->fails())
        {
            return redirect('profile/edit')->withErrors($validator);
        
        }
        else
         {

                 DB::table('users')->where('id',$id)->update(
               [
                'first_name'=>$request->post('first_name'),
                'last_name'=>$request->post('last_name'),
                'age' =>$request->post('age'),
                'email' => $request->post('email'),
                'contact_no' =>$request->post('contact_no'),
                'profile_photo'=>$tmp,

            ]);
         }
        }
        else
        {

            if($validator->fails())
            {
                return redirect('profile/edit')->withErrors($validator);
            }
            else
            {

             DB::table('users')->where('id',$id)->update(
                [
                'first_name'=>$request->post('first_name'),
                'last_name'=>$request->post('last_name'),
                'age' =>$request->post('age'),
                'email' => $request->post('email'),
                'contact_no' =>$request->post('contact_no'),
                'profile_photo'=>$profile_photo,

                ]);
            }
        } 
        
         return redirect('profile/edit')->with('message','Profile Updated!');
    }
}
