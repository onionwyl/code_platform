<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Compiler</title>
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
        <textarea name="output" rows="10" cols="80">@if($err_info != ""){{ $err_info }}@else{{ $output }}@endif</textarea>
        <select name="lang">
            <option value="C">C</option>
            
        </select>
        <input type="submit" name="submit" value="Run">
    </form>
    <a href="/">index</a>
</body>
</html>