<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $user->username }}</title>
</head>
<body>
    <h2>Repository</h2>
    @foreach($repo as $repository)
        <a href="/{{ $user->username }}/repository/{{ $repository->repo_name }}">{{ $repository->repo_name }}</a>
        @if($user->uid == Request::session()->get('uid'))<a href="/dashboard/repository/{{ $repository->repo_name }}/edit">edit</a>@endif<br>
    @endforeach
    <a href="/">index</a>
</body>
</html>