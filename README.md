# POSIT - Point Of Sale Information Technology
## contoh app menggunakan codeigniter 4 dan AdminLTE 3?
Tahap penggunaan:
1. install composer [setup-windows](https://getcomposer.org/Composer-Setup.exe)
2. fork repo, download zip code
3. ketik command `composer install`
4. buat database baru: `posit`
```sql
CREATE DATABASE IF NOT EXISTS `posit` CHARACTER SET utf8 COLLATE utf8_general_ci;
```
5. edit app / config
```php
public $baseURL = 'http://localhost:8080'; //Untuk penggunaan php spark serve
```
6. edit app / database
```php
public $default = [
		'hostname' => 'localhost',
		'username' => 'root',
		'password' => '',
		'database' => 'posit',
		'DBDriver' => 'MySQLi',
		'DBDebug'  => (ENVIRONMENT !== 'development'), //development, testing, production
		'port'     => 3306,
	];
```
7. ketik command `php spark migrate` `php spark db:seed Admin` `php spark serve`
8. buka browser `http://localhost:8080`

Untuk login:<br/>
`username` admin@example.com<br/>
`password` admin123<br/>

Credits To: [wildanfuady - ilmucoding.com](https://github.com/wildanfuady/ci4_sip/)