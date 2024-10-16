# Coffee Cup &middot; Laravel 10 + Vue3

### How to setup project after cloning

<span style="font-size: 16px">

1. Install composer packages
```bash
composer update
```
```bash
composer install
```
2. Install npm packages
```bash
npm install
````
3. Create .env file in root directory<br><br>
4. Generate app key
```bash
php artisan key:generate
```
5. Generate JWT secret
```bash
php artisan jwt:secret
```
6. Fill all marked .env fields<br><br>
7. Run migrations
```bash
php artisan migrate
```
8. Run laravel server
```bash
php artisan serve
```
9. Run vite server
```bash
npm run dev
```
10. Run queue (if needed)
```bash
php artisan queue:work
```
11. All done! <br> Now go to http://localhost:8000/

</span>
