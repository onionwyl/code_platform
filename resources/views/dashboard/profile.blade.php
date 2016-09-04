<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    @include("layout.head")
</head>
<body>
    @include("layout.header")
    @include("layout.dashboard")
    <div class="col-lg-9">
        <h3 class="text-center">Profile</h3>
        @if(count($errors) > 0 )
            @foreach($errors->all() as $error)
                <div class="alert alert-danger"><span class="glyphicon glyphicon-remove-sign"></span>&nbsp;{{$error}}</div>
            @endforeach
        @endif
        <img src="/avatar/{{ $user->uid }}.jpg" height="150" width="150" class="img-rounded">
        <form role="form" action="/dashboard/profile" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="nickname">Nickname</label>
                <input type="text" class="form-control" id="nickname" placeholder="nickname" name="nickname" value="{{ $userinfo->nickname }}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="email" name="email" value="{{ $user->email }}">
            </div>
            <div class="form-group">
                <label for="realname">Realname</label>
                <input type="text" class="form-control" id="realname" placeholder="realname" name="realname" value="{{ $userinfo->realname }}">
            </div>
            <div class="form-group">
                <label for="signature">Signature</label>
                <input type="text" class="form-control" id="signature" placeholder="signature" name="signature" value="{{ $userinfo->signature }}">
            </div>
            <div class="form-group">
                <label for="introduction">Introduction</label>
                <textarea class="form-control" id="introduction" placeholder="introduction" name="introduction">{{ $userinfo->introduction }}</textarea>
            </div>
            <div class="form-group">
                <label for="avatar">Avatar</label>
                <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
            </div>
            <button type="submit" class="btn btn-default">Save</button>
            <button type="button" class="btn btn-default" onclick="javascript: history.go(-1);">Back</button>
        </form>
    </div>
    @include("layout.footer")
</body>
</html>