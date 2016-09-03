<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register With QQ</title>
    @include("layout.head")
</head>
<body>
    @include("layout.header")
    @if(count($errors) > 0 )
        @foreach($errors->all() as $error)
            &nbsp;{{ $error }}
        @endforeach
    @endif
    <form action="/signupqq" method="POST">
    <table align="center">
    {{ csrf_field() }}
        <caption>Sign up</caption>
        <a href="/bindqq">Bind with an existing user</a>
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
    <a href="/">index</a>
    @include("layout.footer")
</body>
</html>