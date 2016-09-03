<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign in</title>
    @include("layout.head")
            <!-- CSS -->
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/form-elements.css">
    <link rel="stylesheet" href="/css/login_style.css">

    <link rel="shortcut icon" href="/ico/favicon.png">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="/ico/apple-touch-icon-57-precomposed.png">
</head>
<body>
    @include("layout.header")
<!--    <form action="/signin" method="POST">
    {{ csrf_field() }}
    <div class="input-group">
        <span class="glyphicon glyphicon-user"></span>
        <input type="text" placeholder="username">
    </div>

    <div class="input-group">
        <span class="glyphicon glyphicon-lock"></span>
        <input type="password" placeholder="password">
    </div>
    <button type="submit" class="btn btn-default">登陆</button>
    <a href="/resetpasswd">forgot</a>
    </form>
    <a href="/">index</a>-->
        <div class="top-content">
        
        <div class="inner-bg">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 form-box">
                        <div class="form-top">
                            <div class="form-top-left">
                                <h3>Login to my site</h3>
                                <p>Enter your username and password to log on:</p>
                            </div>
                        </div>
                        @if(count($errors) > 0 )
                            @foreach($errors->all() as $error)
                                &nbsp;{{ $error }}
                            @endforeach
                        @endif
                        <div class="form-bottom">
                            <form role="form" action="/signin" method="post" class="login-form">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="sr-only" for="username">Username</label>
                                    <input type="text" name="username" placeholder="Username..." class="form-username form-control" id="form-username">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="password">Password</label>
                                    <input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
                                </div>
                                <button type="submit" class="btn">Sign in!</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-sm-offset-3 ">
                        <h3>...or login with:</h3>
                        <div class="social-login-buttons">
                            <a href="/qqlogin">
                                <img src="/img/bt_blue_76X24.png">
                            </a>
                        </div>
                        <a href="/resetpasswd">
                            Forgot password?
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- Javascript -->
        <script src="/js/jquery.min.js"></script>
        <script src="/js/bootstrap.min.js"></script>
        <script src="/js/jquery.backstretch.min.js"></script>
        <script src="/js/scripts.js"></script>
    @include("layout.footer")
</body>
</html>