<?php
$objct = new stdClass();
$reflect = new ReflectionClass($objct);
if ($reflect->hasMethod('hhhh')) {
    $methodObj = $reflect->getMethod('hhhh');
    if(!$methodObj->isPublic()){
        $methodObj->setAccessible(true);
    }
    $methodObj->invokeArgs($reflect, array());
}
$parentClass = $reflect->getParentClass();
// 获取类名（不含命名空间)
$shorName = $reflect->getShortName();
$classDocument = $reflect->getDocComment();
// 获取静态属性值
$staticPro = $reflect->getStaticPropertyValue('DIR_PATH');
foreach($reflect->getMethods(ReflectionMethod::IS_PUBLIC) as $method){
    $method->isConstructor();
    if ($parentClass->getMethod($method->getName())) {
    }
    if ($method->getNumberOfParameters()) {
        foreach($method->getParameters() as $paramsObj) {
            $tmp['params'][$paramsObj->getName()] = $paramsObj->isDefaultValueAvailable() ? $paramsObj->getDefaultValue() : '';
        }
    }
}