<!DOCTYPE html>
<html lang="en">
<head>
    <title>Image Upload 4MB</title>
</head>
<body>
<div class="container">
    <h2>Upload Images (Max 4MB in One img)</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="file" name="images[]" multiple required>
        <button type="submit" name="upload">Upload</button>
    </form>
    <?php
    if (isset($_POST['upload'])) {

        $uploadpic = "uploads/";
        if (!is_dir($uploadpic)) {
            mkdir($uploadpic, 0777, true);
        }
        foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
            $fileSize = $_FILES['images']['size'][$key];
            $fileName = basename($_FILES['images']['name'][$key]);
            $targetFile = $uploadpic . $fileName;

              if ($fileSize <= 4 * 720 * 720) {
                if (move_uploaded_file($tmpName, $targetFile)) {
                    echo "<p input>Uploaded: $fileName</p>";
                } else {
                    echo "<p again> $fileName</p>";
                }
            } else {
                echo "<p less >$fileName is less than 4MB</p>";
         }
 }
    }
    $files = glob("uploads/*.{jpg,jpeg,png,gif}", GLOB_BRACE);
    if (!empty($files)) {
        echo "<h3>Uploaded Images</h3>";
        foreach ($files as $file) {
            echo "<img src='$file' alt='Uploaded Image'>";
                }
 }
    ?>
</div>
</body>
</html>