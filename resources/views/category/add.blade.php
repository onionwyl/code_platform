<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Category</title>
    @include("layout.head")
</head>
<body>
    @include("layout.header")
    @include("layout.admin-dashboard")
    <div class="col-lg-9">
    @if(count($errors) > 0 )
        @foreach($errors->all() as $error)
            <div class="alert alert-danger"><span class="glyphicon glyphicon-remove-sign"></span>&nbsp;{{$error}}</div>
        @endforeach
    @endif
    <form action="/dashboard-admin/category/add" method="POST" role="form">
        {{ csrf_field() }}
        <h3 class="text-center">Add Category</h3>
        <div class="form-group">
            <label for="catname">Category Name</label>
            <input type="text" class="form-control" id="catname" placeholder="Category Name" name="catname">
        </div>
        <button type="submit" class="btn btn-default">Add</button>
    </form>
    </div>
    @include("layout.footer")
</body>
</html>