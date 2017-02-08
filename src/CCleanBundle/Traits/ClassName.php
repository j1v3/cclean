<?php
/**
 * Created by PhpStorm.
 * User: j1v3
 * Date: 08/02/17
 * Time: 07:04
 */

namespace CCleanBundle\Traits;

trait ClassName
{
    /**
     * Returns the Full name of a class (equivalent of ::class which can be used starting from php 5.5)
     *
     * @return string the class name including namespace
     */
    static public function CLASSNAME()
    {
        return get_called_class();
    }
}