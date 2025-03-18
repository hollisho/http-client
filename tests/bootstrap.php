<?php

use Doctrine\Common\Annotations\AnnotationRegistry;

require __DIR__ . '/../vendor/autoload.php';

// 处理 doctrine/annotations 不同版本的兼容性
if (class_exists('Doctrine\Common\Annotations\AnnotationRegistry')) {
    if (method_exists(AnnotationRegistry::class, 'registerLoader')) {
        AnnotationRegistry::registerLoader('class_exists');
    }
}