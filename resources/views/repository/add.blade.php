<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Repository</title>
</head>
<body>
    <form action="/new" method="POST">
    {{ csrf_field() }}
        <table>
            <CAPTION>Add Repository</CAPTION>
            <tr>
                <td>Repository name</td>
                <td><input type="text" name="repo_name"></td>
            </tr>
            <tr>
                <td>Repository description</td>
                <td><input type="text" name="repo_description"></td>
            </tr>
            <tr>
                <td>Repository type</td>
                <td>
                    <select name="type">
                        <option value="0">未分类</option>
                        @foreach($category as $cat)
                        <option value="{{ $cat->catid }}">{{ $cat->catname }}</option>
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
</body>
</html>