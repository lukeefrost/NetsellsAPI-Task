@extends('layout')

@section('content')
<div class="content">

   <div class="searchBox">
      <h1>
        Type in an Integer for Conversion
      </h1>
   </div>

      <p>
         Numeral Converted: {{$SearchVal}}. The Roman Numeral Conversion of it : {{$RomanNum}}
      </p>
</div>
@endsection
