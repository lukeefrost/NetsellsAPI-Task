<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversion extends Model
{
    protected $fillable = ['romanNumeral', 'NumberOfTimesConverted', 'lastConversion'];
    protected $table = 'converted_integers';
    public $timestamps = false;

    public function Numeral() {
      return $this->belongsTo(RomanNum::class);
    }

}
