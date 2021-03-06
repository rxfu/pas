@extends('layouts.app')

@section('title', '编辑一级指标')

@section('content')
<form method="post" action="{{ route('index.update', $index->id) }}">
	{{ method_field('put') }}
	{{ csrf_field() }}

	<div class="form-group row">
		<label for="name" class="col-md-3 col-sm-3 col-xs-12 col-form-label text-right">一级指标名称 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="name" name="name" placeholder="一级指标名称" value="{{ $index->name }}" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="seq" class="col-md-3 col-sm-3 col-xs-12 col-form-label text-right">序号 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="seq" name="seq" placeholder="序号" value="{{ $index->seq }}" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="score" class="col-md-3 col-sm-3 col-xs-12 col-form-label text-right">分值 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="score" name="score" placeholder="分值" value="{{ $index->score }}" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="order" class="col-md-3 col-sm-3 col-xs-12 col-form-label text-right">排序 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="order" name="order" placeholder="排序" value="{{ $index->order }}" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="description" class="col-md-3 col-sm-3 col-xs-12 col-form-label text-right">观测点</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<textarea class="form-control col-md-7 col-xs-12" rows="5" id="description" name="description" placeholder="观测点">{{ $index->description }}</textarea>
		</div>
	</div>
	<div class="form-group row">
		<label for="is_manager" class="col-md-3 col-sm-3 col-xs-12 col-form-label text-right">是否主责评分</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="form-check form-check-inline">
				<input type="radio" class="form-check-input" id="is_manager_yes" name="is_manager" value="1"{{ $index->is_manager ? ' checked' : '' }}>
				<label for="is_manager_yes" class="form-check-label">是</label>
			</div>
			<div class="form-check form-check-inline">
				<input type="radio" class="form-check-input" id="is_manager_no" name="is_manager" value="0"{{ $index->is_manager ? '' : ' checked' }}>
				<label for="is_manager_no" class="form-check-label">否</label>
			</div>
		</div>
	</div>
	<div class="form-group row">
		<label for="departments[]" class="col-md-3 col-sm-3 col-xs-12 col-form-label text-right">主责部门</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			@foreach ($departments as $department)
				<div class="form-check form-check-inline">
					<input type="checkbox" class="form-check-input" id="department-{{ $department->id }}" name="departments[]" value="{{ $department->id }}"{{ in_array($department->id, $managers) ? ' checked' : '' }}>
					<label for="department-{{ $department->id }}" class="form-check-label">{{ $department->name }}</label>
				</div>
			@endforeach
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-6 col-sm-6 col-xs-12 offset-md-3">
			<button type="submit" class="btn btn-success">保存</button>
		</div>
	</div>
</form>
@stop