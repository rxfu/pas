@extends('layouts.default')

@section('title', $index->name)

@section('content')
<div class="container">
    <div class="card mx-auto md-3">
        <div class="card-header">
            <span class="text-left">
                {{ $index->name }}
                @if (!is_null($subindex))
                    - {{ $subindex->name }}
                    （{{ $max = $subindex->score }}分）
                @else
                    （{{ $max = $index->score }}分）
                @endif
            </span>
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('score.create') }}">
                {{ csrf_field() }}

                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th><em>ID</em></th>
                                <th>部门</th>
                                <th>自评材料</th>
                                <th>得分</th>
                            </tr>
                        </thead>
                        <tbody>
                            <input type="hidden" name="index_id" value="{{ $index->id }}">
                            <input type="hidden" name="subindex_id" value="{{ is_null($subindex) ? '' : $subindex->id }}">

                            @foreach ($departments as $department)
                                <tr>
                                    <td><em>{{ $loop->iteration }}</em></td>
                                    <th>{{ $department->name }}</th>
                                    <td>
                                        @if (!empty($department->path))
                                            <a href="{{ asset('storage/' . $department->path) }}" title="下载">下载</a>
                                        @else
                                            无
                                        @endif
                                    </td>
                                    <td>
                                        <input type="text" name="score_{{ $department->id }}" class="form-control" value="{{ empty($scores) ? '' : $scores[$department->id] }}">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="text-center">
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

@push('scripts')
<script>
$(function() {
    $('input:text').on('keyup', function(e) {
        var v = this.value;

        if (v < 0 || v > {{ $max }}) {
            alert('数值输入超出范围，请重新输入');
            this.value = '';
        }
    });
});
</script>
@endpush
