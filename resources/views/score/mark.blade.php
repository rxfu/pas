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
                                <th>部门</th>
                                <th>自评材料</th>
                                <th>得分</th>
                            </tr>
                        </thead>
                        <tbody>
                            <input type="hidden" name="index_id" value="{{ $index }}">
                            <input type="hidden" name="subindex_id" value="{{ $subindex }}">

                            @foreach ($departments as $department)
                                <th>{{ $department->name }}</th>
                                <td>
                                    @if (!empty($department->path))
                                        <a href="{{ asset('storage/' . $department->path) }}" title="下载">下载</a>
                                    @else
                                        无
                                    @endif
                                </td>
                                <td>
                                    <input type="text" name="score_{{ $department->id }}" class="form-control" value="" min="0" max="{{ $subindex->score }}">
                                </td>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-center">
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
