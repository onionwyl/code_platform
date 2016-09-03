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
    @foreach($cats as $cat)
        <a href="/category/{{ $cat->catid }}">{{ $cat->catname }}({{ $cat->count }})</a><br>
    @endforeach
    <br><a href="/">index</a>
    @include("layout.footer")
</body>
</html>