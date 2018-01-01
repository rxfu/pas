@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card card-login mx-auto mt-5">
        <div class="card-header">评分</div>
        <div class="card-body">
            <form class="form-horizontal" method="POST" action="{{ route('marker.login') }}">
                {{ csrf_field() }}

                <div class="form-group">
                    <label for="department_id">所在部门</label>
                    <select id="department_id" name="department_id" class="form-control">
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="id">验证码</label>
                    <input class="form-control" id="id" type="text" name="id" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">评分</button>
            </form>
        </div>
    </div>
</div>
@endsection
