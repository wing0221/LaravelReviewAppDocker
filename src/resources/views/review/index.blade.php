@extends('review/_layout')
@section('content')
<div class="container ops-main">
<div class="row">
  <div class="col-md-12">
    <h3 class="ops-title">レビュー一覧</h3>
  </div>
</div>
<div class="row">
  <div class="col-md-11 col-md-offset-1">
    <table class="table text-center">
      <tr>
        <th class="text-center">ID</th>
        <th class="text-center">ユーザー</th>
        <th class="text-center">レビュー品</th>
        <th class="text-center">評価</th>        
        <th class="text-center">タイトル</th>
        <th class="text-center">詳細</th>
        <th class="text-center">削除</th>
      </tr>
      <div>{{ $reviews }}</div>
      @foreach($reviews as $review)
      <tr>
        <td>
          <a href="/review/{{ $review->id }}/edit">{{ $review->id }}</a>
        </td>
        <td>{{ $review->user_name }}</td>
        <td>{{ $review->item_name }}</td>
        <td>{{ $review->evaluation }}</td>
        <td>{{ $review->title }}</td>
        <td>{{ $review->content }}</td>
        <td>
        {{-- TODO 管理者のみ削除可能にする --}}
          <form action="/review/{{ $review->id }}" method="post">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <button type="submit" class="btn btn-xs btn-danger" aria-label="Left Align"><span class="glyphicon glyphicon-trash"></span></button>
          </form>
        </td>
      </tr>
      @endforeach
    </table>
    <div><a href="/review/create" class="btn btn-default">新規作成</a></div>
  </div>
</div>
@endsection