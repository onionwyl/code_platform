<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
</head>
<body>
    <h1>dashboard</h1>
    @if(count($errors) > 0 )
        @foreach($errors->all() as $error)
            &nbsp;{{ $error }}
        @endforeach
    @endif
    <form action="/dashboard/profile" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <table>
            <caption>{{ $user->username }} profile</caption>
            <tr>
            <td></td>
                <td><img src="/avator/{{ $user->uid }}.jpg" height="100" width="100" align="center"></td>
            </tr>
            <tr>
                <td>nickname</td>
                <td><input name="nickname" type="text" value="{{ $userinfo->nickname }}"></td>
            </tr>
            <tr>
                <td>email</td>
                <td><input name="email" type="email" value="{{ $user->email }}"></td>
            </tr>
            <tr>
                <td>realname</td>
                <td><input name="realname" type="text" value="{{ $userinfo->realname }}"></td>
            </tr>
            <tr>
                <td>signature</td>
                <td><input name="signature" type="text" value="{{ $userinfo->signature }}"></td>
            </tr>
            <tr>
                <td>introduction</td>
                <td><textarea name="introduction">{{ $userinfo->introduction }}</textarea></td>
            </tr>
            <tr>
                <td>avator</td>
                <td><input  type="file" name="image" accept="image/*"></td>
            </tr>
            <tr>
                <td><input name="submit" type="submit" value="save"></td>
                <td><button type="button"  onclick="window.location.href='/'"">back</button>
            </tr>
        </table>
    </form>
</body>
</html>