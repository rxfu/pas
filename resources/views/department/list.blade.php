@extends('layouts.app')

@section('title', '部门列表')

@section('content')
<div class="card md-3">
	<div class="card-header">部门列表</div>

	<div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>ID</th>
						<th>单位名称</th>
						<th>自评材料</th>
						<th>是否学院</th>
						<th>编辑</th>
						<th>删除</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($departments as $department)
						<tr>
							<td>{{ $department->id }}</td>
							<td>{{ $department->name }}</td>
							<td>
								<a href="{{ asset('storage/' . $department->path) }}" title="下载">{{ $department->path }}</a>
							</td>
							<td>{{ $department->is_college ? '是' : '否' }}</td>
							<td>
								<p data-placement="top" data-toggle="tooltip" title="编辑">
									<a href="{{ route('department.edit', $department->id) }}" class="btn btn-primary btn-xs" role="button">
										<span class="fa fa-pencil"></span>
									</a>
								</p>
							</td>
							<td>
								<p data-placement="top" data-toggle="tooltip" title="删除">
									<a href="#" class="btn btn-danger btn-xs" role="button" onclick="confirm('你确定要删除这条记录？') ? document.getElementById('delete-{{ $department->id }}-form').submit() : false">
										<span class="fa fa-trash"></span>
									</a>
									<form id="delete-{{ $department->id }}-form" method="post" action="{{ route('department.delete', $department->id) }}" style="display: none">
										{{ method_field('delete') }}
										{{ csrf_field() }}
									</form>
								</p>
							</td>
						</tr>
					@endforeach
				</tbody>

				<tfoot>
					<tr>
						<td colspan="6">
							<a href="{{ route('department.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> 新增</a>
						</td>
					</tr>
				</tfoot>
            </table>
        </div>
	</div>
</div>
@stop
