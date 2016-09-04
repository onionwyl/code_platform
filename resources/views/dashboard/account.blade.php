<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Account</title>
    @include("layout.head")
</head>
<body>
    @include("layout.header")
    @include("layout.dashboard")
    <div class="col-lg-9">
        <h3 class="text-center">Change Password</h3>
        @if(count($errors) > 0 )
            @foreach($errors->all() as $error)
                <div class="alert alert-danger"><span class="glyphicon glyphicon-remove-sign"></span>&nbsp;{{$error}}</div>
            @endforeach
        @endif
        @if(isset($passchange))
            <div class="alert alert-success">Password changed successfully.</div>
        @endif
        <form role="form" action="/dashboard/account" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="oldpassword">Old Password</label>
                <input type="password" class="form-control" id="oldpassword" placeholder="oldpassword" name="oldpassword">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="password" name="password">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm new Password</label>
                <input type="password" class="form-control" id="password_confirmation" placeholder="retype-password" name="password_confirmation">
            </div>
            <button type="submit" class="btn btn-default">Update password</button>
        </form>
    </div>
    @include("layout.footer")
</body>
</html>