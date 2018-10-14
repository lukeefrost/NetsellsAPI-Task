@extends('layout')

@section('content')


            <div class="content">
                @foreach ($conversion as $lastConversion)
                  <h3>Numeral : {{$lastConversion->romanNumeral}}.  </h3>
                  <p><mark>Last Converted: {{$lastConversion->lastConversion}}</mark></p>
                 @endforeach
        </div>
@endsection
