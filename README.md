# EnvX Virtual Products Base

## Local Setup
#### Project setup
```
composer install && npm install
valet link && valet db create (IF USING VALET)
cp .env.example .env (SEE ENV SETUP)
php artisan key:gen
php artisan migrate --seed
npm run build
```
> To change product type, change the envx.product-type config value.

#### Env setup
```
APP_URL=http://my-local-domain.test
APP_DEBUG=true

DB_DATABASE=(YOUR DB NAME)
DB_USERNAME=(YOUR DB USERNAME, USUALLY root)
DB_PASSWORD=(YOUR DB PASSWORD, USUALLY root)

QUEUE_CONNECTION=sync

SESSION_SECURE_COOKIE=false
```

## Live Setup
#### Requirements
* Queues must be setup and listening to the defaults set in the envx config.
* ADFS is required for initial access of the admin area on dev/prod sites. 
    - The callback url is /admin/callback. 
    - No additional claims are required.
* There must be an email set up to email created admins their password setup email.
* The following values need to be correctly set for the site to work.
```
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=

MIX_PUSHER_APP_HOST=
```

#### Logging in
* To login as a user, head to '/'
* To login as an admin, head to '/admin'
* Logging in as an admin locally can be done by running the command `php artisan envx:make:admin`.
* Logging in as an admin on dev/live sites can be done through the ADFS method provided with the base, provided this has been setup for you.
