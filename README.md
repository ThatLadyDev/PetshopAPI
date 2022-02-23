<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://res.cloudinary.com/xxsavage/image/upload/v1645652322/tumblr_pczuh2tk0G1vewxszo1_1280-removebg-preview.png" width="80"></a></p>

## About Petshop API

### Prerequisites
- **Composer**
- **Xampp or its equivalent**

## Project setup
```
composer install
```

### Copy the .env.example file to create a .env file
```
cp .env.example .env
```

### Generate app key
```
php artisan key:generate
```

### Database creation

```
Create a database named "petshop" as it corresponds to what's 
in the .env file. (Feel free to edit this)
```

### Migrate database tables
```
php artisan migrate
```

### Serve the application
```
php artisan serve --port 9300
```

_The above command serves your application in the port 9300, 
feel free to change this to any port of your choosing_

---
### Additional Libraries
* darkaonline/l5-swagger
* lcobucci/jwt
* nunomaduro/larastan
* barryvdh/laravel-ide-helper

#### darkaonline/l5-swagger
To read more about this libarary, click <a href="https://github.com/DarkaOnLine/L5-Swagger">here</a>
> If you'd like to regenerate docs, run `php artisan l5-swagger:generate`


---
### Things To Note
> If you decide to make use of a port different from 9300, make sure to change the `APP_URL`
> value in the .env file to avoid a break in code

> Do not forget to run `php artisan config:clear` after modifying the .env file


