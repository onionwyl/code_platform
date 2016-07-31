<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code</title>
</head>
<body>
    <h2>{{ $repo->repo_name }}/{{ $code->file_name }}</h2><a href="/{{ $user->username }}/repository/{{ $repo->repo_name }}/edit/{{ $code->file_name }}">edit</a>
    <p>{{ $code->content }}</p>
    <a href="/">index</a>
</body>
</html>