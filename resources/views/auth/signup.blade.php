<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign up</title>
</head>
<body>
    @if(count($errors) > 0 )
        @foreach($errors->all() as $error)
            <span class="label label-danger"><span class="glyphicon glyphicon-remove-sign"></span>&nbsp;{{$error}}</span><br/>
        @endforeach
    @endif
    <form action="/signup" method="POST">
    <table align="center">
    {{ csrf_field() }}
        <caption>Sign up</caption>
        <tr>
            <td>Username</td><td><input name="username" type="text"></td>
        </tr>
        <tr>
            <td>Password</td><td><input name="password" type="password"></td>
        </tr>
        <tr>
            <td>Retype Password</td><td><input name="password_confirmation" type="password"></td>
        </tr>
        <tr>
            <td>Email</td><td><input name="email" type="text"></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="注册"></td>
        </tr>
    </table>
    </form>
</body>
</html>