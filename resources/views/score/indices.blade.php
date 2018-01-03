@extends('layouts.default')

@section('title', '绩效考核指标列表')

@section('content')
<div class="container">
    <div class="card mx-auto md-3">
        <div class="card-header">绩效考核指标列表</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>一级指标</th>
                            <th>二级指标</th>
                            <th>观测点</th>
                            <th>评分</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($indices as $index)
                            @if ($count = $index->subindices->count())
                                @foreach ($index->subindices as $subindex)
                                    @if (in_array(session('department'), explode(',', $subindex->departments)))
                                        <tr>
                                            @if ($loop->first)
                                                <td rowspan="{{ $count }}" class="align-middle">{{ $index->seq }}、{{ $index->name }}（{{ $index->score }}分）</td>
                                            @endif
                                            <td>{{ $subindex->seq }}、{{ $subindex->name }}（{{ $subindex->score }}分）</td>
                                            <td>{{ $subindex->description }}</td>
                                            <td><a href="#">评分</a></td>
                                        </tr>
                                    @endif
                                @endforeach
                            @else
                                @if (in_array(session('department'), explode(',', $index->departments)))
                                    <tr>
                                        <td colspan="2" class="align-middle">{{ $index->seq }}、{{ $index->name }}（{{ $index->score }}分）</td>
                                        <td>{{ $index->description }}</td>
                                        <td><a href="#">评分</a></td>
                                    </tr>
                                @endif
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
