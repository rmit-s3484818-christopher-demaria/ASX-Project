<!DOCTYPE html>
<html lang="en">
<head>
    <title>Test</title>
</head>
<body>
<?php $asxes = DB::table('asxes')->get();?>

@foreach ($asxes as $asxe)

<p> {{ $asxe->symbol }} </p>

@endforeach

</body>

</html>