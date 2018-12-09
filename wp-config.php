<?php
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define('DB_NAME', 'tmdt-ict');

/** Username của database */
define('DB_USER', 'root');

/** Mật khẩu của database */
define('DB_PASSWORD', '');

/** Hostname của database */
define('DB_HOST', 'localhost');

/** Database charset sử dụng để tạo bảng database. */
define('DB_CHARSET', 'utf8mb4');

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '=7%E]N#v{XA4UqOYuXPp:j*GVgCJ>uE<=6S81<:{B!@U~+eO=N0b!CG,GZ&!l!=Q');
define('SECURE_AUTH_KEY',  '=$>NYJxcI/$,y^ U`IUiA+aDPte=U*wh[f;^$K4(b*K?[IR86%F2JT2*8J&WD^8N');
define('LOGGED_IN_KEY',    ';e/Mq+3#YEm0>gs?z_i|7k$,16^75G{WKa`^b!GjM!zNKc$J1%_[=kfY2vjAP>n)');
define('NONCE_KEY',        '+  %dADc/++F: -A{a(^!Kx6$kyQE!MKz,gRTm2*Z9A(Ab6(PqR{Y#!0oOQ5R,<d');
define('AUTH_SALT',        '#,U()[PW5BGC`VwH*F&zhM!bEF{>_5g+xz.kw+$wEn5I4HRP]dr:}Vq(|0qK>s{i');
define('SECURE_AUTH_SALT', 'w*r_V??rYni)o2=L?qC=T|:u;sL go${W)RpaAiI,8-t+.y2c.?kkskO|6<T0+KF');
define('LOGGED_IN_SALT',   '7TBEe5Dy&@i(]}#sD;wGJ}|Zu-! 1(%qeWYt(ENZ,~&[>URxdW]T2i,*<[GK^.Jq');
define('NONCE_SALT',       'Lzo@$DBJESewkZVxt>OsYl03K`]haF(Tb^/X.zf?xB?;#H3ar0He=s~*9V[AEn(<');

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix  = 'wp_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
