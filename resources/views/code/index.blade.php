<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code</title>
    @include("layout.head")
    <link href="/css/prism.css" rel="stylesheet" />
    <script src="/js/prism.js"></script>
</head>
<body>
    @include("layout.header")
    <h3><span class="glyphicon glyphicon-book"></span> <a href="/{{ $user->username }}/repository/">{{ $user->username }}</a>/<a href="/{{ $user->username }}/repository/{{ $repo->repo_name }}">{{ $repo->repo_name }}</a>/{{ $code->file_name }}</h3>
    <div class="row">
    <div class="col-lg-2">
    @if((Request::session()->has('uid') && Request::session()->get('uid') == $user->uid))
    <a href="/{{ $user->username }}/repository/{{ $repo->repo_name }}/edit/{{ $code->file_name }}" class="btn btn-warning"><span class="glyphicon glyphicon-pencil"></span> edit</a>
    @endif
    <a href="/run?cid={{ $code->cid }}" class="btn btn-success"><span class="glyphicon glyphicon-play"></span> run</a>
    </div>
    </div>
    <pre class="line-numbers"><code class="language-c-like">{{ $code->content }}</code></pre>
    @include("layout.footer")
</body>
</html>