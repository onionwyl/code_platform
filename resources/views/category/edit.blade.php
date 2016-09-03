<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Category</title>
    @include("layout.head")
</head>
<body>
    @include("layout.header")
    @if(count($errors) > 0 )
        @foreach($errors->all() as $error)
            &nbsp;{{ $error }}
        @endforeach
    @endif
    <form action="/dashboard-admin/category/{{ $cat->catid }}/edit" method="POST">
        {{ csrf_field() }}
        <table>
            <caption>Edit Category</caption>
            <tr>
                <td>Category Name</td>
                <td><input type="text" name="catname" value="{{ $cat->catname }}"></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="save"></td>
            </tr>
        </table>
    </form>
    @include("layout.footer")
</body>
</html>