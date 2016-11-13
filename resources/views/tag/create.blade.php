@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">新增标签</div>
                <div class="panel-body">
                    
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            {!! implode('<br>', $errors->all()) !!}
                        </div>
                    @endif

                    <form action="{{$curUrl}}" method="POST">
                        {!! csrf_field() !!}
                        <input type="text" name="slug" class="form-control" required="required" placeholder="请输入名称">
                        <br>
                        <textarea name="nickname" rows="10" class="form-control" required="required" placeholder="请输入别名"></textarea>
                        <br>
                        <button class="btn btn-lg btn-info">新增标签</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection