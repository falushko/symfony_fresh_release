#!/usr/bin/env bash

BLUE_COLOR="\E[1;34m"

echo -e "${BLUE_COLOR}Updating repositories..."
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update

echo -e "${BLUE_COLOR}Installing mysql..."
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password password root'
sudo debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password root'
sudo apt-get -y install mysql-server &>/dev/null

mysql -uroot -proot <<MYSQL_SCRIPT
use mysql;
create user 'root'@'10.0.2.2' identified by 'root';
grant all privileges on *.* to 'root'@'10.0.2.2' with grant option;
flush privileges;
MYSQL_SCRIPT

sudo sed -i "s/.*bind-address.*/bind-address = 0.0.0.0/" /etc/mysql/my.cnf
sudo /etc/init.d/mysql restart &>/dev/null

echo -e "${BLUE_COLOR}Installing NGINX and PHP-FPM..."
sudo apt-get -y install nginx &>/dev/null
sudo apt-get -y install php7.1-fpm php7.1-mysql php7.1-xml php7.1-curl php7.1-bcmath php7.1-mbstring libcurl3 &>/dev/null
sudo apt-get install git-all &>/dev/null

echo -e "${BLUE_COLOR}Configuring NGINX and PHP-FPM..."
sudo rm -f /etc/nginx/nginx.conf &>/dev/null
sudo cp /vagrant/provision/nginx.conf /etc/nginx/nginx.conf &>/dev/null
sudo sed -i "s/listen = \/run\/php\/php7.1-fpm.sock/listen = 127.0.0.1:7777/g" /etc/php/7.1/fpm/pool.d/www.conf &>/dev/null
sudo service php7.1-fpm restart &>/dev/null
sudo service nginx restart &>/dev/null