<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code</title>
</head>
<body>
    <h1 align="center">Welcome!</h1>
    @if(Request::session()->get('username') == "")
        <a href="/signin">signin</a>
        <a href="/signup">signup</a>
    @else
        <a href="/dashboard">{{ Request::session()->get('username') }}</a>
        <a href="/logout">logout</a>
        <h2>Repository</h2>
        <a href="/new">Add Repository</a>
        <a href="/{{ Request::session()->get('username') }}">User index</a>
        <h2>Categories</h2>
    @endif
</body>
</html>