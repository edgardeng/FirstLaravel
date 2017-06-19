## Laravel 环境配置

#### 1、安装composer
```bash
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php -r "if (hash_file('SHA384', 'composer-setup.php') === '669656bab3166a7aff8a7506b8cb2d1c292f042046c5a994c43155c0be6190fa0355160742ab2e1c88d40d5be660b410') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
php composer-setup.php
php -r "unlink('composer-setup.php');"

php composer.phar --version 检查版本
```


#### 1、安装laravel

可以在全局中使用我们在下载的composer移动到bin目录下
mv composer.phar /usr/local/bin/composer

composer global require "laravel/installer"   #全局安装laravel

php composer.phar global require "laravel/installer"

4、 设置 laravel全局 
 
vi ~/.bash_profile   
 
添加 :/User/dengxixi/.composer/vendor/bin

source ~/.bash_profile  

laravel —version 检查版本

laravel new blog  创建项目

7、 脚手架
Laravel 自带了用户注册和认证的脚手架。如果你想要移除这个脚手架，使用 fresh 命令即可：

php artisan fresh


### [php 7 的更新](http://blog.zhoujiping.com/notes/mnmp.html)


安装php7

brew tap homebrew/dupes

brew tap homebrew/php

brew update

brew install php70 --with-debug --with-gmp --with-homebrew-curl --with-homebrew-libressl --with-homebrew-libxml2 --with-homebrew-libxslt --with-imap --with-libmysql --with-mysql  --with-apxs2  --with-apache --with-tidy

echo 'export PATH="$(brew --prefix php70)/bin:$PATH"' >> ~/.zshrc  #for php

echo 'export PATH="$(brew --prefix php70)/sbin:$PATH"' >> ~/.zshrc  #for php-fpm

echo 'export PATH="/usr/local/bin:/usr/local/sbib:$PATH"' >> ~/.zshrc #for other brew install soft

source ~/.zshrc

php -v

### 错误
安装出错configure: error: Cannot find libz

解决办法：$ xcode-select --install

Laravel 出现"RuntimeException inEncrypter.php line 43: The only supported ciphers are AES-128-CBC and AES-256-CBC with the correct key lengths."问题的解决办法

解决办法：

$ cp .env.example .env

$ php artisan key:generate 