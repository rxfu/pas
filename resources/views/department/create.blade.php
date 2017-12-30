@extends('layouts.app')

@section('title', '新增部门')

@section('content')
<form method="post" action="{{ route('department.save') }}" enctype="multipart/form-data">
	{{ csrf_field() }}

	<div class="form-group row">
		<label for="name" class="col-md-3 col-sm-3 col-xs-12 col-form-label text-right">部门名称 <span class="required">*</span></label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="text" class="form-control col-md-7 col-xs-12" id="name" name="name" placeholder="部门名称" value="{{ old('name') }}" required>
		</div>
	</div>
	<div class="form-group row">
		<label for="path" class="col-md-3 col-sm-3 col-xs-12 col-form-label text-right">自评材料</label>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<input type="file" class="form-control col-md-7 col-xs-12" id="file" name="file" placeholder="自评材料">
		</div>
	</div>
	<fieldset class="form-group">
		<div class="row">
			<legend for="is_college" class="col-md-3 col-sm-3 col-xs-12 pt-0 col-form-label text-right">是否学院 <span class="required">*</span></legend>
			<div class="col-md-6 col-sm-6 col-xs-12">
				<div class="form-check form-check-inline">
					<input type="radio" class="form-check-input" id="yes" name="is_college" value="1">
					<label for="yes" class="form-check-label">是</label>
				</div>
				<div class="form-check form-check-inline">
					<input type="radio" class="form-check-input" id="no" name="is_college" value="0" checked>
					<label for="no" class="form-check-label">否</label>
				</div>
			</div>
		</div>
	</fieldset>
	<div class="form-group row">
		<div class="col-md-6 col-sm-6 col-xs-12 offset-md-3">
			<button type="submit" class="btn btn-success">保存</button>
		</div>
	</div>
</form>
@stop