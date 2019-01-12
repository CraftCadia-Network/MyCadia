<?php

namespace App\Http\Controllers;
use App\Money;
use App\Profiles;
use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
class UserController extends Controller
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
    public function getProfile($user) {
		
        $users = Profiles::all();
        
        $date = array();
		foreach ($users as $u ){
			$date[] = $u->name;
        }
        if (in_array($user, $date)) {
				$rank = Profiles::select('rank')->where('name', $user)->first();
				$servers = DB::table('servers')->get();
				$r =  str_replace('"', " ", $rank);
				$ra =  str_replace(':', " ", $r);
				$ran =  str_replace('{', " ", $ra);
				$rankk =  str_replace('rank', "", $ran);
				$rankkk =  str_replace('}', "", $rankk);

				return view("profile.profile")->with('user', $user)->with('rank',$rankkk)->with('servers', $servers);
			}else{
				return view("profile.notfound");
			}
      
       
		
        
        
    }
    public function getDataFrom($user,$server)
    {
        $rank = Profiles::select('rank')->where('name', $user)->first();
        $servers = DB::table('servers')->get();
        $r =  str_replace('"', " ", $rank);
        $ra =  str_replace(':', " ", $r);
        $ran =  str_replace('{', " ", $ra);
        $rankk =  str_replace('rank', "", $ran);
        $rankkk =  str_replace('}', "", $rankk);
        $money = Money::select('amount')->where('playername', $user)->first();
        $m =  str_replace('"', " ", $money);
        $mo =  str_replace(':', " ", $m);
        $mon =  str_replace('{', " ", $mo);
        $mone =  str_replace('amount', "", $mon);
        $moneyy =  str_replace('}', "", $mone);
        return view("profile.server")->with('user', $user)->with('rank',$rankkk)->with('money',$moneyy)->with('servers', $servers);
    }
   
}
