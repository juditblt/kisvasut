<?php

namespace App\Http\Controllers;

use App\Models\Station;
use Illuminate\Http\Request;

class ForestTrainController extends Controller
{
    public  function index(){
        return view('index', [
            'stations' => Station::all()
        ]);
    }

    public function onstation($id){
        Station::where('train_in', 1)->update([
            'train_in' => 0
        ]);
        $station = Station::find($id);
        $station->train_in = 1;
        $station->save();
        return $station;
    }

    public function stations(){
        //return Station::all();
        //return Station::get(['id', 'train_in']);
        //return Station::where('train_in', 1)->get(['id']);
        return Station::where('train_in', 1)->first()->id;
    }
}
