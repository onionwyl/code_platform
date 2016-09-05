<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    @include("layout.head")
</head>
<body>
    @include("layout.header")
    @include("layout.admin-dashboard")
    <div class="col-lg-9">
        <h3 class="text-center">Users</h3>
        <table class="table table-hover">
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="col-lg-5"><a href="/{{ $user->username }}">{{ $user->username }}</a></td>
                        <td class="col-lg-5"><a href="/dashboard-admin/users/{{ $user->uid }}" class="btn btn-warning">Edit</a></td>
                        <td>
                            <form action="/dashboard-admin/users/{{ $user->uid }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                                <button type="submit" class="btn btn-danger" onclick="return confirm('confirm')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @include("layout.footer")
</body>
</html>