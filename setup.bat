composer update -W
composer install
copy .\.env.example .env
php artisan key:generate
echo "Done. Exiting...."