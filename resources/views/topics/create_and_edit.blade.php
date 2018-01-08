@extends('layouts.app')

@section('content')

<div class="container">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">

            <div class="panel-body">
                <h2 class="text-center">
                    <i class="glyphicon glyphicon-edit"></i>
                    @if($topic->id)
                        编辑话题
                    @else
                        新建话题
                    @endif
                </h2>

                <hr>

                @include('common.error')

                @if($topic->id)
                    <form action="{{ route('topics.update', $topic->id) }}" method="POST" accept-charset="UTF-8">
                        <input type="hidden" name="_method" value="PUT">
                @else
                    <form action="{{ route('topics.store') }}" method="POST" accept-charset="UTF-8">
                @endif

                    <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="form-group">
                        <input class="form-control" type="text" name="title" value="{{ old('title', $topic->title ) }}" placeholder="请填写标题" required/>
                    </div>

                    <div class="form-group">
                        <select class="form-control" name="category_id" required>
                            <option value="" hidden disabled selected>请选择分类</option>
                            @foreach ($categories as $value)
                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <textarea name="body" class="form-control-textarea" id="editor" placeholder="请填入至少三个字符的内容。" required>{{ old('body', $topic->body ) }}</textarea>
                    </div>

                    <div class="well well-sm">
                        <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> 保存</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('editor/ueditor.config.js') }}"></script>
    <script type="text/javascript" src="{{ asset('editor/ueditor.all.js') }}"></script>
    <script>
        $(document).ready(function(){
            var editor = UE.getEditor('editor',
            {toolbars:[[ 'bold','horizontal','fontsize','lineheight','justifyleft','justifyright','justifycenter']],
            elementPathEnabled:false,//是否启用元素路径
            wordCount:false,//是否开启字数统计
            enableContextMenu:false,//是否开启右键菜单
            enableAutoSave:false,//是否自动保存
            fontsize:[12,14, 16, 18, 20],//字号
            lineheight:['1','2','3'],//行间距
            scaleEnabled:true
            });
        });
    </script>
@stop