<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Category</title>
    @include("layout.head")
</head>
<body>
    @include("layout.header")
    @if(count($errors) > 0 )
        @foreach($errors->all() as $error)
            &nbsp;{{ $error }}
        @endforeach
    @endif
    <form action="/dashboard-admin/category/add" method="POST">
        {{ csrf_field() }}
        <table>
            <caption>Add Category</caption>
            <tr>
                <td>Category Name</td>
                <td><input type="text" name="catname"></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="Add"></td>
            </tr>
        </table>
    </form>
    @include("layout.footer")
</body>
</html>