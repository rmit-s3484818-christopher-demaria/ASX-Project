<!DOCTYPE html>
<html lang="en">
<head>
    <title>Test</title>
</head>
<body>

@foreach ($stocks as $stock)

<p> {{ $stock->symbol }} </p>

@endforeach

</body>

</html>