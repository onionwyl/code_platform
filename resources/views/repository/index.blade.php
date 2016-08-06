<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Repository</title>
</head>
<body>
    <h2> Repository {{ $user->username }}/{{ $repo->repo_name }}</h2>
    @if((Request::session()->has('uid') && Request::session()->get('uid') == $user->uid))
    <a href = "/{{ $user->username }}/repository/{{ $repo->repo_name }}/add">Create file</a>
    @endif
    @foreach($code as $c)
        <a href="/{{ $user->username }}/repository/{{ $repo->repo_name }}/{{ $c->file_name }}">{{ $c->file_name }}</a><br>
    @endforeach
    <a href="/">index</a>
</body>
</html>