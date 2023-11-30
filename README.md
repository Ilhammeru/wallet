<h3 align="center">Averin Test</h3>

## Package or Features

This application is using laravel 10.xx.

Some the packages used are:

- [Spatie Permission](https://spatie.be/docs/laravel-permission/v5/introduction)
- [Laravel Hashids](https://github.com/vinkla/laravel-hashids)
- [Laravel sanctum for authentication](https://laravel.com/docs/10.x/sanctum)

This API using Controller - Service - Repositories boilerplate that can be generate by our own command 
<code>php artisan make:crud {className}</code> written in CamelCase style.

Here some explaination about boilerplate that we used in this app.

    - Controller
    Controller is used to sanitize all request and validate request by form request in \App\Http\Request folder.
    
    - Service
    All logic about application should run in this section
    
    - Repositories
    Repositories just used to communicate with the database

Responses use a predefined format so that all API responses will remain the same. You can check in \App\Http\Controllers\Controller.php.

## How to install to local environment

To setup this app in local environment please follow this instuction

- Clone from this url https://github.com/Ilhammeru/wallet.git
- Install all requirement package by running <code>composer install</code>
- Create new .env file by copy from the example by running <code>cp .env.example .env</code>
- Complete the database configuration according to what you have
- Running migration and seeder <code>php artisan migrate --seed</code>

Now it should be accessible in your local environment.

Those seeders is also create a default admin account that can be used to access protected routes. Here the credential detail 
- username: admin
- password: password

## How to run in postman

After installation is successfull, you can open postman to see the collections and do some request to the app. I'll attach postman collections and environment by email. To accomplish this, please follow this step:

- Import postman collection to your own
- Import or create new environment based on file that i send to you
- Replace **url** variable with your own app url
- For **token** url leave it empty. It will automatic set when login is successful

Now if you hit any request in **Features/Packages/Users** folder, it will return authentication error. You need to login using credential above to see the success response.

To login and get the token, you can go to login request that placed in **Authorization** folder. User credential above. Then send the request. If success token will automatically assign as variable.

Finally, you can hit any request in all folders.
