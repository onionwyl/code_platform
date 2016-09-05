<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Category</title>
    @include("layout.head")
</head>
<body>
    @include("layout.header")
    @include("layout.admin-dashboard")
    <div class="col-lg-9">
        <h2>Category<a href="/dashboard-admin/category/add" class="btn btn-success pull-right">Add</a></h2>
        <table class="table table-hover">
            <tbody>
                @foreach($cats as $cat)
                <tr>
                    <td class="col-lg-5"><a href="/category/{{ $cat->catid }}">{{ $cat->catname }}({{ $cat->count }})</a></td>
                    <td class="col-lg-5"><a href="/dashboard-admin/category/{{ $cat->catid }}/edit" class="btn btn-warning">Edit</a></td>
                    <td><a href="/dashboard-admin/category/{{ $cat->catid }}/delete" class="btn btn-danger" onclick="return confirm('confirm')">Delete</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include("layout.footer")
</body>
</html>