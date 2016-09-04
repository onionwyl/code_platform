<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Repository</title>
    @include("layout.head")
</head>
<body>
    @include("layout.header")
    @include("layout.dashboard")
    <div class="col-lg-9">
    <h3>Repository</h3>
    <table class="table table-hover">
    <tbody>
    @foreach($repo as $repository)
        <tr>
            <td><a href="/{{ $user->username }}/repository/{{ $repository->repo_name }}">{{ $repository->repo_name }}</a></td>
            <td><a href="/dashboard/repository/{{ $repository->repo_name }}/edit" class="btn btn-warning">edit</a></td>
            <td>
                <form  method="post" action="/dashboard/repository/{{ $repository->repo_name }}" onsubmit = "return confirm('确认删除')">
                    {{ method_field('DELETE') }}
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
    @endforeach
    </tbody>
    </table>
    </div>
    @include("layout.footer")
</body>
</html>