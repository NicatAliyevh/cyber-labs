<?php
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $upload_dir = __DIR__ . "/uploads/";

    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0755, true);
    }

    $uploaded_file = $_FILES['file'] ?? null;

    if ($uploaded_file && $uploaded_file['error'] === UPLOAD_ERR_OK) {
        $original_name = $uploaded_file['name'];
        $tmp_path = $uploaded_file['tmp_name'];

        // Extract and normalize extension
        $file_ext = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

        // MIME type from client (unreliable) + PHP check (more reliable)
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime_type = $finfo->file($tmp_path);

        // Define allowed extensions and MIME types
$allowed = [
    'txt' => ['text/plain', 'application/x-empty'],
    'jpg' => ['image/jpeg'],
    'png' => ['image/png', 'image/x-png'],
    'gif' => ['image/gif'],
    'pdf' => ['application/pdf', 'application/octet-stream'], // optional fallback
];
// echo "<pre>";
// echo "Extension: $file_ext\n";
// echo "MIME from finfo: $mime_type\n";
// echo "Expected MIME: " . implode(', ', $allowed[$file_ext] ?? ['N/A']) . "\n";
// echo "</pre>";

// MIME type check
if (
    !array_key_exists($file_ext, $allowed) ||
    !in_array($mime_type, $allowed[$file_ext], true)
) {
    $message = "<p id='message' style='color: red;'>Blocked: Invalid file type.</p>";
}
        // Check: No double extensions
        elseif (preg_match('/\.(php[0-9]?|phar)(\..*)?$/i', $original_name) || substr_count($original_name, '.') > 1) {
            $message = "<p id='message' style='color: red;'>Blocked: Suspicious filename.</p>";
        }
        // Check: No PHP code in file
        elseif (preg_match('/<\?php/i', file_get_contents($tmp_path))) {
            $message = "<p id='message' style='color: red;'>Blocked: PHP code detected inside file.</p>";
        }
        else {
            // Sanitize and randomize filename
            $safe_name = bin2hex(random_bytes(8)) . '.' . $file_ext;
            $target_path = $upload_dir . $safe_name;

            if (move_uploaded_file($tmp_path, $target_path)) {
                $message = "<p id='message' style='color: green;'>File uploaded securely: <a href='/app/file_upload/uploads/"
                    . htmlspecialchars(urlencode($safe_name))
                    . "' target='_blank'>" . htmlspecialchars($safe_name) . "</a></p>";
            } else {
                $message = "<p id='message' style='color: red;'>Upload failed during move.</p>";
            }
        }
    } else {
        $message = "<p id='message' style='color: red;'>No file uploaded or an error occurred.</p>";
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
    <h1>File Upload Lab - Level 3 (Fixed)</h1>
    <?= $message ?>
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
