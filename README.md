# Parspec Assignment - SQL Injection Demonstration

## 📋 Assignment Overview
This project demonstrates SQL injection vulnerabilities and their mitigation through two login forms with single input fields, deployed on an AWS EC2 instance.

## 🌐 Live Demo
- **🔓 Vulnerable Form (SQL Injection Works)**: http://65.2.74.42/page1.html
- **🔒 Secure Form (SQL Injection Blocked)**: http://65.2.74.42/page2.html

## 🎯 Features Implemented
- ✅ EC2 instance with Nginx web server
- ✅ Single input field login forms
- ✅ SQL injection vulnerable implementation
- ✅ SQL injection protected implementation
- ✅ MySQL database integration
- ✅ Step-by-step documentation

## 🚨 SQL Injection Demonstration

### Vulnerable Page
- **File**: `vulnerable/page1.html` + `vulnerable/login1.php`
- **Status**: Exploitable via SQL Injection
- **Test Payload**: `' OR '1'='1' -- ` (with trailing space)
- **Result**: Returns ALL 4 users from database
- **Vulnerability**: Direct string concatenation in SQL query

### Secure Page
- **File**: `secure/page2.html` + `secure/login2.php`
- **Status**: Protected against SQL Injection
- **Test Payload**: `' OR '1'='1' -- ` (with trailing space)
- **Result**: Security violation detected and blocked
- **Protection**: Input validation + Prepared statements

## 📁 Project Structure
parspec-assignment/
├── vulnerable/ # Exploitable SQL injection forms
│ ├── page1.html # Vulnerable login form
│ └── login1.php # Vulnerable backend (SQLi possible)
├── secure/ # Protected forms
│ ├── page2.html # Secure login form
│ └── login2.php # Secure backend (SQLi protected)
├── config/ # Server configurations
│ ├── nginx.conf # Nginx configuration
│ └── www.conf # PHP-FPM configuration
├── database/ # Database setup
│ └── database_setup.sql # Database schema and data
├── docs/ # Documentation
│ └── SETUP_GUIDE.md # Detailed setup instructions
├── setup.sh # Automated setup script
└── README.md # This file

text

## 🚀 Quick Start
```bash
# 1. Clone the repository
git clone https://github.com/YOUR_USERNAME/parspec-assignment.git
cd parspec-assignment

# 2. Run setup script
chmod +x setup.sh
sudo ./setup.sh

# 3. Access the application
# Vulnerable: http://your-server-ip/page1.html
# Secure: http://your-server-ip/page2.html
🧪 Testing Commands
bash
# Test SQL injection on vulnerable page
curl -X POST http://localhost/login1.php -d "access_code=' OR '1'='1' -- "

# Test valid login on vulnerable page
curl -X POST http://localhost/login1.php -d "access_code=admin123"

# Test SQL injection on secure page (blocked)
curl -X POST http://localhost/login2.php -d "access_code=' OR '1'='1' -- "

# Test valid login on secure page
curl -X POST http://localhost/login2.php -d "access_code=admin123"
🛡️ Security Measures Implemented
Input Validation: Regex patterns to detect SQL keywords

Prepared Statements: Parameterized queries to prevent injection

Error Handling: Custom error pages without information disclosure

Security Headers: Additional protection headers

💻 Technologies Used
Amazon Linux 2023

Nginx 1.28.0

PHP 8.0

MySQL 8.0

PHP-FPM

✅ Assignment Requirements Checklist
Spin up EC2 instance and install Nginx

Create login form with 1 input field & submit button

Form exploitable via SQL injection attack

Mitigate SQL injection attack using security controls

Provide IP addresses of both forms

Create step-by-step guide

Share via GitHub repository
