<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Category</title>
</head>
<body>
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
</body>
</html>