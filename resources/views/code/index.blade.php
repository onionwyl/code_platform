<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code</title>
</head>
<body>
    <h2><a href="/{{ $user->username }}/repository/{{ $repo->repo_name }}">{{ $repo->repo_name }}</a>/{{ $code->file_name }}</h2>
    {{ Request::session()->get('uid') }}
    @if((Request::session()->has('uid') && Request::session()->get('uid') == $user->uid))
    <a href="/{{ $user->username }}/repository/{{ $repo->repo_name }}/edit/{{ $code->file_name }}">edit</a>
    @endif
    <a href="/run?cid={{ $code->cid }}">run</a>
    <p>{{ $code->content }}</p>
    <a href="/">index</a>
</body>
</html>