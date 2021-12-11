<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Generator</title>
    <!-- script for image validation  -->
    <script>
    function fileValidation(){
        var fileInput = document.getElementById('file');
        var filePath = fileInput.value;
        var allowedExtensions = /(\.jpeg)$/i;
        if(!allowedExtensions.exec(filePath)){
            alert('Please upload file having extension .jpeg only.');
            fileInput.value = '';
            return false;
        }
    }
    function iframevisible(){
        document.getElementById("iframe").style.visibility = "visible";
    }
    </script>
</head>
<body>
<form method="post" target="frame" action="certificate_generator.php">
<input type="textbox" name="name" placeholder="Enter name here"/>
<br>
<br>
<input type="file" id="file" name="image" onchange="return fileValidation()"/>
<br>
<br>
<input type="number" name="size" placeholder="size"/>
<input type="number" name="orientation" placeholder="orientation"/>
<input type="number" name="x" placeholder="x axis"/>
<input type="number" name="y" placeholder="y axis"/>
<br>
<br>
<input type="submit" name="submit" onclick=iframevisible(); />
<!-- onclick="this.form.target='_blank';return true;"      for opening in new tab -->
</form>

<iframe name="frame" id="iframe" src="certificate_generator.php" style="width:99vw; height:99vh; border:0; visibility:hidden;"> Iframe not supported.</iframe>

</body>
</html>