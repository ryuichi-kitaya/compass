@extends('layouts.sidebar')
@section('content')
<div class="w-100" style="align-items:center; justify-content:center;">
  <div class="border p-5" style="width:100%; margin:0 auto;">
    <p class="text-center" style="background-color:#fff; width:85%; margin:0 auto; padding-top:10px;">{{ $calendar->getTitle() }}</p>
    {!! $calendar->render() !!}
    <div class="adjust-table-btn m-auto text-right">
      <input type="submit" class="wakutoroku-btn" value="登録" form="reserveSetting" onclick="return confirm('登録してよろしいですか？')">
    </div>
  </div>
</div>
@endsection