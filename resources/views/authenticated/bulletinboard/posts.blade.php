@extends('layouts.sidebar')

@section('content')
<div class="board_area w-100 border m-auto d-flex">
  <div class="post_view w-75 mt-5">
    @foreach($posts as $post)
    <div class="post_area border p-3 d-flex">
      <div class="post_top_area">
      <p class="post_username"><span>{{ $post->user->over_name }}</span><span class="ml-3">{{ $post->user->under_name }}</span>さん</p>
      <p><a href="{{ route('post.detail', ['id' => $post->id]) }}">{{ $post->post_title }}</a></p>
      @foreach($post->sub_category as $sub_category)
      <P class="category_icon">{{ $sub_category->sub_category }}</P>
      @endforeach
      </div>
      <div class="post_bottom_area d-flex">
        <div class="d-flex post_status">
          <div class="mr-5">
            <i class="fa fa-comment"></i><span class="">{{ $post_comment->commentCounts($post->id)->count() }}</span>
          </div>
          <div>
            @if(Auth::user()->is_Like($post->id))
            <p class="m-0"><i class="fas fa-heart un_like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{ $like->likeCounts($post->id) }}</span></p>
            @else
            <p class="m-0"><i class="fas fa-heart like_btn" post_id="{{ $post->id }}"></i><span class="like_counts{{ $post->id }}">{{ $like->likeCounts($post->id) }}</span></p>
            @endif
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <div class="other_area w-25">
    <div class="m-4">
      <div class="up_post"><a href="{{ route('post.input') }}">投稿</a></div>
      <div class="keyword_search">
        <input type="text" placeholder="キーワードを検索" name="keyword" class="post_free" form="postSearchRequest">
        <input type="submit" value="検索" class="post_free_btn" form="postSearchRequest">
      </div>
      <input type="submit" name="like_posts" class="good_btn" value="いいねした投稿" form="postSearchRequest">
      <input type="submit" name="my_posts" class="my_post_btn" value="自分の投稿" form="postSearchRequest">
      <div class="category_search_title"> <p>カテゴリー検索</ｐ></div>
      @foreach($categories as $category)
      <ul class="category_search">
        <li class="main_categories" category_id="{{ $category->id }}"><span>{{ $category->main_category }}<span></li>
        @foreach($category->subCategories as $sub_category)
        <li class="sub_category_views"><input type="submit" name="category_word" class="sub_category_btn" value="{{ $sub_category->sub_category }}" form="postSearchRequest"></li>
        @endforeach
      </ul>
      @endforeach
    </div>
  </div>
  <form action="{{ route('post.show') }}" method="get" id="postSearchRequest"></form>
</div>
@endsection