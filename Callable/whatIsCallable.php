<?php
// is_callable 的意思是可以调用的到
// 1.类里面的方法
class A {public function test() {}}
// 2. 匿名函数
$nimingFuntion = function() {};
// 3. 函数
function AF() {}
var_dump(is_callable(['A', 'test']));   // true
var_dump(is_callable($nimingFuntion));  // true
var_dump(is_callable('AF'));            // true
// Closure 代表匿名函数
var_dump(($nimingFuntion instanceof \Closure));
// Array callable
if (is_array($callable)) {
    list($class, $method) = $callable;
    return new \ReflectionMethod($class, $method);
}
// Closure
if ($callable instanceof \Closure) {
    return new \ReflectionFunction($callable);
}
// Callable object (i.e. implementing __invoke()) // 匿名函数相当 实现了__invoke的类
if (is_object($callable) && method_exists($callable, '__invoke')) {
    return new \ReflectionMethod($callable, '__invoke');
}
// Callable class (i.e. implementing __invoke())
if (is_string($callable) && class_exists($callable) && method_exists($callable, '__invoke')) {
    return new \ReflectionMethod($callable, '__invoke');
}
// Standard function
return new \ReflectionFunction($callable);

echo preg_replace_callback('~-([a-z])~', function ($match) {
    return strtoupper($match[1]);
}, 'hello-world');
// outputs helloWorld
$callback =
    function ($quantity, $product) use ($tax, &$total)
    {
        $pricePerItem = constant(__CLASS__ . "::PRICE_" . strtoupper($product));
        $total += ($pricePerItem * $quantity) * ($tax + 1.0);
    };
array_walk($this->products, $callback);