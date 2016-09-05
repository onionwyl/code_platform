<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Category</title>
    @include("layout.head")
</head>
<body>
    @include("layout.header")
    <div class="col-lg-2 col-lg-offset-5">
    <h3 class="text-center">Category</h3>
    <table class="table table-hover">
        @foreach($cats as $cat)
        <tr onclick="window.location.href='/category/{{ $cat->catid }}'">
            <th><a href="/category/{{ $cat->catid }}">{{ $cat->catname }}({{ $cat->count }})</a></th>
        </tr>
        @endforeach
    </table>
    </div>
    @include("layout.footer")
</body>
</html>