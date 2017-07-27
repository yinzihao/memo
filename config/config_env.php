<?php
/**
 * 开发环境，通常小写，建议：
 *
 * - dev：本地开发环境
 * - test：测试环境
 * - product：生产环境
 *
 */
define('ENV', getenv('ENV') ? getenv('ENV') : 'product');