<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\User;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Mail;
class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
   
    public function login(Request $request)
    {
        // dd($request->all());
        // $request->validate([
        //      'email'=>'requaired',
        //      'password'=>'requaired',
        // ]);
        //login
        if(Auth::attempt($request->only('email','password')))
        {
            return redirect('home');
        }
        return redirect('login')->withError('Login detailes are not valid');
    }

    public function home(){
        return view('home');
    }

    public function logout(){
        \Session::flush();
        \Auth::logout();
        return redirect('');

    }

    public function register_view()
    {
        $country = DB::table('countries')->get();
        return view('auth.register',['country'=>$country]);
    }
    public function register(Request $request)
    {
    //     $request->validate([
    //         'name'=>'requaired',
    //         'email'=>'requaired|unique:users|email',
       
    //         'password'=>'requaired',
    //    ]);
              
       User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'contact'=>$request->contact,
        'address'=>$request->address,
        'password'=>\Hash::make($request->password),
        'country'=>$request->country,
        'state'=>$request->state,
        'city'=>$request->city,
       ]);
      
       $details = array('name'=>$request->name,'email'=>$request->email);
        $mail =  Mail::send('mails.mailtest', $details, function ($message) use ($details) {
                    $message->to($details['email'], $details['name'])
                        ->subject('Uert registered.')
                        ->from('kapilpagar17@gmail.com', 'MyNotePaper');
                    });

    //    if(Auth::attempt($request->only('email','password')))
    //     {
    //         return redirect('home');
    //     }
    //     return redirect('register')->withError('Error');
      
       return redirect('register')->with('registered','User registered....!');
        


    }
    public function getState(Request $request){
        // echo "hii";
        $cid=$request->post('cid');
        $state = DB::table('states')->where('country_id',$cid)->get();
        // print_r($state);
        $html = '<option value="">Select State</option>';
        foreach($state as $list)
        {
               $html.='<option value=""'.$list->id.'">'.$list->state.'</option>';
        }
        echo $html;

    }

    public function getCity(Request $request){
        // echo "hii";
        echo $sid=$request->post('sid');
        $city = DB::table('cities')->where('state_id',$sid)->get();
        // dd($city);
        $html = '<option value="">Select City</option>';
        foreach($city as $list)
        {
               $html.='<option value=""'.$list->id.'">'.$list->city.'</option>';
        }
        echo $html;

    }
   
    
}
