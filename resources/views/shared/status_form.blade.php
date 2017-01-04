<form action="{{route('statuses.store')}}" method="post">
    @include('shared.errors')
    {{csrf_field()}}
    <textarea name="content" id="content" rows="5" class="form-control" placeholder="聊聊新鲜事...">{{old('content')}}</textarea>
    <button type="submit" class="btn btn-primary pull-right">发布</button>
</form>