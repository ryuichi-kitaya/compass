@extends('layouts.sidebar')

@section('content')
<div class="search_content d-flex">
  <div class="reserve_users_area">
    @foreach($users as $user)
    <div class="border one_person">
      <div>
        <span>ID : </span><span class="search_view">{{ $user->id }}</span>
      </div>
      <div class="search-username"><span>名前 : </span>
        <a href="{{ route('user.profile', ['id' => $user->id]) }}">
          <span class="search_view">{{ $user->over_name }}</span>
          <span class="search_view">{{ $user->under_name }}</span>
        </a>
      </div>
      <div>
        <span>カナ : </span>
        <span class="search_view">({{ $user->over_name_kana }}</span>
        <span class="search_view">{{ $user->under_name_kana }})</span>
      </div>
      <div>
        @if($user->sex == 1)
        <span>性別 : </span><span class="search_view">男</span>
        @elseif($user->sex == 2)
        <span>性別 : </span><span class="search_view">女</span>
        @else
        <span>性別 : </span><span class="search_view">その他</span>
        @endif
      </div>
      <div>
        <span>生年月日 : </span><span class="search_view">{{ $user->birth_day }}</span>
      </div>
      <div>
        @if($user->role == 1)
        <span>権限 : </span><span class="search_view">教師(国語)</span>
        @elseif($user->role == 2)
        <span>権限 : </span><span class="search_view">教師(数学)</span>
        @elseif($user->role == 3)
        <span>権限 : </span><span class="search_view">教師(英語)</span>
        @else
        <span>権限 : </span><span class="search_view">生徒</span>
        @endif
      </div>
      @if($user->role == 4)
      <div>
        <span>選択科目 :</span>
        @foreach($user->subjects as $subject)
        <span class="search_view">{{ $subject->subject }}</span>
        @endforeach
      </div>
      @endif
    </div>
    @endforeach
  </div>
  <div class="search_area w-25">
    <div class="">
      <label>検索</label>
      <div>
        <input type="text" class="free_word" name="keyword" placeholder="キーワードを検索" form="userSearchRequest">
      </div>
      <label>カテゴリ</label>
      <div>
        <select form="userSearchRequest" name="category" class="search_name">
          <option value="name">名前</option>
          <option value="id">社員ID</option>
        </select>
      </div>
      <label>並び替え</label>
      <div>
        <select name="updown" form="userSearchRequest" class="search_updown">
          <option value="ASC">昇順</option>
          <option value="DESC">降順</option>
        </select>
      </div>
      <div class="">
        <p class="m-0 search_conditions"><label>検索条件の追加</label></p>
        <div class="search_conditions_inner">
          <label>性別</label>
          <div>
            <span>男</span><input type="radio" name="sex" value="1" form="userSearchRequest">
            <span>女</span><input type="radio" name="sex" value="2" form="userSearchRequest">
            <span>その他</span><input type="radio" name="sex" value="3" form="userSearchRequest">
          </div>
          <label>権限</label>
          <div>
            <select name="role" form="userSearchRequest" class="engineer">
              <option selected disabled>----</option>
              <option value="1">教師(国語)</option>
              <option value="2">教師(数学)</option>
              <option value="3">教師(英語)</option>
              <option value="4" class="">生徒</option>
            </select>
          </div>
          <label>選択科目</label>
          <div class="selected_engineer">
            @foreach($subjects as $subject)
            <span>{{ $subject->subject }}</span><input type="checkbox" name="subject[]" value="{{ $subject->id }}" form="userSearchRequest">
            @endforeach
          </div>
        </div>
      </div>
      <div class="search-btn-area">
        <input type="submit" name="search_btn" value="検索" form="userSearchRequest" class="search-btn">
      </div>
      <div class="reset-container">
        <input type="reset" value="リセット" form="userSearchRequest" class="reset-btn">
      </div>
    </div>
    <form action="{{ route('user.show') }}" method="get" id="userSearchRequest"></form>
  </div>
</div>
@endsection
