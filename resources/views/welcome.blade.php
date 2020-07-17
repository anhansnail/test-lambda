<!DOCTYPE html>
<html>
<body>

<form action="{{url('/home')}}" method="post" enctype="multipart/form-data">
    @csrf
    Select image to upload:
    <input type="file" name="test_lambda" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>

<br>
<h1>resurl</h1>
<br>
@if(isset($url))
    <img src="{{$url}}">
    @endif
</body>
</html>
