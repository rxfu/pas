@extends('layouts.default')

@section('title', '绩效考核评分系统')

@section('content')
<div class="container">
    <div class="card mx-auto md-3">
        <div class="card-header">绩效考核评分</div>
        <div class="card-body">
            <form method="post" action="{{ route('score.create') }}">
                {{ csrf_field() }}

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>学院</th>
                                <th>自评材料</th>
                                <th>一级指标</th>
                                <th>二级指标</th>
                                <th>观测点</th>
                                <th>得分</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($departments as $department)
                                @foreach ($indices as $index)
                                    @if ($count = $index->subindices->count())
                                        @foreach ($index->subindices as $subindex)
                                            <tr>
                                                @if ($loop->first)
                                                    <th rowspan="{{ $rows }}" class="align-middle">{{ $department->name }}</th>
                                                    <td rowspan="{{ $rows }}" class="align-middle">
                                                        @if (!empty($department->path))
                                                            <a href="{{ asset('storage/' . $department->path) }}" title="下载">下载</a>
                                                        @endif
                                                    </td>
                                                    <td rowspan="{{ $count }}" class="align-middle">{{ $index->seq }}、{{ $index->name }}（{{ $index->score }}分）</td>
                                                @endif
                                                <td>{{ $subindex->seq }}、{{ $subindex->name }}（{{ $subindex->score }}分）</td>
                                                <td>{{ $subindex->description }}</td>
                                                <td>
                                                    <input type="number" name="score_{{ $department->id }}_{{ $index->id }}_{{ $subindex->id }}" class="form-control" value="{{ empty($scores) ? 0 : $scores[$department->id][session('marker')][$index->id][$subindex->id] }}" min="0" max="{{ $subindex->score }}">
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            @if ($loop->first)
                                                <th rowspan="{{ $rows }}" class="align-middle">{{ $department->name }}</th>
                                                <td rowspan="{{ $rows }}" class="align-middle">
                                                    @if (!empty($department->path))
                                                        <a href="{{ asset('storage/' . $department->path) }}" title="下载">下载</a>
                                                    @endif
                                                </td>
                                            @endif
                                            <td colspan="2" class="align-middle">{{ $index->seq }}、{{ $index->name }}（{{ $index->score }}分）</td>
                                            <td>{{ $index->description }}</td>
                                            <td>
                                                <input type="number" name="score_{{ $department->id }}_{{ $index->id }}_0" class="form-control" value="{{ empty($scores) ? 0 : $scores[$department->id][session('marker')][$index->id][0] }}" min="0" max="{{ $index->score }}">
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-center">
                                    <button type="submit" class="btn btn-primary">提交</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
