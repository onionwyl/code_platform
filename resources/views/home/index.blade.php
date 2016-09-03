<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Code</title>
    @include("layout.head")
</head>
<body>
@include("layout.header")
    
            <div class="jumbotron">
                <h2 class="text-center">Welcome home, developers！</h2>
                <p class="text-center">Host and manage your code on my platform, you can keep your work private or share it with the world.</p>
                <p class="pull-right"><a href="
                    @if(Request::session()->has('username'))
                        /new
                    @else
                        /signin
                    @endif
                    " class="btn btn-primary btn-lg" role="button">Let's Begin</a></p>
            </div>
    
    
    <br>
    <div class="col-lg-8">
        <h2 class="text-center">Repositories in platform</h2>
        @if(isset($repos) && $repos != null)
        @foreach($repos as $repo)
            <h3><a href="/{{ $repo->username }}">{{ $repo->username }}</a>/<a href="/{{ $repo->username }}/repository/{{ $repo->repo_name }}">{{ $repo->repo_name }}</a></h3>
            <h4>{{ $repo->repo_description }}</h4>
            <em>{{ $repo->update_time }}</em>
            <hr size="2"/>
        @endforeach
        @endif
    </div>
    <div class="col-lg-4">
    @if(Request::session()->has('username'))
        <table class="table table-striped"> 
            <h3>My Repository<a href="/new" class="pull-right">Add</a></h3>
            <tbody>
                @if(isset($userrepo) && $userrepo != null)
                @foreach($userrepo as $repo)
                <tr>
                    <td><span class="glyphicon glyphicon-book"></span> <a href="/{{ $user->username }}/repository/{{ $repo->repo_name }}">{{ $user->username }}/{{ $repo->repo_name }}</a></td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
        <table class="table table-striped"> 
        <h3>My Category</h3>
        <tbody>
        @if(isset($usercat) && $usercat != null)
        @foreach($usercat as $cat)
        <tr>
            <td><a href="/{{ $user->username }}/category/{{ $cat->catid }}">{{ $cat->catname }}({{ $cat->count }})</a></td>
        </tr>
        @endforeach
        @endif
        </tbody>
    @endif
    </div>
    @include("layout.footer")
</body>
</html>