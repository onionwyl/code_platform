<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add File</title>
    @include("layout.head")
    @include("layout.codehead")
</head>
<body>
    @include("layout.header")
    @if(count($errors) > 0 )
        @foreach($errors->all() as $error)
            <div class="alert alert-danger"><span class="glyphicon glyphicon-remove-sign"></span>&nbsp;{{$error}}</div>
        @endforeach
    @endif
    <form action="/{{ $user->username }}/repository/{{ $repo->repo_name }}/file/add" method="POST" role="form">
        {{ csrf_field() }}
        <h3><span class="glyphicon glyphicon-book"></span> <a href="/{{ $user->username }}/repository/">{{ $user->username }}</a>\<a href="/{{ $user->username }}/repository/{{ $repo->repo_name }}">{{ $repo->repo_name }}</a>\<input type="text" name="file_name" value="{{ old('file_name') }}"></h3>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" class="form-control" id="description" placeholder="description" name="description" value="{{ old('description') }}">
        </div>
        <div class="form-group">
            <label for="code">Code</label>
            <textarea name="code" id="code" rows="20" cols="80">{{ old('code') }}</textarea>
        </div>
        <button type="submit" class="btn btn-default">Save</button>
    </form>
    @include("layout.footer")
    <script type="text/javascript">
        var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
          lineNumbers: true,
          matchBrackets: true,
          extraKeys: {"Ctrl-Space": "autocomplete"},
          mode: {name: "text/x-csrc", globalVars: true},
          theme: "panda-syntax"
        });
    </script>
</body>
</html>