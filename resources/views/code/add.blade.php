<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add File</title>
</head>
<body>
    @if(count($errors) > 0 )
        @foreach($errors->all() as $error)
            &nbsp;{{ $error }}
        @endforeach
    @endif
    <form action="/{{ $user->username }}/repository/{{ $repo->repo_name }}/add" method="POST">
        {{ csrf_field() }}
        <h3>{{ $repo->repo_name }}\<input type="text" name="file_name" value="{{ old('file_name') }}"></h3>
        <h3>Code</h3>
        <textarea name="code" rows="40" cols="80">{{ old('code') }}</textarea>
        <input type="submit" name="submit" value="save">
    </form>
    <a href="/">index</a>
</body>
</html>