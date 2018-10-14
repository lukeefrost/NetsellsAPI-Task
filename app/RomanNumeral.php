<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RomanNumeral extends Model
{
    public function recordedRomanNumeral() {
      // Has a One to One Relationship with the Conversion Model
      return $this->hasOne(Conversion::class);
    }
}
