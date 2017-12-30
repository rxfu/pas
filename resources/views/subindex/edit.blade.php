@extends('layouts.app')

@section('title', '编辑二级指标')

@section('content')
<form method="post" action="{{ route('subindex.update', $subindex->id) }}">
	{{ method_field('put') }}
	{{ csrf_field() }}

	<div class="form-group row">
		<label for="name" class="col-md-3 col-sm-3 col-xs-12 col-form-label text-right">二级指标名称 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="name" name="name" placeholder="二级指标名称" value="{{ $subindex->name }}" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="seq" class="col-md-3 col-sm-3 col-xs-12 col-form-label text-right">序号 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="seq" name="seq" placeholder="序号" value="{{ $subindex->seq }}" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="score" class="col-md-3 col-sm-3 col-xs-12 col-form-label text-right">分值 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="score" name="score" placeholder="分值" value="{{ $subindex->score }}" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="order" class="col-md-3 col-sm-3 col-xs-12 col-form-label text-right">排序 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="order" name="order" placeholder="排序" value="{{ $subindex->order }}" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="description" class="col-md-3 col-sm-3 col-xs-12 col-form-label text-right">说明</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<textarea class="form-control col-md-7 col-xs-12" rows="5" id="description" name="description" placeholder="说明">{{ $subindex->description }}</textarea>
		</div>
	</div>
	<div class="form-group row">
		<label for="index_id" class="col-md-3 col-sm-3 col-xs-12 col-form-label text-right">所属一级指标</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<select id="index_id" name="index_id" class="form-control col-md-7 col-xs-12">
				@foreach ($indices as $index)
					<option value="{{ $index->id }}"{{ $index->id === $subindex->index_id ? ' selected' : ''}}>{{ $index->name }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="form-group row">
		<div class="col-md-6 col-sm-6 col-xs-12 offset-md-3">
			<button type="submit" class="btn btn-success">保存</button>
		</div>
	</div>
</form>
@stop