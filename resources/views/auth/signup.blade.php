<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign up</title>
    @include("layout.head")
</head>
<body>
    @include("layout.header")
    <div class="col-sm-6 col-sm-offset-3 form-box">
        <h2 class="text-center">Sign up</h2>
        @if(count($errors) > 0 )
            @foreach($errors->all() as $error)
                <div class="alert alert-danger"><span class="glyphicon glyphicon-remove-sign"></span>&nbsp;{{$error}}</div>
            @endforeach
        @endif
        <form role="form" action="/signup" method="POST">
            {{ csrf_field() }}
            <div class="form-group">
                <label for="name">Username</label>
                <input type="text" class="form-control" id="name" placeholder="username" name="username">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" placeholder="password" name="password">
            </div>
            <div class="form-group">
                <label for="password_confirmation">Retype Password</label>
                <input type="password" class="form-control" id="password_confirmation" placeholder="retype-password" name="password_confirmation">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" placeholder="email" name="email">
            </div>
            <button type="submit" class="btn btn-default">Sign up</button>
        </form>
    </div>
    @include("layout.footer")
</body>
</html>