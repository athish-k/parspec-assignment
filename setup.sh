#!/bin/bash
echo "=========================================="
echo "   Parspec Assignment Setup Script"
echo "=========================================="

# Install packages
echo "[1/5] Installing packages..."
sudo dnf update -y
sudo dnf install nginx php php-fpm php-mysqli mariadb105-server -y

# Start services
echo "[2/5] Starting services..."
sudo systemctl start php-fpm
sudo systemctl enable php-fpm
sudo systemctl start mariadb
sudo systemctl enable mariadb
sudo systemctl start nginx
sudo systemctl enable nginx

# Setup database
echo "[3/5] Setting up database..."
read -s -p "Enter MySQL root password: " mysql_password
echo
sudo mysql -u root -p$mysql_password < database/database_setup.sql

# Deploy application
echo "[4/5] Deploying application..."
sudo cp vulnerable/page1.html vulnerable/login1.php /usr/share/nginx/html/
sudo cp secure/page2.html secure/login2.php /usr/share/nginx/html/

# Set permissions
echo "[5/5] Setting permissions..."
sudo chown -R nginx:nginx /usr/share/nginx/html/
sudo chmod -R 755 /usr/share/nginx/html/

echo "=========================================="
echo "           Setup Complete!"
echo "=========================================="
echo "Access your application:"
echo "🔓 Vulnerable: http://$(curl -s http://169.254.169.254/latest/meta-data/public-ipv4)/page1.html"
echo "🔒 Secure: http://$(curl -s http://169.254.169.254/latest/meta-data/public-ipv4)/page2.html"
echo ""
echo "Test SQL Injection:"
echo "Payload: ' OR '1'='1' -- "
echo "=========================================="
