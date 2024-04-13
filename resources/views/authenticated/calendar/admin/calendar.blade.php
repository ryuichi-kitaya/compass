@extends('layouts.sidebar')

@section('content')
<div class="w-75 m-auto" style="background-color: #fff;">
  <div class="" style="margin: 0 auto; width: 85%;">
    <p style="text-align: center;">{{ $calendar->getTitle() }}</p>
    <p>{!! $calendar->render() !!}</p>
  </div>
</div>
@endsection