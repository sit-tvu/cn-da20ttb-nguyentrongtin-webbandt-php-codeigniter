Lưu ý: chạy php 7 chấm nha, chạy cũ lỗi, chạy mới lỗi đó. Còn ver Codeigniter là bản Codeigniter 3 nha.
<br>
https://github.com/UIT-web-project/WebProject
<br>
requirement: https://drive.google.com/drive/folders/17Mk0dAOZ3Jtb7pWK3eCmssBDa_v9Y32N?usp=sharing
> last update: 2/12 (huuthang201).
> 
> last update ***config***: 10PM 15/11 (huuthang201)

!Note:
- SanPhamController.php line 35: edit base url
- ..
- 

# chạy thử web
### B1
- tải CodeIgniter: https://github.com/bcit-ci/CodeIgniter
- mở folder *application*
### B2
#### m.n clone repo về, lấy các folder paste vô *application*:
* *config*
* *controllers*
* *model*
* *view*
### B3: cấu hình database
mở config/database.php rồi tìm đến đoạn dưới và cấu hình lại cho đúng rồi chạy:
```
$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => 'root',
	'password' => '',
	'database' => 'web_app',
	'dbdriver' => 'mysqli',
	'dbprefix' => '',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);
```
### B4: cấu hình url
mở config/config.php chỉnh lại cho đúng location folder
```
$config['base_url'] = 'http://localhost/do_an_web_thu_2/';
```
