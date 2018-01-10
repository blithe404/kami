<?php
/**
 * Created by PhpStorm.
 * User: blirx
 * Date: 2018/1/10
 * Time: 02:14
 */

namespace Home\Controller;


use Think\Controller;

class CommonController extends Controller {

    protected function display($templateFile = '') {
        $theme = 'pc';
        $this->theme($theme);
        parent::display($templateFile);
    }
}