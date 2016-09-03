<div class="col-lg-8 col-lg-offset-2">
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="/">Code Platform</a>
    </div>
    <div>
        <ul class="nav navbar-nav">
            <li><a href="/">Index</a></li>
            <li><a href="/repository">Repository</a></li>
            <li><a href="/category">Category</a></li>
            <li><a href="/run">Online Compiler</a></li>
            
        </ul>
        @if(Request::session()->get('username')!="")
        <ul class="nav navbar-nav pull-right">
            <li class="dropdown">
                <a href="#" cla ss="dropdown-toggle" data-toggle="dropdown">
                    {{ Request::session()->get('username') }}
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/dashboard"><img src="/avatar/{{Request::session()->get('uid')}}.jpg" height="50" width="50" /><br/>Dashboard</a></li>
                    <li class="divider"></li>
                    <li><a href="/logout">Log out</a></li>
                </ul>
            </li>
        </ul>
        @else
        <ul class="nav nav-pills pull-right">
            <li><a href="/signin">Sign In</a></li>
            <li><a href="/signup">Sign Up</a></li>
        </ul>
        @endif
        
    </div>
    </div> 
</nav>
