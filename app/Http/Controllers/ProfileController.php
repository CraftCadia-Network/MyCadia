<?php

namespace App\Http\Controllers;

use App\Money;
use App\Profiles;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use DB;
class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    public function getProfileUser()
    {
        $name = Input::get('p');
        $users = DB::table('users')->get();
        $date = array();
		foreach ($users as $u ){
			$date[] = $u->name;
        }
        if (in_array($name, $date)) {
                $rank = Profiles::select('rank')->where('name', $name)->first();
                $servers = DB::table('servers')->get();
                $r =  str_replace('"', " ", $rank);
                $ra =  str_replace(':', " ", $r);
                $ran =  str_replace('{', " ", $ra);
                $rankk =  str_replace('rank', "", $ran);
                $rankkk =  str_replace('}', "", $rankk);
                return redirect('/'.$name);
                return view("profile.profile")->with('user', $name)->with('rank',$rankkk)->with('servers', $servers);

            }else{
				return view("profile.notfound");
			}
        
        
    }
}
