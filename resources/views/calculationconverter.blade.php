@extends('layout')

@section('content')

            <div class="content">
                <div class="title m-b-md">
                    Converting Integers to Roman Numerals
            </div>

            <div class="searchBox">
              <h1>
                Type in an Integer for Conversion
              </h1>
            </div>

            <div class="row">
            <form action="" method="POST">
                {{ csrf_field() }}
              <div class="col-xs-12 col-sm-12 col-md-12">
                  <div class="form-group">
                      <strong>Integer:</strong>
                      <textarea name="integerVariable" class="form-control"></textarea>
                  </div>

                  <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Convert</button>
                  </div>
                </div>
            </form>


              </div>
            </div>
@endsection
