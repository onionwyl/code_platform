<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Repository</title>
    @include("layout.head")
</head>
<body>
    @include("layout.header")
    <h2>Repository</h2>
    @foreach($repo as $repository)
        <a href="/{{ $user->username }}/repository/{{ $repository->repo_name }}">{{ $repository->repo_name }}</a>
        <a href="/dashboard/repository/{{ $repository->repo_name }}/edit">edit</a>
        <form  method="post" action="/dashboard/repository/{{ $repository->repo_name }}" onsubmit = "return confirm('确认删除')">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <input type="submit" value="delete" />
        </form>
    @endforeach
    <a href="/">index</a>
    @include("layout.footer")
</body>
</html>