<?php
/**
 * Created by PhpStorm.
 * User: piquerue
 * Date: 5/28/18
 * Time: 8:24 AM
 */

interface PageInterface
{
    public function display();
    public function form_post();
    public function form_get();
    public function ajax_get();
    public function ajax_php();
    public function doc();
    public function toggle_verbrose();
    public function getVerbrose();
}