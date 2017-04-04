A Laravel mail driver for mymsg.pw  
Install via composer:  
```composer require it-poet/mymsg-laravel-mail```  
Add the service provider to your app.php config file:  
```php
// Laravel 5: config/app.php

'providers' => [
    ...
    ItPoet\MymsgLaravelMail\MymsgMailServiceProvider::class,
    ...
];
``` 
 Then publish the config file:
```php
php artisan vendor:publish --provider="ItPoet\MymsgLaravelMail\MymsgMailServiceProvider"
```  
Get your API key here [mymsg.pw](https://mymsg.pw/api).  
In .env:  
```
MAIL_DRIVER=mymsgmail
MYMSG_API_KEY=your_api_key
```