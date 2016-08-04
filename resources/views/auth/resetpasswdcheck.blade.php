<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
</head>
<body>
    @if(count($errors) > 0 )
        @foreach($errors->all() as $error)
            &nbsp;{{ $error }}
        @endforeach
    @endif
    @if(isset($info))
        {{ $info }}
    @endif
    <form action="/resetpasswd" method="POST">
        {{ csrf_field() }}
        <table>
            <caption align="center">Reset Password</caption>
            <tr>
                <td>Username</td>
                <td><input type="text" name="username"></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" name="email"></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="send"></td>
            </tr>
        </table>
    </form>
</body>
</html>