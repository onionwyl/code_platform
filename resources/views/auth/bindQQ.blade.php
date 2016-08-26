<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bind QQ</title>
</head>
<body>
    @if(count($errors) > 0 )
        @foreach($errors->all() as $error)
            &nbsp;{{ $error }}
        @endforeach
    @endif
    <form action="/bindqq" method="POST">
    <table align="center">
    {{ csrf_field() }}
        <caption>Bind with username</caption>
        <tr>
            <td>Username</td><td><input name="username" type="text"></td>
        </tr>
        <tr>
            <td>Password</td><td><input name="password" type="password"></td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" value="Bind"></td>
        </tr>
    </table>
    </form>
    <a href="/">index</a>
</body>
</html>