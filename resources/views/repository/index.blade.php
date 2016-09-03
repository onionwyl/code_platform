<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Repository</title>
    @include("layout.head")
</head>
<body>
    @include("layout.header")
    <h3><span class="glyphicon glyphicon-book"></span> <a href="/{{ $user->username }}/repository/">{{ $user->username }}</a>/<a href="/{{ $user->username }}/repository/{{ $repo->repo_name }}">{{ $repo->repo_name }}</a></h3>
    <hr/>
    <h4><div class="col-lg-10"><em>{{ $repo->repo_description }}</em></div>
    <div class="col-lg-2 text-right">@if($cat != NULL){{ $cat->cat_name }}@else unclassified @endif</div></h4>
    <hr/>
    <div class="pull-right">
    @if((Request::session()->has('uid') && Request::session()->get('uid') == $user->uid))
    <a href="/{{ $user->username }}/repository/{{ $repo->repo_name }}/file/add" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Create file</a>
    <a href="/dashboard/repository/{{ $repo->repo_name }}/edit" class="btn btn-info"><span class="glyphicon glyphicon-cog"></span> Settings</a>
    @endif
    </div>
    <table class="table table-striped">
    <thead>
        <tr>
            <th>File name</th>
            <th>Description</th>
            <th>Update time</th>
        </tr>
    </thead>
    <tbody>
    @foreach($code as $c)
        <tr>
            <td class="col-lg-2"><span class="glyphicon glyphicon-file"></span> <a href="/{{ $user->username }}/repository/{{ $repo->repo_name }}/{{ $c->file_name }}">{{ $c->file_name }}</a></td>
            <td class="col-lg-8">{{ $c->description }}</td>
            <td class="col-lg-2">{{ $c->updated_at }}</td>
        </tr>
    @endforeach
    </tbody>
    </table>
    @include("layout.footer")
</body>
</html>