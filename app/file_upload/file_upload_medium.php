<?php
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $upload_dir = __DIR__ . "/uploads/";

    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $uploaded_file = $_FILES['file'] ?? null;

    if ($uploaded_file && $uploaded_file['error'] === UPLOAD_ERR_OK) {
        $filename = basename($uploaded_file['name']);
        $target_path = $upload_dir . $filename;

        $blacklisted_extensions = ['php', 'php2', 'php3', 'php4', 'php5', 'phar'];
        $file_ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (in_array($file_ext, $blacklisted_extensions)) {
            $message = "<p id='message' style='color: red;'>Upload blocked: .$file_ext files are not allowed.</p>";
        } else {
            if (move_uploaded_file($uploaded_file['tmp_name'], $target_path)) {
                $message = "<p id='message' style='color: green;'>File uploaded successfully: <a href='/app/file_upload/uploads/" 
                    . htmlspecialchars(urlencode($filename)) 
                    . "' target='_blank'>" . htmlspecialchars($filename) . "</a></p>";
            } else {
                $message = "<p id='message' style='color: red;'>Failed to upload file.</p>";
            }
        }
    } else {
        $message = "<p id='message' style='color: red;'>No file uploaded or error occurred.</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>File Upload Lab - Level 2</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 40px;
            max-width: 500px;
            margin: auto;
        }
        h1 {
            color: #007acc;
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        input[type="file"] {
            padding: 10px;
        }
        input[type="submit"] {
            background-color: #007acc;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #005b99;
        }
        p {
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>File Upload Lab - Level 2 (Extensions Blocked)</h1>
    <?= htmlspecialchars($message) ?>
    <form method="post" enctype="multipart/form-data">
        <label>Select a file to upload:</label>
        <input type="file" name="file" required />
        <input type="submit" value="Upload" />
    </form>

    <script>
        setTimeout(() => {
            const message = document.getElementById('message');
            if (message) {
                message.style.display = 'none';
            }
        }, 4000); 
    </script>
</body>
</html>
