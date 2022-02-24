<p align="center"><a href="#" target="_blank"><img src="https://res.cloudinary.com/xxsavage/image/upload/v1645652322/tumblr_pczuh2tk0G1vewxszo1_1280-removebg-preview.png" width="150"></a></p>

## About Petshop API
This project is a test application for a pseudo petshop. The functionality I picked to work
on are:
- **User Endpoints**
  - Login
  - Logout
  - Forgot password
  - Reset password
  - Registration
  - Delete a user
  - Get a single user (The authenticated user)
  - Edit a single user (The authenticated user)
- **Admin Endpoints**
  - Login
  - Logout
  - Registration
  - List users who are not admins
- **Main page endpoints**
  - List all created blog posts
  - Fetch a single blog post
  - Get all created promotions

**Others**
- **Api prefix** `/api/v1/{route_name}`
- **Bearer token authentication.**
  - It contains user_uuid as a claim
  - The issuer is the API server domain `http://127.0.0.1:9300`
  - The implementation makes use of an asymmetric key
- **Middleware protection**
  - Implementation of laravel's default middleware to protect api routes and guard against injection attacks
  - There is also another middleware to protect secure routes, this middleware validates the authenticity of the user token and allow only admin tokens into the administrative side and the user tokens on the user side
- **All listing routes implements pagination and orders in descending order**

## Prerequisites
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
Create a database named "petshop" as it corresponds to what's in the .env file. (Feel free to edit this)
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

### Swagger API documentation URL
```
http://127.0.0.1:9300/api/documentation
```

## Application Logic Structure
- All api routes are in the `routes/api.php` file
- All controllers are in the `app/Http/Controllers` folder
- Single action controllers are made use of.
- Functionalities/Application logic is situated in the `app/Actions` folder, so as to avoid bloating the controller.
- Lcobucci jwt token functionality is located in the `app/Services/JwtService.php` file
- Middlewares are located in the `app/Http/Middleware` folder.
- Custom guards are in the `app/Guards` folder.

_A brief explanation of the logic structure of this application_
> Routes->Controllers->Actions 

---
### Additional Libraries
* darkaonline/l5-swagger
* lcobucci/jwt
* nunomaduro/larastan
* barryvdh/laravel-ide-helper

---
#### darkaonline/l5-swagger
To read more about this libarary, click <a href="https://github.com/DarkaOnLine/L5-Swagger">here</a>
> If you'd like to regenerate docs, run `php artisan l5-swagger:generate`

---
#### lcobucci/jwt
This jwt package like other packages needs private and public keys, the location of which is in the `storage/jwt` folder.
- **Private key name:** `jwtRS256.pem`
- **Public key name:** `jwtRS256.pem.pub`

If you'd like to generate a new private key, run the following command:
```
openssl genrsa -out storage/jwt/jwtRS256.pem 2048
```

If you'd like to generate a new public key that corresponds to your newly created private key, run the following command:
```
openssl rsa -in storage/jwt/jwtRS256.key -pubout -outform PEM -out storage/jwt/jwtRS256.key.pub
```

__The JWT Token issuer is the API server domain, this url is picked from the `.env` file in the root directory.
So, endeavor to set the `APP_URL` to the api of your local server so the JWT Token service pick the right URL.__



---
### Things To Note
> If you decide to make use of a port different from 9300, make sure to change the `APP_URL`
> value in the .env file to avoid a break in code

> Do not forget to run `php artisan config:clear` after modifying the .env file

> There are no web routes apart from that of the swagger api documentation, other urls will
> return an error 404 page same as the UI for buckhill.
> 
> <img src="https://res.cloudinary.com/xxsavage/image/upload/v1645660227/Screenshot_30.png">


