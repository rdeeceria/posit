# POSIT - Point Of Sale Information Technology
## sebuah pembelajaran aplikasi menggunakan codeigniter 4 dan AdminLTE 3
Versi lain dari tutorial ilmucoding. dan masih bisa dikembangkan lagi..<br/>

Ini baru awalan, setidak'y ada 20% dari fitur codeigniter yang di ekspose dsini, dan masih 80% lagi fitur yang belum di ekspose. `Wadidaw Si LEGEND Ini`. Mari sama2 belajar.

### Fitur:
1. layout
2. validation
3. middleware, filters, REST
3. modals, toast, chart
4. upload, download
5. dsb..

### Tahap penggunaan:
1. install composer [setup-windows](https://getcomposer.org/Composer-Setup.exe)
2. fork repo, download zip code
3. ketik command `composer install`
4. buat database: `posit`
```sql
CREATE DATABASE IF NOT EXISTS `posit` CHARACTER SET utf8 COLLATE utf8_general_ci;
```
5. edit app / config `Rekomendasi gunakanlah vhost`
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
		'port'     => 3306,
	];
```
7. ketik command <br/>
```cli
php spark migrate
php spark db:seed Admin
php spark serve
```

8. buka browser `http://localhost:8080`

Untuk login:<br/>
`username` admin@example.com<br/>
`password` admin123<br/>

Credits To: [wildanfuady - ilmucoding.com](https://github.com/wildanfuady/ci4_sip/)