<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $user->username }}</title>
    @include("layout.head")
</head>
<body>
    @include("layout.header")
    <div class="row">
        <div class="col-lg-3">
            <img src="/avatar/{{ $user->uid }}.jpg" height="200" width="200">
            <h4><p class="text-muted">{{ $user->username }}</p></h4>
            <h4>@if($userinfo->nickname != "")<p class="text-muted">{{ $userinfo->nickname }}@else <a href="/dashboard/profile">Add a nickname</a>@endif</p></h4>
            <h4>@if($userinfo->nickname != "")<p class="text-muted">{{ $userinfo->signature }}@else <a href="/dashboard/profile">Add signature</a>@endif</p></h4>
            <h4>@if($userinfo->nickname != "")<p class="text-muted">{{ $userinfo->introduction }}@else <a href="/dashboard/profile">Add introduction</a>@endif</p></h4>
            <hr/>
            <h4><p class="text-muted"><span class="glyphicon glyphicon-envelope"></span> <a href="mailto:{{ $user->email }}">{{ $user->email }}</a></p></h4>
            <h4><p class="text-muted"><span class=" glyphicon glyphicon-time"></span> Joined on {{ $user->created_at }}</p></h4>
            <hr/>
        </div>
        <div class="col-lg-9">
            @if((Request::session()->has('uid') && Request::session()->get('uid') == $user->uid))
            <div class="alert alert-info">
            <a href="#" class="close" data-dismiss="alert">
                &times;
            </a>
                ProTip! Updating your profile with your nickname, introduction, and a profile picture helps other users get to know you.  <a class="btn btn-success" href="/dashboard/profile">Edit Profile</a>
            </div>
            @endif
            <h3>Repository</h3>
            <table class="table table-striped">
            <thead>
                <tr>
                    <th class="col-lg-2">Name</th>
                    <th class="col-lg-7">Description</th>
                    <th class="col-lg-3">Update time</th>
                </tr>
            </thead>
            <tbody>
            @foreach($repo as $repository)
                <tr>
                    <td class="col-lg-2"><a href="/{{ $user->username }}/repository/{{ $repository->repo_name }}">{{ $repository->repo_name }}</a></td>
                    <td class="col-lg-7">{{ $repository->repo_description }}</td>
                    <td class="col-lg-3">{{ $repository->update_time }}</td>
                </tr>
            @endforeach
            </tbody>
            </table>
        </div>
    </div>
    @include("layout.footer")
</body>
</html>