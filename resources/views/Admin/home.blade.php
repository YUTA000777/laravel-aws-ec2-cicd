@extends('layouts.admin.app')

@section('content')
<div class="container">
	<div class="card">
		<div class="card-header">管理側TOP</div>
		<div class="card-body">
			<a href="{{ url('admin/user_list') }}" class="btn btn-primary">ユーザー一覧削除画面</a>
			<form method="post" action="{{ route('admin.logout') }}">
				@csrf
				<input type="submit" class="btn btn-danger mb-5" value="ログアウト" />
			</form>
			<strong>※管理者簡単ログインをされている方は画面リロードは行わないでください。<br>&emsp;ユーザー画面に戻る場合はログアウトボタンをクリックして戻るよう御願い致します。</strong>
		</div>
	</div>
</div>
@endsection