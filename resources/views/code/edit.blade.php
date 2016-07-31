<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit File</title>
</head>
<body>
    @if(count($errors) > 0 )
        @foreach($errors->all() as $error)
            &nbsp;{{ $error }}
        @endforeach
    @endif
    <form action="/{{ $user->username }}/repository/{{ $repo->repo_name }}/edit/{{ $code->file_name }}" method="POST">
        {{ csrf_field() }}
        <h3>{{ $repo->repo_name }}\<input type="text" name="file_name" value="@if(old('file_name') == NULL) {{ $code->file_name }} @else {{ old('file_name') }} @endif"></h3>
        <h3>Code</h3>
        <textarea name="code" rows="40" cols="80">@if(old('code') == NULL) {{ $code->content }} @else {{ old('code') }} @endif</textarea>
        <input type="submit" name="submit" value="save">
    </form>
    <a href="/">index</a>
</body>
</html>