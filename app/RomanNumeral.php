<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RomanNumeral extends Model
{
    public function recordedRomanNumeral(){
      return $this->hasOne(Conversion::class);
    }
}
