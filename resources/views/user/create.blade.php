@extends('layouts.app')

@section('title', '新增用户')

@section('content')
<form method="post" action="{{ route('user.save') }}">
	{{ csrf_field() }}

	<div class="form-group row">
		<label for="count" class="control-label col-md-3 col-sm-3 col-xs-12 col-form-label text-right">每部门用户数 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="count" name="count" placeholder="用户数" value="{{ old('count') }}" required>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-6 col-sm-6 col-xs-12 offset-md-3">
			<button type="submit" class="btn btn-success">保存</button>
		</div>
	</div>
</form>
@stop