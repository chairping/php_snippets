<?php

class Str {

    /**
     * 限制字符串长度
     * @param string $value  需切断的字符串
     * @param int $limit     长度
     * @param string $end    后缀
     * @return string
     */
    public static function limit($value, $limit = 100, $end = '...')
    {
        if (mb_strwidth($value, 'UTF-8') <= $limit) {
            return $value;
        }
        // 第三个参数不用是为了防止截取的最后一个字符是空白符
        return rtrim(mb_strimwidth($value, 0, $limit, '', 'UTF-8')) . $end;
    }

    /**
     * 快速生成随机数
     * @param int $length
     * @return string
     */
    public static function quickRandom($length = 16)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle(str_repeat($pool, $length)), 0, $length);
    }

    /**
     *
     * @param $haystack
     * @param $needles
     * @return bool
     */
    public static function endsWith($haystack, $needles)
    {
        foreach ((array) $needles as $needle) {
            if ((string) $needle === substr($haystack, -strlen($needle))) {
                return true;
            }
        }

        return false;
    }

    /**
     *
     * @param $string
     * @param $start
     * @param null $length
     * @return string
     */
    public static function substr($string, $start, $length = null)
    {
        return mb_substr($string, $start, $length, 'UTF-8');
    }

    /**
     * @param $value
     * @return bool|int
     */
    public static function length($value)
    {
        return mb_strlen($value);
    }

    /**
     * @desc  过滤字符串
     * @param string $str      要过滤的字符串
     * @param string $tag      符合过滤条件的标记
     * @return string          返回过滤后的字符串
     * @sample
     *      $string = <<<STR   /**
     *          *  @desc  过滤字符串
     *          *   @param string $str      要过滤的字符串
     *          *\/
     *      STR;
     *      self::getDocComment($string, '@desc');  // output: 过滤字符串
     */
    public static function getDocComment($str, $tag = '') {
        if (empty($tag)) {
            return $str;
        }
        $matches = array();
        preg_match("/".$tag." (.*)(\\r\\n|\\r|\\n)/U", $str, $matches);
        if (isset($matches[1])) {
            return trim($matches[1]);
        }
        return '';
    }

    public static function formatSize($size) {
        $sizes = array(" B", " K", " M", " GB");
        if ($size == 0) {
            return 'n/a';
        } else {
            return (round($size/pow(1024, ($i = floor(log($size, 1024)))), 2) . $sizes[$i]);
        }
    }
}