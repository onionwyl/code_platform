<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Compiler</title>
    @include("layout.head")
    @include("layout.codehead")
    <link href="/css/prism.css" rel="stylesheet" />
    <script src="/js/prism.js"></script>
</head>
<body>
    @include("layout.header")
    <h2>Online Compiler</h2>
    @if(count($errors) > 0 )
        @foreach($errors->all() as $error)
            <div class="alert alert-danger"><span class="glyphicon glyphicon-remove-sign"></span>&nbsp;{{$error}}</div>
        @endforeach
    @endif
    <form action="/run" method="POST">
        {{ csrf_field() }}
        <h3>Code</h3>
        <select name="lang">
            <option value="C">C</option>
        </select>
        <button type="submit" class="btn btn-primary btn-sm">Run</button>
        <textarea name="code" id="code" rows="20" cols="80">@if(old('code') == NULL){{ $code }}@else{{ old('code') }}@endif</textarea>
        <h3>Input</h3>
        <textarea name="input" id="input" rows="5" cols="80">@if(old('input') == NULL){{ $input }}@else{{ old('input') }}@endif</textarea>
        <h3>Output</h3>
        <!--<textarea name="output" rows="5" cols="80" id="output">@if($err_info != "" && $run_status == 2){{ $err_info }}@else{{ $output }}@endif</textarea>-->
        <pre class="line-numbers"><code id="output" name="output">@if($err_info != "" && $run_status == 2){{ $err_info }}@else{{ $output }}@endif</code></pre>
        
    </form>

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
    <script type="text/javascript">
        var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
          lineNumbers: true,
          matchBrackets: true,
          extraKeys: {"Ctrl-Space": "autocomplete"},
          mode: {name: "text/x-csrc", globalVars: true},
          theme: "panda-syntax"
        });
        var editor1 = CodeMirror.fromTextArea(document.getElementById("input"), {
          lineNumbers: true,
          matchBrackets: true,
          extraKeys: {"Ctrl-Space": "autocomplete"},
          theme: "panda-syntax"
        });
        /*var editor2 = CodeMirror.fromTextArea(document.getElementById("output"), {
          lineNumbers: true,
          matchBrackets: true,
          extraKeys: {"Ctrl-Space": "autocomplete"},
          theme: "panda-syntax"
        });*/
    </script>
    @include("layout.footer")
</body>
</html>