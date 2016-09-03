<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Category</title>
    @include("layout.head")
</head>
<body>
    @include("layout.header")
    <h2>Category</h2>
    <a href="/dashboard-admin/category/add">Add</a>
    @foreach($cats as $cat)
        <a href="/category/{{ $cat->catid }}">{{ $cat->catname }}({{ $cat->count }})</a><a href="/dashboard-admin/category/{{ $cat->catid }}/edit">eidt</a><br>
    @endforeach
    <br><a href="/">index</a>
    @include("layout.footer")
</body>
</html>