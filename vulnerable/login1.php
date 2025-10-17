<?php
error_reporting(0); // Turn off error display for production

$servername = "localhost";
$username = "webuser";
$password = "webpass";
$dbname = "single_login_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $access_code = $_POST['access_code'];
    
    // VULNERABLE: Direct string concatenation - SQL Injection possible
    $sql = "SELECT * FROM users WHERE access_code = '$access_code'";
    $result = $conn->query($sql);
    
    echo "<!DOCTYPE html><html><head><title>Login Result</title>";
    echo "<style>body { font-family: Arial; margin: 40px; background: #f5f5f5; }";
    echo ".container { max-width: 700px; margin: 50px auto; padding: 30px; background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }";
    echo ".success { color: #00b894; } .error { color: #d63031; }";
    echo ".query { background: #f8f9fa; padding: 15px; border-radius: 4px; font-family: monospace; margin: 15px 0; font-size: 14px; }";
    echo ".vulnerable { border: 2px solid #d63031; background: #fff5f5; }";
    echo ".user-list { background: #f1f8e9; padding: 15px; border-radius: 4px; margin: 15px 0; }";
    echo ".user-item { padding: 5px 0; border-bottom: 1px solid #e0e0e0; }";
    echo "a { color: #0984e3; text-decoration: none; } a:hover { text-decoration: underline; }";
    echo "</style></head><body>";
    echo "<div class='container vulnerable'>";
    echo "<h2 style='color: #d63031;'>🔓 Vulnerable Login Result</h2>";
    
    if ($result && $result->num_rows > 0) {
        echo "<h3 class='success'>✅ Login Successful!</h3>";
        echo "<p>Found <strong>" . $result->num_rows . " users</strong> with your query.</p>";
        
        // Display ALL users returned by the query
        echo "<div class='user-list'>";
        echo "<h4>Users Found:</h4>";
        while($row = $result->fetch_assoc()) {
            echo "<div class='user-item'>";
            echo "<strong>User Type:</strong> " . htmlspecialchars($row['user_type']) . " | ";
            echo "<strong>Access Code:</strong> " . htmlspecialchars($row['access_code']);
            echo "</div>";
        }
        echo "</div>";
        
        echo "<p>Your input: <strong>" . htmlspecialchars($access_code) . "</strong></p>";
    } else {
        echo "<h3 class='error'>❌ Login Failed</h3>";
        echo "<p>No users found with that access code.</p>";
    }
    
    echo "<div class='query'>SQL Query: " . htmlspecialchars($sql) . "</div>";
    echo "<a href='/page1.html'>← Back to Login</a>";
    echo "</div></body></html>";
}

$conn->close();
?>
