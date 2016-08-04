<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $cat->catname }}</title>
</head>
<body>
    <h2>{{ $cat->catname }}</h2>
    @foreach($repos as $repo)
        <a href="/{{ $repo->username }}/repository/{{ $repo->repo_name }}">{{ $repo->username }}/{{ $repo->repo_name }}</a>
    @endforeach
</body>
</html>