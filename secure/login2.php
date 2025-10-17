<?php
// SECURE LOGIN SCRIPT - Single input field with prepared statements
error_reporting(0);

$servername = "localhost";
$username = "webuser";
$password = "webpass";
$dbname = "single_login_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $access_code = $_POST['access_code'];
    
    // SECURE - Using prepared statement
    $stmt = $conn->prepare("SELECT * FROM users WHERE access_code = ?");
    $stmt->bind_param("s", $access_code);
    $stmt->execute();
    $result = $stmt->get_result();
    
    echo "<!DOCTYPE html>
    <html>
    <head>
        <title>Login Result</title>
        <style>
            body { 
                font-family: Arial, sans-serif; 
                margin: 40px; 
                background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
                min-height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
            }
            .result-container { 
                background: white; 
                padding: 30px; 
                border-radius: 10px; 
                box-shadow: 0 15px 35px rgba(0,0,0,0.1);
                text-align: center;
                max-width: 500px;
            }
            .success { color: #28a745; font-size: 24px; margin-bottom: 20px; }
            .error { color: #dc3545; font-size: 24px; margin-bottom: 20px; }
            .security-badge {
                background: #28a745;
                color: white;
                padding: 5px 10px;
                border-radius: 5px;
                font-size: 12px;
                margin-bottom: 15px;
                display: inline-block;
            }
            .btn { 
                display: inline-block; 
                padding: 10px 20px; 
                background: #28a745; 
                color: white; 
                text-decoration: none; 
                border-radius: 5px; 
                margin-top: 15px;
            }
        </style>
    </head>
    <body>
        <div class='result-container'>
            <div class='security-badge'>SECURE LOGIN</div>";
    
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        echo "<div class='success'>✅ Access Granted!</div>";
        echo "<p>Welcome <strong>" . htmlspecialchars($user['user_type']) . "</strong></p>";
        echo "<p>Access code verified successfully.</p>";
    } else {
        echo "<div class='error'>❌ Access Denied!</div>";
        echo "<p>Invalid access code or security violation detected.</p>";
    }
    
    echo "<p><small>This system is protected against SQL injection attacks</small></p>";
    echo "<a href='/page2.html' class='btn'>Try Again</a>";
    echo "</div></body></html>";
    
    $stmt->close();
}

$conn->close();
?>
