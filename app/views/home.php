<?php
echo "
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
        color: #333;
        margin: 0;
        padding: 0;
    }
    .about-link {
        position: absolute;
        top: 20px;
        left: 20px;
        background-color: #ffefd5;
        border: 2px solid #ff9900;
        border-radius: 5px;
        padding: 10px 15px;
        text-decoration: none;
        color: #cc6600;
        font-weight: bold;
        transition: background-color 0.3s;
    }
    .about-link:hover {
        background-color: #ffe0b3;
    }
    h1 {
        color: #007acc;
        text-align: center;
        margin-top: 80px;
    }
    p {
        text-align: center;
        font-size: 18px;
    }
    ul {
        list-style-type: none;
        padding: 0;
        max-width: 400px;
        margin: 30px auto;
    }
    li {
        background-color: #fff;
        margin: 10px 0;
        border-radius: 5px;
        transition: background-color 0.3s;
    }
    li a {
        display: block;
        padding: 15px;
        text-decoration: none;
        color: #007acc;
        font-weight: bold;
    }
    li:hover {
        background-color: #e6f7ff;
    }
</style>
";

echo "<a href='/about' class='about-link'>About</a>";

echo "<h1>Welcome to the Web Security Labs</h1>";
echo "<p>Select a lab to get started:</p>";

echo "<ul>";
echo "<li><a href='/sql'>SQL Injection</a></li>";
echo "<li><a href='/xss'>XSS</a></li>";
echo "<li><a href='/broken_access_control'>Broken Access Control</a></li>";
echo "<li><a href='/command_injection'>Command Injection</a></li>";
echo "<li><a href='/file_upload'>File Upload Vulnerabilities</a></li>";
echo "</ul>";
?>
