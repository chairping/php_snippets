<?php
// Closure::bindTo 复制当前闭包对象，绑定指定的$this对象和类作用域。
// 例子1
class App {
    protected $routes = array();
    protected $responseStatus = '200 OK';
    protected $reponseContentType = 'text/html';
    protected $responseBody = 'Hello world';

    public function addRoute($reoutePath, $routeCallback) {
        $this->routes[$reoutePath] = $routeCallback->bindTo($this, __CLASS__);
    }

    public function dispatch($currentPath) {
        foreach ($this->routes as $routhPath => $callback) {
            if ($routhPath === $currentPath) {
                $callback();
            }
        }

        header('HTTP/1.1 ' . $this->responseStatus);
        header('Content-type: ' . $this->reponseContentType);
        header('Content-length: ' . mb_strlen($this->responseBody));
        echo $this->responseBody;
    }
}

$app = new App();
$app->addRoute('/users/josh', function(){
    $this->reponseContentType = 'application/json;charset=utf8';
    $this->responseBody = '{"name": "Josh"}';
});

$app->dispatch('/users/josh');


// 例子2
class A {
    public function __construct($val) {
        $this->val = $val;
    }

    public function getClosure() {
        return function() { return $this->val;};
    }
}

$ob1 = new A(1);
$ob2 = new A(2);

$cl = $ob1->getClosure();
echo $cl(); //  此时 这个匿名函数 默认banding $ob1; 所以输出1

$cl = $cl->bindTo($ob2);  // 该匿名类重新绑定ob2  所以$this->val = 2;
echo $cl();
