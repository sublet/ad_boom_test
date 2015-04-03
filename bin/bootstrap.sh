#!/usr/bin/env bash

# debconf-set-selections <<< 'mysql-server-<version> mysql-server/root_password password password'
# debconf-set-selections <<< 'mysql-server-<version> mysql-server/root_password_again password password'
# debconf-set-selections <<< 'phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2'
# debconf-set-selections <<< 'phpmyadmin phpmyadmin/dbconfig-install boolean true'
# debconf-set-selections <<< 'phpmyadmin phpmyadmin/app-password-confirm password'
# debconf-set-selections <<< 'phpmyadmin phpmyadmin/mysql/app-pass password'
# debconf-set-selections <<< 'phpmyadmin phpmyadmin/mysql/admin-pass password password'

apt-get update
apt-get install -y apache2
apt-get install php5 -y
apt-get install libapache2-mod-php5 -y
apt-get install php5-cli -y
apt-get install php-pear php5-dev -y
apt-get install curl libcurl3 libcurl3-dev php5-curl -y
apt-get install build-essential -y
# apt-get install mysql-server mysql-client -y
# apt-get install php5-mysql -y
# apt-get install phpmyadmin -y

if [ ! -h /var/www ]; 
then 
    rm -rf /var/www sudo 
    ln -s /vagrant /var/www

    a2enmod rewrite

    sed -i '/AllowOverride None/c AllowOverride All' /etc/apache2/sites-available/default

fi

service apache2 restart

# Setup Database
# mysql -u root -ppassword -e "CREATE DATABASE npr_wordpress;"
# mysql -u root -ppassword -e "CREATE USER 'npr_user'@'localhost' IDENTIFIED BY 'adeagj9j890gsadsijsd;'"
# mysql -u root -ppassword -e "GRANT ALL PRIVILEGES ON *.* TO 'npr_user'@'localhost';"
# mysql -u root -ppassword -e "FLUSH PRIVILEGES;"
# mysql -u root -ppassword npr_wordpress < /var/www/bin/npr_wordpress.sql