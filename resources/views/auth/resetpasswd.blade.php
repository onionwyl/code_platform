<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    @include("layout.head")
</head>
<body>
    @include("layout.header")
    <form action="/reset" method="POST">
        {{ csrf_field() }}
        <input type="hidden" name="token" value={{ $token }}>
        <table>
            <caption>Reset Password</caption>
            <tr>
                <td>Password</td>
                <td><input type="password" name="password"></td>
            <tr>
                <td>Retype Password</td>
                <td><input type="password" name="password_confirmation"></td>
            </tr>
            <tr>
                <td><input type="submit" name="submit" value="save"></td>
            </tr>
        </table>
    </form>
    @include("layout.footer")
</body>
</html>