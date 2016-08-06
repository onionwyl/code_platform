<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code</title>
</head>
<body>
    <h1 align="center">Welcome!</h1>
    <p><a href="/run">Online Compiler</a></p>
    @if(!Request::session()->has('username'))
        <a href="/signin">signin</a>
        <a href="/signup">signup</a>
    @endif   
    @if(Request::session()->has('username'))
        <br>
        <a href="/dashboard">{{ Request::session()->get('username') }}</a>
        <a href="/logout">logout</a>
        <h2>My Repository</h2>
        <a href="/new">Add Repository</a>
        <a href="/{{ Request::session()->get('username') }}">User index</a>
        <br>
        @foreach($userrepo as $repo)
            <a href="/{{ $user->username }}/repository/{{ $repo->repo_name }}">{{ $user->username }}/{{ $repo->repo_name }}</a>
        @endforeach
        <h2>My Category</h2>
        @foreach($usercat as $cat)
            <a href="/{{ $user->username }}/category/{{ $cat->catid }}">{{ $cat->catname }}({{ $cat->count }})</a><br>
        @endforeach
    @endif
    <br>
    <h2>Repository</h2>
    @foreach($repos as $repo)
        <a href="/{{ $repo->username }}/repository/{{ $repo->repo_name }}">{{ $repo->username }}/{{ $repo->repo_name }}</a>
    @endforeach
    <h2>Category</h2>
    @foreach($cats as $cat)
        <a href="/category/{{ $cat->catid }}">{{ $cat->catname }}({{ $cat->count }})</a><br>
    @endforeach
</body>
</html>