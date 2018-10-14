<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Conversion;

class NumeralsConverterController extends Controller
{

  /**
  * Calculate and save the conversion to the Database
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Request $request) {
      $SearchVal = $request->get('integerVariable'); // Get search term from the search box
      $search = $SearchVal / 1000;
      $thousand = intval($search);
      $search2 = ($SearchVal - ($thousand * 1000)) / 100;
      $hundred = intval($search2);
      $search3 = ($SearchVal - (($thousand * 1000) + ($hundred * 100))) /10;
      $tens = intval($search3);
      $search4 = ($SearchVal - ((($thousand * 1000) + ($hundred * 100) + ($tens * 10))));
      $ones = intval($search4);

      // Establish arrays that the Roman Numerals represent in terms of Thousands, Hundreds, Tens and Ones.
      $RomTH = array("","M","MM","MMM");
      $RomH  = array("","C","CC","CCC","CD","D","DC","DCC","DCCC","CM");
      $RomT  = array("","X","XX","XXX","XL","L","LX","LXX","LXXX","XC");
      $RomO  = array("","I","II","III","IV","V","VI","VII","VIII","IX");

      // If the search in thousands is less than 4000, convert to Roman Numerals.
      if ($thousand < 4) {
        $RomanNum = $RomTH[$thousand]."".$RomH[$hundred]."".$RomT[$tens]."".$RomO[$ones];
        $oldRecord = Conversion::where('romanNumeral', '=', $RomanNum)->first();

      // If the number is an old record, update relevant database details which are
      // the number of times it was converted which will increase by 1, and it's last
      // conversion which will be updated to this time. It will then save it to the database.
      if (!empty($oldRecord)) {
        $id = $oldRecord->id;
        $conversion = Conversion::find($id);
        $count = ($conversion->NumberOfTimesConverted) + 1;
        $conversion->NumberOfTimesConverted = $count;
        $conversion->lastConversion = Carbon::now();
        $conversion->save();
      }

      // If the record is new, save it's details to the Database.
      else {
        $conversion = new Conversion;
        $conversion->romanNumeral = (string)$RomanNum;
        $conversion->NumberOfTimesConverted = 1;
        $conversion->lastConversion = Carbon::now();
        $conversion->save();
      }
    }

    // If an error appears in the search, show the error message below.
    else {
      $RomanNum = "Enter a numeral for conversion below 4000";
     }

     // return the view that shows the converted Integers.
     return view('convertedIntegers', compact('SearchVal', 'RomanNum'));
   }

  /**
  * Show the previous conversions in the Database
  *
  * @return \Illuminate\Http\Response
  */
  public function lastConversions(Request $request) {
     // Access Conversion Model and get an order of last conversions in a descending order.
     $conversion = Conversion::orderBy('lastConversion', 'desc')->take(10)->get();
     return view('conversions', compact('conversion'));
  }

  /**
  * Show the Top ten converted integers in the Database
  *
  * @return \Illuminate\Http\Response
  */
  public function topTen(Request $request) {
     // Access Conversion Model and get a list of the number of times a certain integer has been
     // converted and display them in a descending order.
     $conversion = Conversion::orderBy('NumberOfTimesConverted', 'desc')->take(10)->get();
     return view('top10integers', compact('conversion'));
  }
}
