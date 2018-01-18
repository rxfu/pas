@extends('layouts.app')

@section('title', $department . '绩效考核评分结果')

@section('content')
<div class="container">
    <div class="card mx-auto md-3">
        <div class="card-header text-center">
            {{ $department }}绩效考核评分结果
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="text-nowrap">一级指标</th>
                            <th class="text-nowrap">二级指标</th>
                            <th class="text-nowrap">观测点</th>
                            <th class="text-nowrap">评分</th>
                            <th class="text-nowrap">小计</th>
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
                                        <td class="align-middle">{{ $subindex['seq'] }}、<a href="{{ route('score.detail', [$id, $key, $subkey]) }}" title="评分细目">{{ $subindex['name'] }}</a>（{{ $subindex['score'] }}分）</td>
                                        <td>{!! nl2br($subindex['description']) !!}</td>
                                        @if ('工作效能' == $item['name'])
                                            @if ($loop->first)
                                                <td rowspan="{{ count($item['subindices']) }}" class="align-middle">{{ number_format($subindex['value'], 2) }}</td>
                                                <td rowspan="{{ count($item['subindices']) }}" class="align-middle">{{ number_format($subindex['value'], 2) }}</td>
                                            @endif
                                        @else
                                            <td class="align-middle">{{ number_format($subindex['value'], 2) }}</td>
                                            @if ($loop->first)
                                                <td rowspan="{{ count($item['subindices']) }}" class="align-middle">{{ number_format(array_sum(array_column($item['subindices'], 'value')), 2) }}</td>
                                            @endif
                                        @endif
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="2" class="align-middle">{{ $item['seq'] }}、<a href="{{ route('score.detail', [$id, $key, 0]) }}" title="评分细目">{{ $item['name'] }}</a>（{{ $item['score'] }}分）</td>
                                    <td>{!! nl2br($item['description']) !!}</td>
                                    <td class="align-middle">{{ number_format($item['value'], 2) }}</td>
                                    <td class="align-middle">{{ number_format($item['value'], 2) }}</td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-justify">合计</td>
                            <td colspan="2" class="text-center">{{ number_format($total, 2) }}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
