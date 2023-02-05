# tyrell-test
 
steps to run:-

copy .env.example into new file .env

composer install
composer dump-autoload
php artisan optimize

npm install
npm run watch --hot or npm run prod


file to refer:-
1.php
    App\Http\Controllers\Api\Players\PlayerGiveCardController
    
2. javascript (vue)
    resources\js\pages\players
    resources\js\stores\player.js (pinia)
