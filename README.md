`temporary marks`

* Add the content below to file `app/Http/Kernel.php`

```php
protected $routeMiddleware = [
    'params' => \A2htray\GDBMozart\Logic\Middleware\ParamsRule::class,
];
```

* Insert a record to table `mozart_user`

```sql
INSERT INTO mozart_user (
  name, email, email_verified_at, password
) VALUES ('mozart', 'mozart@bgi.com', now(), 'e842795b282293fd61bc294c49edb12b');
```
