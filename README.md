<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

### WeatherLord Setup ###

### getting the source code ###
download zip file from repo
move zip file into /home directory
unzip to folder named "WeatherLordApp"

### environment setup linux commands from /home/WeatherLordApp/ ###
sudo add-apt-repository ppa:ondrej/php
sudo apt update
sudo apt install php8.0 libapache2-mod-php8.0 
sudo apt-get install php php-bcmath php-common php-json php-mbstring php-mysql php-xml php-zip curl php-curl openssl
composer global require laravel/installer
composer update
sudo apt install mysql-client-core-8.0
sudo apt-get install mysql-server
sudo mysqld
sudo mysql_secure_installation

### MYSQL database setup ###
Answer the following questions accordingly:
	VALIDATE PASSWORD COMPONENT: N
	set new root password: mypass (or anything you want, just don't forget it)
	REMOVE ANONYMOUS USERS: Y
	DISALLOW ROOT LOGIN REMOTELY: N
	REMOVE TEST DATABASE: Y
	RELOAD PRIVILEGE TABLES: Y
sudo mysql -u root -p 
in the mysql prompt type: 
	create database weatherdb;
	CREATE USER weather@localhost IDENTIFIED BY 'passpass';
	grant all privileges on *.* to weather@localhost with grant option;

### the .env file ###
copy the .env.example file and rename the copy as .env
the following API keys must be obtained and placed in the .env near the bottom of the file.
the OPEN_WEATHER_MAP_KEY= value can be obtained by creating a free account at https://openweathermap.org/
the MAPBOX_TOKEN= value can be obtained by creating a free account at https://www.mapbox.com/

### final website setup linux commands from /home/WeatherLordApp/ ###
php artisan key:generate
php artisan migrate
php artisan serve

Now open a browser and in localhost:8000 will be the website WeatherLord!!!


### Features ###
Upon a users first visit they will have their local weather displayed on their screen.
	To do this I used the stevebauman/location package to collect their latitude and longitude based on their ip address. Then I used the openweathermap api to get the weather information for that location and display it automatically upon form load.
User's can search for weather from any location in the world - and can see mulitple locations on their screen.
	I chose to integrate mapbox geocoding to take user input to search for locations and get their latitude and longitude.	
	I used that information to collect current and forecasted weather information from openweathermap's "onecall" api.
	
In order to save locations a logged in used must click on the floppy disk save icon in the bottom left of the weather location row to save. Locations he hasn't saved will be lost after logout.
	I used Laravel's built in AUTH login and registration protocols to handle all of this.	
a user can delete a weather row from their account by simply pressing the trash can icon in the top left.

### Technology Used ###
Ubuntu 20.04
    The best environment to develop and deploy websites with.
Laravel Framework 8.0
	I used The Laravel framework with php not because it best showcased my skills. This was the first website I have built using laravel and php. My other three websites I have made were all in ASP.net. However, that didn't seem to be impressive enough.
mysql 2.7
	I chose mysql for my database since it integrated so well with Laravel Forge databases.
Mabbox API
	mapbox was free to use and since it allowed 50,000 calls a day,  I decided that reaching that threshold would be unlikely.
Openweathermap API
	compared to other weather api's openweathermap had the most generous policy for free users and their "onecall" provided a TON of information if you could get them the latitude and longitude.
stevebauman/location package
	An awesome free tool which uses an IP address to get a relatively accurate location.

## Development Environment ###
Ubuntu 20.04 on WSL 2
	This environment made the most sense and was recommended on the Laravel 8.0 documentation. Using this I didn't need to dual boot my computer with Ubuntu.
VS Code
	I have never used this editor before, but since it integrates so well into WSL, Ubuntu, and GIT and even had database tools, it worked great.
GitHub

### Deployment ###
Control Panel: Laravel Forge
Remote Server: Digital Ocean Droplet
	This deployment method was fast and professional. I appreciate all the tools which help a user deploy and keep a website updated.


## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[CMS Max](https://www.cmsmax.com/)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**
- **[Romega Software](https://romegasoftware.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
