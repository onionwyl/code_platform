<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign in</title>
</head>
<body>
    @if(count($errors) > 0 )
        @foreach($errors->all() as $error)
            &nbsp;{{ $error }}
        @endforeach
    @endif
    <form action="/signin" method="POST">
    {{ csrf_field() }}
    <table align="center">
        <caption>Sign in</caption>
        <tr>
            <td>Username</td><td><input name="username" type="text"></td>
        </tr>
        <tr>
            <td>Password</td><td><input name="password" type="password"></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="登陆"></td>
        </tr>
    </table>
    </form>
</body>
</html>