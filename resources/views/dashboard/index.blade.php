<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    @include("layout.head")
</head>
<body>
    @include("layout.header")
    <div class="text-center">
        <p><a href="/dashboard/profile">Profile</a></p>
        <p><a href="/dashboard/repository">Repository</a></p>
    </div>
    @include("layout.footer")
</body>
</html>