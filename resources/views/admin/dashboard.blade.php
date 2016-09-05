<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    @include("layout.head")
</head>
<body>
    @include("layout.header")
    @include("layout.admin-dashboard")
        <iframe class="col-lg-9" height="800" frameborder="0" src="/dashboard-admin/systeminfo"></iframe>
    @include("layout.footer")
</body>
</html>