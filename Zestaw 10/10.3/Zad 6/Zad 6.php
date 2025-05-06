<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="Styles6.css">
</head>
<body>
<div id="container">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <h1>Wprowadź nazwę pliku lub katalogu</h1>
        <div id="submitContainer">
            <input type="text" name="path" id="pathText">
            <input type="submit" id="submit">
        </div>
    </form>
    <div id="result">
        <h3>Wyniki: </h3>
        <?php
        function checkDir($path)
        {
            if (!file_exists($path)) {
                return "none";
            }

            if (is_file($path)) {
                return "file";
            }
            if (is_dir($path)) {
                return "dir";
            }
        }

        function dirSize($path)
        {
            $size = 0;
            $dir = opendir($path);
            while (false !== ($file = readdir($dir))) {
                if ($file != "." && $file != "..") {
                    $newPath = $path . "/" . $file;
                    if (is_dir($newPath)) {
                        $size += @dirSize($newPath);
                    } else {
                        $size += @filesize($newPath);
                    }
                }
            }
            closedir($dir);
            return $size;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $path = $_POST["path"];
            $files = scandir(getcwd());

            switch (checkDir($path)) {
                case "none":
                    echo "<strong>Taki plik nie istnieje!</strong>";
                    break;
                case "dir":
                    $size = dirSize($path);
                    echo "Rozmiar: $size bajtów<br>";
                    $size /= 1024;
                    echo "Rozmiar: $size kilobajtów<br>";
                    $size /= 1024;
                    echo "Rozmiar: $size megabajtów<br>";
                    $size /= 1024;
                    echo "Rozmiar: $size gigabajtów<br>";
                    break;
                case "file":
                    $size = fileSize($path);
                    echo "Rozmiar: $size bajtów<br>";
                    $size /= 1024;
                    echo "Rozmiar: $size kilobajtów<br>";
                    $size /= 1024;
                    echo "Rozmiar: $size megabajtów<br>";
                    $size /= 1024;
                    echo "Rozmiar: $size gigabajtów<br>";
                    break;
            }
        }
        ?>
    </div>
</div>
</body>
</html>
