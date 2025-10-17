
Detailed Setup Guide
Step 1: Launch EC2 Instance
AWS EC2 t3.micro

Amazon Linux 2023 AMI

Security Groups: SSH (22), HTTP (80)

Step 2: Install Dependencies
bash
sudo dnf update -y
sudo dnf install nginx php php-fpm php-mysqli mariadb105-server git -y
Step 3: Configure Services
bash
# Start and enable services
sudo systemctl start php-fpm
sudo systemctl enable php-fpm
sudo systemctl start mariadb
sudo systemctl enable mariadb
sudo systemctl start nginx
sudo systemctl enable nginx
Step 4: Database Setup
bash
sudo mysql_secure_installation
sudo mysql -u root -p < database/database_setup.sql
Step 5: Deploy Application
bash
# Copy web files
sudo cp vulnerable/* secure/* /usr/share/nginx/html/

# Set permissions
sudo chown -R nginx:nginx /usr/share/nginx/html/
Step 6: Test Application
Access in browser:

http://your-ip/page1.html (Vulnerable)

http://your-ip/page2.html (Secure)
