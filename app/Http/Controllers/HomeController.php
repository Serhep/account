<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $warename = '';
        $code = '';
        $null_pos = true;
        $ware = DB::table('stock')->orderByRaw('RAND()')->take(10)->get();
        return view('home', ['ware' => $ware, 'warename' => $warename, 'code' => $code, 'null_pos' => $null_pos]);
    }
    public function filter(Request $request)
    {
        $ware = array();
        $warename = $request->warename;
        $code = $request->code;
        $null_pos = true;

        switch($request->submitbutton){
            case 'Применить':
                if ($code) 
                    $ware = DB::table('stock')->where('code', $code)->get();
                else 
                    if($request->has('null_pos')) {
                        $ware = DB::table('stock')
                            ->where('name', 'like', '%'.$warename.'%')
                            ->where(function ($query) {
                                $query->where('quant_m', '>', 0)
                                    ->orWhere('quant_s', '>', 0);
                            })
                            ->orderBy('name')
                            ->get();
                        $null_pos = true;
                    }
                    else {
                        $ware = DB::table('stock')
                            ->where('name', 'like', '%'.$warename.'%')
                            ->orderBy('name')
                            ->get();
                        $null_pos = false;
                    }
                break;
                case 'Не выдано':
                    $ware = DB::table('stock')
                            ->where('name', 'like', '%'.$warename.'%')
                            ->where('quant_m', '=', 0)
                            ->where('quant_s', '>', 0)
                            ->orderBy('name')
                            ->get();
                break;
        }      
        return view('home', ['ware' => $ware, 'warename' => $warename, 'code' => $code, 'null_pos' => $null_pos]);
    }

}
