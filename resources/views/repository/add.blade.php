<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Repository</title>
    @include("layout.head")
</head>
<body>
    @include("layout.header")
    <div class="col-sm-6 col-sm-offset-3 form-box">
    <h2 class="text-center">Add Repository</h2>
    @if(count($errors) > 0 )
        @foreach($errors->all() as $error)
            <div class="alert alert-danger"><span class="glyphicon glyphicon-remove-sign"></span>&nbsp;{{$error}}</div>
        @endforeach
    @endif
    <form action="/new" method="POST" role="form">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="repo_name">Repository Name</label>
            <input type="text" class="form-control" id="repo_name" placeholder="Repository Name" name="repo_name" value="{{ old('repo_name') }}">
        </div>
        <div class="form-group">
            <label for="repo_description">Repository Description</label>
            <input type="text" class="form-control" id="repo_description" placeholder="Repository description" name="repo_description" value="{{ old('repo_description') }}">
        </div>
        <div class="form-group">
            <label for="type">Repository Category</label>
            <select class="form-control" name="type">
                <option value="0">unclassified</option>
                @foreach($category as $cat)
                <option value="{{ $cat->catid }}" @if(old('type') == $cat->catid) selected="selected" @endif>{{ $cat->catname }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-default">Save</button>
        <button type="button" class="btn btn-default" onclick="javascript: history.go(-1);">Back</button>
    </form>
    @include("layout.footer")
</body>
</html>