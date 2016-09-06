<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    @include("layout.head")
    <script language="javascript" type="text/javascript">
        function showform(floor)
        {
            if(document.getElementById('reply-form'+floor).style.display != "block")
            {
                document.getElementById('reply-form'+floor).style.display = "block";
            }
            else
            {
                document.getElementById('reply-form'+floor).style.display = "none";
            }
        }
    </script>
</head>
<body>
    @include("layout.header")
    <h3><span class="glyphicon glyphicon-book"></span> <a href="/{{ $user->username }}/repository/">{{ $user->username }}</a>/<a href="/{{ $user->username }}/repository/{{ $repo->repo_name }}">{{ $repo->repo_name }}</a><a href="/comment/{{ $user->username }}/repository/{{ $repo->repo_name }}" class="btn btn-primary pull-right">Comment</a></h3>
    <hr/>
    @foreach($comments as $comment)
        <div class="row">
            <div class="col-lg-2">
                <img src="/avatar/{{ $comment->uid }}.jpg" class="img-circle" height="50" width="50">
                <br/>
                <em>{{ $comment->name }}</em>
                <br/>
                @if(Request::session()->get('username') == $comment->username || (Request::session()->has('gid') && Request::session()->get('gid') == 0))
                <form action="/comment/delete/{{ $comment->comid }}" method="POST">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <input type="hidden" name="uid" value="{{ $comment->uid }}">
                    <button type="submit" class="btn btn-default">Delete</button>
                </form>
                @endif
            </div>
            <div class="col-lg-10">
                <p>@if($comment->replyto != 0)Reply to floor {{ $comment->replyto }}: @endif{{ $comment->content }}</p>
                <div class="text-right">
                    <em>floor {{ $comment->floor }} at {{ $comment->created_at }}</em>
                    <br/>
                    <a id="reply" onclick="return showform('{{ $comment->floor }}')">回复</a>
                </div>
            </div>
        </div>
        <hr/>
        <div id="reply-form{{ $comment->floor }}" style="display:none">
            <div class="form-box">
                <form role="form" action="/comment/reply" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="repoid" value="{{ $repo->rid }}">
                    <input type="hidden" name="replyto" value="{{ $comment->floor }}">
                    <div class="form-group">
                        <label for="comment">Reply floor {{ $comment->floor }}</label>
                        <textarea id="comment" name="comment" placeholder="Please add comment" class="form-control"></textarea>
                    </div>
                    <button class="btn btn-default" type="submit">Comment</button>
                </form>
            </div>
            <hr/>
        </div>
    @endforeach
    <div class="form-box">
        <form role="form" action="/comment/add" method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="repoid" value="{{ $repo->rid }}">
            <div class="form-group">
                <label for="comment">Comment</label>
                <textarea id="comment" name="comment" placeholder="Please add comment" class="form-control"></textarea>
            </div>
            <button class="btn btn-default" type="submit">Comment</button>
        </form>
    </div>
    @include("layout.footer")

    
</body>
</html>