<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Repository</title>
    @include("layout.head")
</head>
<body>
    @include("layout.header")
    @if(count($errors) > 0 )
        @foreach($errors->all() as $error)
            &nbsp;{{ $error }}
        @endforeach
    @endif
    <form action="/dashboard/repository/{{ $repo->repo_name }}/edit" method="POST">
    {{ csrf_field() }}
        <table>
            <CAPTION>Add Repository</CAPTION>
            <tr>
                <td>Repository name</td>
                <td><input type="text" name="repo_name" value="{{ $repo->repo_name }}"></td>
            </tr>
            <tr>
                <td>Repository description</td>
                <td><input type="text" name="repo_description" value="{{ $repo->repo_description }}"></td>
            </tr>
            <tr>
                <td>Repository type</td>
                <td>
                    <select name="type">
                        <option value="0">未分类</option>
                        @foreach($category as $cat)
                        <option value="{{ $cat->catid }}" @if($repo->catid == $cat->catid) selected="selected" @endif>{{ $cat->catname }}</option>
                        @endforeach
                    </select>
                </td>
            </tr>
            <tr>
                <td><input name="submit" type="submit" value="save"></td>
                <td><button type="button"  onclick="window.location.href='/'"">back</button>
            </tr>
        </table>
    </form>
    @include("layout.footer")
</body>
</html>