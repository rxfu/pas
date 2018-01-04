@extends('layouts.app')

@section('title', '评分统计')

@section('content')
<div class="card md-3">
	<div class="card-header">评分统计</div>

	<div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>单位名称</th>
						<th>总分</th>
						<th>排名</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($totals as $total)
						<tr>
							<td>{{ $total['name'] }}</td>
							<td>{{ $total['total'] }}</td>
							<td>{{ $loop->iteration }}</td>
						</tr>
					@endforeach
				</tbody>
            </table>
        </div>
	</div>
</div>
@stop
