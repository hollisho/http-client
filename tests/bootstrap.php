<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Doctrine\Common\Annotations\AnnotationRegistry;

// 注册 Composer 的自动加载器
AnnotationRegistry::registerLoader('class_exists');