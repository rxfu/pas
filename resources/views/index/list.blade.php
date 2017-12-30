@extends('layouts.app')

@section('title', '一级指标列表')

@section('content')
<div class="card md-3">
	<div class="card-header">一级指标列表</div>

	<div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>ID</th>
						<th>序号</th>
						<th>名称</th>
						<th>分值</th>
						<th>排序</th>
						<th>说明</th>
						<th>编辑</th>
						<th>删除</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($indices as $index)
						<tr>
							<td>{{ $index->id }}</td>
							<td>{{ $index->seq }}</td>
							<td>{{ $index->name }}</td>
							<td>{{ $index->score }}</td>
							<td>{{ $index->order }}</td>
							<td>{{ $index->description }}</td>
							<td>
								<p data-placement="top" data-toggle="tooltip" title="编辑">
									<a href="{{ route('index.edit', $index->id) }}" class="btn btn-primary btn-xs" role="button">
										<span class="fa fa-pencil"></span>
									</a>
								</p>
							</td>
							<td>
								<p data-placement="top" data-toggle="tooltip" title="删除">
									<a href="#" class="btn btn-danger btn-xs" role="button" onclick="confirm('你确定要删除这条记录？') ? document.getElementById('delete-{{ $index->id }}-form').submit() : false">
										<span class="fa fa-trash"></span>
									</a>
									<form id="delete-{{ $index->id }}-form" method="post" action="{{ route('index.delete', $index->id) }}" style="display: none">
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
						<td colspan="8">
							<a href="{{ route('index.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> 新增</a>
						</td>
					</tr>
				</tfoot>
            </table>
        </div>
	</div>
</div>
@stop
