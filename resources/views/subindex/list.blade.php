@extends('layouts.app')

@section('title', '二级指标列表')

@section('content')
<div class="card md-3">
	<div class="card-header">二级指标列表</div>

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
						<th>所属一级指标</th>
						<th>编辑</th>
						<th>删除</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($subindices as $subindex)
						<tr>
							<td>{{ $subindex->id }}</td>
							<td>{{ $subindex->seq }}</td>
							<td>{{ $subindex->name }}</td>
							<td>{{ $subindex->score }}</td>
							<td>{{ $subindex->order }}</td>
							<td>{{ $subindex->description }}</td>
							<td>{{ $subindex->index->name }}</td>
							<td>
								<p data-placement="top" data-toggle="tooltip" title="编辑">
									<a href="{{ route('subindex.edit', $subindex->id) }}" class="btn btn-primary btn-xs" role="button">
										<span class="fa fa-pencil"></span>
									</a>
								</p>
							</td>
							<td>
								<p data-placement="top" data-toggle="tooltip" title="删除">
									<a href="#" class="btn btn-danger btn-xs" role="button" onclick="confirm('你确定要删除这条记录？') ? document.getElementById('delete-{{ $subindex->id }}-form').submit() : false">
										<span class="fa fa-trash"></span>
									</a>
									<form id="delete-{{ $subindex->id }}-form" method="post" action="{{ route('subindex.delete', $subindex->id) }}" style="display: none">
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
							<a href="{{ route('subindex.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> 新增</a>
						</td>
					</tr>
				</tfoot>
            </table>
        </div>
	</div>
</div>
@stop
