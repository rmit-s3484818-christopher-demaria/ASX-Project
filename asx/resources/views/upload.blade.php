<!DOCTYPE html>
<html lang="en">
<head>
    <title>Upload</title>
</head>
<body>

    <form action="ImportClients" method="post" enctype="multipart/form-data">
    <label>Upload file : </label><br>
    <input type="file" name="file" />
    <input type="hidden" value="{{ csrf_token() }}" name="_token">
        <input type="submit" value="Upload"><br>
    </form>
</body>

</html>