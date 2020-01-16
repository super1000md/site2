<?php /**
 * WordStar Functions file
 *
 * @category WordPress
 * @package  WordStar
 * @author   Linesh Jose <lineshjos@gmail.com>
 * @license  http://www.gnu.org/copyleft/gpl.html GNU General Public License
 * @link     https://linesh.com/projects/wordstar/
 *
 */
require get_template_directory() . '/inc/funtions.php';
require get_template_directory() . '/inc/actions.php';
require get_template_directory() . '/inc/filters.php';






// 文末插入的内容
function zm_content_insert( $return = 0 ) {// 插入的内容
	$str.= "<div class='same'>";
	$str.= "请符可加师傅微信号：taijifuzhou，";	
	$str.= "<a href='http://192.168.0.100:8080/wordpress/wp-content/uploads/2020/01/201912261577325876208902.jpg' >二维码</a>。";	
	$str.= "</div>";
	if ($return) { return $str; } else { echo $str; }
}
function zm_content_filter($content) {
	if(!is_feed() && !is_home() && is_singular() && is_main_query()) {
		$content .= zm_content_insert(1);// 0在正文上面
		//$content .= zm_content_insert(1);//1在正文下面
	}
	return $content;
}
add_filter('the_content','zm_content_filter');
// 文末插入的内容




?>