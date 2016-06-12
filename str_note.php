<?php
//================================= strpos ==================================/
// 返回首次出现的位置
// 返回第一个匹配的位置 找不到则返回false
var_dump(strpos('abcdefg', 'z'));
// 从第四个位置之后开始查找  即第五个位置
var_dump(strpos('abcdefg', 'd', 4));
// 偏移量不能是负数
var_dump(strpos('abcdefg', 'd', -2));  // output -2
// stripos() 不区分大小写
//================================= strrpos ==================================/
// 指定字符串在目标字符串中最后一次出现的位置
// 字符串固定位置一样 指示总尾部还是首部开始查找
// 尾部的时候 会过滤开始之后的字符串
$foo = "0123456089a123456789b123456789c";
var_dump(strrpos($foo, '7', -5));  // 从尾部第 5 个位置开始查找
// 结果: int(17)
var_dump(strrpos($foo, '7', 20));  // 从第 20 个位置开始查找
// 结果: int(27)
var_dump(strrpos($foo, '7', 28));  // 结果: bool(false)
// strripos 不去分大小写
//================================= strrchr ==================================/
//查找指定字符在字符串中的最后一次出现的的字符串即 之后的字符串
$path = '/www/public_html/index.html';
$filename = (strrchr($path, 'index')); // olutput : /index.html
echo $filename;
$text = "Line 1\nLine 2xLine 3";
$last = strrchr($text, 10); // 获取最后一行的字符串
var_dump($last);
//================================= strstr ==================================/
$email  = 'name@example.com';
$domain = strstr($email, '@');  // 获取匹配含匹配之后的字符串
echo $domain; // 打印 @example.com
$user = strstr($email, '@', true); // 从 PHP 5.3.0 起  获取含匹配之前的字符串(不含匹配的)
echo $user; // 打印 name
// stristr 不区分大小写
//================================= substr ==================================/
// 第二个参数 位置 第三个参数 + 截取的个数
$rest = substr("abcdef", -1);    // 返回 "f"
$rest = substr("abcdef", -2);    // 返回 "ef"
$rest = substr("abcdef", -3, 1); // 返回 "d"
// 如果是负数 则 表示 截取的末尾
$rest = substr("abcdef", 0, -1);  // 返回 "abcde"
$rest = substr("abcdef", 2, -1);  // 返回 "cde"
$rest = substr("abcdef", 4, -4);  // 返回 ""
$rest = substr("abcdef", -3, -1); // 返回 "de"
//================================= strtoupper ==================================/
// 将小写转化成大写
strtoupper('sdfd');
// 将大写转化成小写
$str = strtolower('DSFD');
// - 将字符串的首字母转换为大写
ucfirst('sdfDD');
//================================= str_replace ==================================/
// 赋值: <body text='black'>
$bodytag = str_replace("%body%", "black", "<body text='%body%'>");
// 赋值: Hll Wrld f PHP
$vowels = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U");
$onlyconsonants = str_replace($vowels, "", "Hello World of PHP");
// 赋值: You should eat pizza, beer, and ice cream every day
$phrase  = "You should eat fruits, vegetables, and fiber every day.";
$healthy = array("fruits", "vegetables", "fiber");
$yummy   = array("pizza", "beer", "ice cream");
$newphrase = str_replace($healthy, $yummy, $phrase);
// 赋值: 2  替换两次
$str = str_replace("ll", "", "good golly miss molly!", $count);
echo $count;
// 替换顺序
$str     = "Line 1\nLine 2\rLine 3\r\nLine 4\n";
$order   = array("\r\n", "\n", "\r");
$replace = '<br />';
// 首先替换 \r\n 字符，因此它们不会被两次转换
$newstr = str_replace($order, $replace, $str);
// 输出 F ，因为 A 被 B 替换，B 又被 C 替换，以此类推...
// 由于从左到右依次替换，最终 E 被 F 替换
$search  = array('A', 'B', 'C', 'D', 'E');
$replace = array('B', 'C', 'D', 'E', 'F');
$subject = 'A';
echo str_replace($search, $replace, $subject);
// 输出: apearpearle pear
// 由于上面提到的原因
$letters = array('a', 'p');
$fruit   = array('apple', 'pear');
$text    = 'a p';
$output  = str_replace($letters, $fruit, $text);
echo $output;
//str_ireplace()  不区分大小写
/**
 * Normalise a string replacing foreign characters
 *
 * @param string
 * @return string
 */
function normalize($str)
{
    $a = array(
        'À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ',
        'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å',
        'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù',
        'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č',
        'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ',
        'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ',
        'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń',
        'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ',
        'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ',
        'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż',
        'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ',
        'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');
    $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
    return str_replace($a, $b, $str);
}
//================================= substr_replace ==================================/
$var = 'ABCDEFGH:/MNRPQR/';
echo "Original: $var<hr />\n";
/* 这两个例子使用 “bob” 替换整个 $var。*/
echo substr_replace($var, 'bob', 0) . "<br />\n";
echo substr_replace($var, 'bob', 0, strlen($var)) . "<br />\n";
/* 将 “bob” 插入到 $var 的开头处。*/
echo substr_replace($var, 'bob', 0, 0) . "<br />\n";
/* 下面两个例子使用 “bob” 替换 $var 中的 “MNRPQR”。*/
echo substr_replace($var, 'bob', 10, -1) . "<br />\n";
echo substr_replace($var, 'bob', -7, -1) . "<br />\n";
/* 从 $var 中删除 “MNRPQR”。*/
echo substr_replace($var, '', 10, -1) . "<br />\n";
//============================== preg_replace_callback ================================/