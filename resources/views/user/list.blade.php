@extends('layouts.app')

@section('title', '用户列表')

@section('content')
<div class="card md-3">
	<div class="card-header">用户列表</div>

	<div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>ID</th>
						<th>所在单位</th>
						<th>是否主责</th>
						<th>最后登录时间</th>
						<th>创建时间</th>
						<th>删除</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($markers as $marker)
						<tr>
							<td>{{ $marker->id }}</td>
							<td>{{ $marker->department->name }}</td>
							<td>{{ $marker->is_manager ? '是' : '否' }}</td>
							<td>{{ $marker->last_login_at }}</td>
							<td>{{ $marker->created_at }}</td>
							<td>
								<p data-placement="top" data-toggle="tooltip" title="删除">
									<a href="#" class="btn btn-danger btn-xs" role="button" onclick="confirm('你确定要删除这条记录？') ? document.getElementById('delete-{{ $marker->id }}-form').submit() : false">
										<span class="fa fa-trash"></span>
									</a>
									<form id="delete-{{ $marker->id }}-form" method="post" action="{{ route('user.delete', $marker->id) }}" style="display: none">
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
						<td colspan="5">
							<a href="{{ route('user.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> 新增</a>
							<a href="#" class="btn btn-danger" role="button" onclick="confirm('你确定要删除这条记录？') ? document.getElementById('destroy-form').submit() : false"><i class="fa fa-minus"></i> 清空</a>
							<form id="destroy-form" method="post" action="{{ route('user.destroy') }}" style="display: none">
								{{ method_field('delete') }}
								{{ csrf_field() }}
							</form>
						</td>
					</tr>
				</tfoot>
            </table>
        </div>
	</div>
</div>
@stop
