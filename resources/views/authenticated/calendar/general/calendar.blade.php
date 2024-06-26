@extends('layouts.sidebar')

@section('content')
<div class="vh-100 pt-5" style="background:#ECF1F6;">
  <div class="calendar-box" style="background:#FFF;">
    <div class="calendar-week" style="border-radius:5px;">

      <p class="text-center">{{ $calendar->getTitle() }}</p>
      <div class="calender-day">
        {!! $calendar->render() !!}
      </div>
    </div>
    <div class="text-right w-75 m-auto">
      <input type="submit" class="btn btn-primary" value="予約する" form="reserveParts">
    </div>
  </div>
</div>
<div class="modal js-modal">
  <div class="modal__bg js-modal-close"></div>
  <div class="modal__content">
    <div class="calendar-delete-view">
      <p>予約日：<span class="date"></span></p>
      <p>時間：<span class="part"></span></p>
      <p>上記の予約をキャンセルしてもよろしいですか？</p>
    </div>
    <P><a class="js-modal-close" href="">閉じる</a></P>
    <form action="/delete/calendar" method="post">
      <input type="submit" name="id" class="modal_id" value="キャンセル" >
      <input type="hidden" name="getData" class="delete_date"  value="">
      <input type="hidden" name="getPart" class="delete_part"  value="">
       {{ csrf_field() }}
    </form>
  </div>
</div>
@endsection