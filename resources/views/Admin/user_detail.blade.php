@extends('layouts.admin.app')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">
			<a href="{{ url('admin/user_list') }}">ユーザー一覧</a> &gt; ユーザー詳細
		</div>
		<div class="card-body">

			<ul class="list-group">
      <!-- パスワード以外の値を出力 -->
				<li class="list-group-item">名前: {{ $user->name }}</li>
				<li class="list-group-item">メール: {{ $user->email }}</li>
			</ul>
      <form method="POST" action="{{route('admin.delete',$user->id)}}">
      @csrf
      <button class="btn btn-danger mt-3" type="submit">削除する</button>
      </form>
		</div>
	</div>
</div>
@endsection