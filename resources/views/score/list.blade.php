@extends('layouts.app')

@section('title', '评分细目')

@section('content')
<div class="card md-3">
	<div class="card-header">评分细目</div>

	<div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th><em>ID</em></th>
						<th>单位名称</th>
						<th>一级指标</th>
						<th>二级指标</th>
						<th>得分</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($scores as $score)
						<tr>
							<td><em>{{ $score->marker_id }}</em></td>
							<td>{{ $score->department->name }}</td>
							<td>{{ $score->index->name }}（{{ $score->index->score }}）</td>
							<td>{{ isset($score->subindex) ? $score->subindex->name . '（' . $score->subindex->score . '）': '' }}</td>
							<td>{{ $score->score }}</td>
						</tr>
					@endforeach
				</tbody>
            </table>
        </div>
	</div>
</div>
@stop
