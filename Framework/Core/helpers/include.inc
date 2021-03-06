<?php
/**
 * Custom functions
 *
 * @category   Core
 * @package    BAZALT
 * @subpackage Functions
 * @copyright  2010 Equalteam
 * @license    GPLv3
 * @version    SVN: $Id: include.inc 157 2010-11-29 06:14:11Z esvit $
 * @link       http://bazalt-cms.com/
 */

if (!function_exists('lcfirst')) {
    require_once 'lcfirst.php';
}

require_once 'getCalledClass.php';
require_once 'using.php';
require_once 'typeOf.php';
require_once 'relativePath.php';