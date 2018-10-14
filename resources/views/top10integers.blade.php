@extends('layout')

@section('content')


            <div class="content">
                @foreach($conversion as $numberedConversion)
                <h3>Numeral : {{$numberedConversion->romanNumeral}}.  </h3>
                <p><mark>Times Converted: {{$numberedConversion->NumberOfTimesConverted}}</mark></p>
               @endforeach
        </div>
@endsection
