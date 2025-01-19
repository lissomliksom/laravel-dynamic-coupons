A small demo project. Lookup an email-address, and display an appropriate coupon-offer.

## Installation

Make sure you have php, composer and node setup on your computer.
[Laravel Docs: Installing PHP](https://laravel.com/docs/11.x#installing-php)
[NodeJS: Download](https://nodejs.org/en/download)

```bash
# clone repository
git clone https://github.com/lissomliksom/laravel-dynamic-coupons.git

# navigate to the project directory
cd laravel-dynamic-coupons

# copy .env.example to .env
cp .env.example .env

# install and build Node-dependencies
npm install
npm run build

# install and build Composer-dependencies
composer install

# run migrations (if applicable)
php artisan migrate

# run the development server
composer run dev
```

Note: Depending on your use of [Laravel Herd](https://herd.laravel.com/), [Laravel Valet](https://laravel.com/docs/11.x/valet) or [Xammp](https://www.apachefriends.org/download.html), minor variations might apply.

### Troubleshooting

If you run into issues running on localhost:8000, find your `php.ini` and change variables_order from EPGPCS to GPCS:
`variables_order = "GPCS"`

The location of `php.ini` can vary based on your development setup (Herd, Valet, Xampp). Run `php --ini` in your terminal to find the most probable location.

If you run into issues with your database, copy `.env.example` into a new `.env` file, and set `SESSION_DRIVER=file`.

If you run into issues with your application encryption key, set `APP_KEY=base64:ow9bOVUBIR0idI477q8aDLReTx/G0ombqBYXAq42O6o=`.
