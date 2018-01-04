@extends('layouts.default')

@section('title', $department . '绩效考核评分指标')

@section('content')
<div class="container">
    <div class="card mx-auto md-3">
        <div class="card-header">{{ $department }}绩效考核评分指标</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-nowrap">一级指标</th>
                            <th class="text-nowrap">二级指标</th>
                            <th class="text-nowrap">观测点</th>
                            <th class="text-nowrap">评分</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $key => $item)
                            @if (isset($item['subindices']))
                                @foreach ($item['subindices'] as $subkey => $subindex)
                                    <tr>
                                        @if ($loop->first)
                                            <td rowspan="{{ count($item['subindices']) }}" class="align-middle">{{ $item['seq'] }}、{{ $item['name'] }}（{{ $item['score'] }}分）</td>
                                        @endif
                                        <td>{{ $subindex['seq'] }}、{{ $subindex['name'] }}（{{ $subindex['score'] }}分）</td>
                                        <td>{!! nl2br($subindex['description']) !!}</td>
                                        <td><a href="{{ route('score.mark', [$key, $subkey]) }}">评分</a></td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="2" class="align-middle">{{ $item['seq'] }}、{{ $item['name'] }}（{{ $item['score'] }}分）</td>
                                    <td>{!! nl2br($item['description']) !!}</td>
                                    <td><a href="{{ route('score.mark', [$key, 0]) }}">评分</a></td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
