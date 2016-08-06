<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Compiler</title>
    <script src="/js/jquery-3.1.0.min.js"></script>
</head>
<body>
    <h2>Online Compiler</h2>
    @if(count($errors) > 0 )
        @foreach($errors->all() as $error)
            &nbsp;{{ $error }}
        @endforeach
    @endif
    <form action="/run" method="POST">
        {{ csrf_field() }}
        <h3>Code</h3>
        <textarea name="code" rows="25" cols="80">@if(old('code') == NULL){{ $code }}@else{{ old('code') }}@endif</textarea>
        <h3>Input</h3>
        <textarea name="input" rows="10" cols="80">@if(old('input') == NULL){{ $input }}@else{{ old('input') }}@endif</textarea>
        <h3>Output</h3>
        <textarea name="output" rows="10" cols="80" id="output">@if($err_info != "" && $run_status == 2){{ $err_info }}@else{{ $output }}@endif</textarea>
        <select name="lang">
            <option value="C">C</option>
            
        </select>
        <input type="submit" name="submit" value="Run">
    </form>
    <a href="/">index</a>

    <script type="text/javascript">
        @if(Request::has('sid'))
        sid = {{ Request::get('sid') }};
        run_status = {{ $run_status }};
        var out = setInterval("fetchResult()", 1000);
        function fetchResult() {
            $.ajax({
                url: "/ajax/submission",
                type: "GET",
                data: {
                    sid: sid
                },
                dataType: "json",
            }).done(function(json){
                console.log(json);
                run_status = json.run_status;
                output = json.output;
                err_info = json.err_info;
                document.getElementById('output').innerHTML = output + "\n" +err_info;
                if(run_status == 2)
                {
                    clearTimeout(out);
                    return;
                }
            })
        }
        @endif
    </script>
</body>
</html>