<?php

/**
 * Created by PhpStorm.
 * User: cp
 * Date: 16-6-13
 * Time: 上午12:51
 */
class Filter extends \FilterIterator {

    private $filterCondtion = '';
    /**
     * @desc 构造迭代器
     * @param  $dirOrIterator
     *      1. 文件目录
     *        2. DirectoryIterator
     *        3. RecursiveIteratorIterator
     * @example
     *  1 new Filter('path', \FilesystemIterator::SKIP_DOTS, \RecursiveIteratorIterator::LEAVES_ONLY)
     *  2 $dir = new \RecursiveDirectoryIterator($dirOrIterator);
     *       new Filter($dir, \RecursiveIteratorIterator::LEAVES_ONLY);
     *    3 $recursive = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dirOrIterator), $recursiveFlags); new Filter($recursive);
     */
    public function __construct($dirOrIterator)
    {
        if (is_string($dirOrIterator)) {
            if (!is_dir($dirOrIterator)) {
                throw new \Exception("文件不存在:{$dirOrIterator}");
            }
            $filesystemFlags = func_get_arg(1) ?: \FilesystemIterator::SKIP_DOTS; // 过滤掉 . 和 ..
            $recursiveFlags = func_get_arg(2) ?: \RecursiveIteratorIterator::LEAVES_ONLY;  //对于遍历目录只返回文件
            $dirOrIterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($dirOrIterator, $filesystemFlags), $recursiveFlags);
        } elseif ($dirOrIterator instanceof \DirectoryIterator) {
            $recursiveFlags = func_get_arg(1) ?: \RecursiveIteratorIterator::LEAVES_ONLY;
            $dirOrIterator = new \RecursiveIteratorIterator($dirOrIterator, $recursiveFlags);
        } elseif (! ($dirOrIterator instanceof \RecursiveIteratorIterator) ) {
            throw new \Exception("非法参数:");
        }
        parent::__construct($dirOrIterator);
    }
    /**
     * @desc  过滤操作
     * @return bool
     *
     */
    public function accept()
    {
        $iterator = $this->getInnerIterator()->current();
        return $this->filterOp($iterator);
    }
    /**
     *      * @desc 使用加载进来的过滤条件类
     *           * @param $iterator 内部迭代器
     *                * @return mixed
     *                     */
    public function filterOp($iterator) {
        if (is_object($this->filterCondtion)) {
            return $this->filterCondtion->filter($iterator);
        } else {
            return true;
        }
    }
    /**
     *      * 设置过滤条件类
     *           * @param $filterCondtion  含有filter方法的类  todo  独立类型类， 加强类型判断
     *                * @return $this
     *                     */
    public function setFilterCondtion($filterCondtion) {
        if (is_object($filterCondtion)) {
            $this->filterCondtion = $filterCondtion;
        }
        return $this;
    }

}