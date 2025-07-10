<?php
session_start();
session_unset();
session_destroy();
session_start();

$users = [
    'admin' => 'admin123!+hard',
    'user'  => 'user123'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (isset($users[$username]) && $users[$username] === $password) {
        // ✅ Authentication confirmed
        $_SESSION['username']   = $username;
        $_SESSION['role']       = ($username === 'admin') ? 'admin' : 'user';
        $_SESSION['auth_token'] = 'login!!!!hard'; // ✅ Hardcoded flag

        $redirect = ($username === 'admin') ? '/bac/fixed/admin' : '/bac/fixed/user';
        header("Location: $redirect");
        exit;
    } else {
        $error = "❌ Invalid credentials.";
    }
}
?>


<form method="POST" style="max-width: 300px; margin: 50px auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; background-color: #f9f9f9;">
    <h2 style="text-align: center; font-family: Arial, sans-serif;">Login</h2>
    
    <input 
        type="text" 
        name="username" 
        placeholder="Username" 
        style="width: 100%; padding: 10px; margin-bottom: 10px; border-radius: 5px; border: 1px solid #ccc;"
    >
    
    <input 
        type="text" 
        name="password" 
        placeholder="Password" 
        style="width: 100%; padding: 10px; margin-bottom: 15px; border-radius: 5px; border: 1px solid #ccc;"
    >
    
    <button 
        type="submit" 
        style="width: 100%; padding: 10px; background-color: #4CAF50; color: white; border: none; border-radius: 5px; font-weight: bold; cursor: pointer;"
    >
        Login
    </button>
</form>
<!-- Credentials for the test user ===> user:user123 -->
<?php if (!empty($error)): ?>
    <p id="login-error" style="color:red;"><?= $error ?></p>
    <script>
        setTimeout(() => {
            const errorEl = document.getElementById('login-error');
            if (errorEl) errorEl.style.display = 'none';
        }, 3000); 
    </script>
<?php endif; ?>
