<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Repository</title>
    @include("layout.head")
</head>
<body>
    @include("layout.header")
    <h3 class="text-center">Repository</h3>
    <table class="table table-striped">
    <thead>
        <tr>
            <th class="col-lg-2">Name</th>
            <th class="col-lg-2">Author</th>
            <th class="col-lg-5">Description</th>
            <th class="col-lg-3">Update time</th>
        </tr>
    </thead>
    <tbody>
    @foreach($repos as $repository)
        <tr>
            <td class="col-lg-2"><a href="/{{ $repository->username }}/repository/{{ $repository->repo_name }}">{{ $repository->repo_name }}</a></td>
            <td class="col-lg-2"><a href="/{{ $repository->username }}">{{ $repository->username }}</a></td>
            <td class="col-lg-5">{{ $repository->repo_description }}</td>
            <td class="col-lg-3">{{ $repository->update_time }}</td>
        </tr>
    @endforeach
    </tbody>
    </table>
    @include("layout.footer")
</body>
</html>