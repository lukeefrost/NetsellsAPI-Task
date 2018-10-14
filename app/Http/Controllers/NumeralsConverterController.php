<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Conversion;

class NumeralsConverterController extends Controller
{

    public function index(Request $request) {
      $SearchVal = $request->get('integerVariable');
      $search = $SearchVal / 1000;
      $thousand = intval($search);
      $search2 = ($SearchVal - ($thousand * 1000)) / 100;
      $hundred = intval($search2);
      $search3 = ($SearchVal - (($thousand * 1000) + ($hundred * 100))) /10;
      $tens = intval($search3);
      $search4 = ($SearchVal - ((($thousand * 1000) + ($hundred * 100) + ($tens * 10))));
      $ones = intval($search4);
      $RomTH = array("","M","MM","MMM");
      $RomH  = array("","C","CC","CCC","CD","D","DC","DCC","DCCC","CM");
      $RomT  = array("","X","XX","XXX","XL","L","LX","LXX","LXXX","XC");
      $RomO  = array("","I","II","III","IV","V","VI","VII","VIII","IX");

      if ($thousand < 4) {
        $RomanNum = $RomTH[$thousand]."".$RomH[$hundred]."".$RomT[$tens]."".$RomO[$ones];
        $oldRecord = Conversion::where('romanNumeral', '=', $RomanNum)->first();

      if(!empty($oldRecord)){
        $id = $oldRecord->id;
        $conversion = Conversion::find($id);
        $count = ($conversion->NumberOfTimesConverted) + 1;
        $conversion->NumberOfTimesConverted = $count;
        $conversion->lastConversion = Carbon::now();
        $conversion->save();
      }

      else{
        $conversion = new Conversion;
        $conversion->romanNumeral = (string)$RomanNum;
        $conversion->NumberOfTimesConverted = 1;
        $conversion->lastConversion = Carbon::now();
        $conversion->save();
      }
    }

    else{
      $RomanNum = "Enter a numeral for conversion below 4000";
    }

    return view('convertedIntegers', compact('SearchVal', 'RomanNum'));

    }

    public function lastConversions(Request $request){
      $conversion = Conversion::orderBy('lastConversion', 'desc')->take(10)->get();
      return view('conversions', compact('conversion'));
    }

    public function topTen(Request $request){
      $conversion = Conversion::orderBy('NumberOfTimesConverted', 'desc')->take(10)->get();
      return view('top10integers', compact('conversion'));
    }
}
