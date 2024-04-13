@extends('layouts.sidebar')

@section('content')
<div class="vh-100 d-flex" style="align-items:center; justify-content:center;">
  <div class="w-50 m-auto h-75">
    <p><span>{{ $datetime }}</span><span class="ml-3">{{ $reservePersons->first()->setting_part }}部</span></p>
    <div class="h-75">
      <div class="reserve_detail">
        <div class="reserve_title">
          <p class="reserve_part">ID</p>
          <p class="reserve_part">名前</p>
          <p class="reserve_part">場所</p>
        </div>
        <div class="reserve_detail">
        @foreach($reservePersons as $reservePerson)
          @foreach($reservePerson->users as $user)
          <div class="reserve_parson">
          <p class="reserve_user">{{ $user->id }}</p>
          <p class="reserve_user">{{ $user->over_name }}<span>{{ $user->under_name }}</span></p>
          <p class="reserve_user">リモート</p>
          </div>
          @endforeach
        @endforeach
        </div>
      </div>
    </div>
  </div>
</div>
@endsection