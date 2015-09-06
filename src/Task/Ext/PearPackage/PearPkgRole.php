<?php
/**
 * Created by PhpStorm.
 * User: michiel
 * Date: 9/6/15
 * Time: 9:53 AM
 */
namespace Phing\Task\Ext\PearPackage;

/**
 * Encapsulates file roles
 *
 * @package phing.tasks.ext
 */
class PearPkgRole
{
    /**
     * @var string
     */
    private $extension;

    /**
     * @var string
     */
    private $role;

    /**
     * Sets the file extension
     * @param string $extension
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
    }

    /**
     * Retrieves the file extension
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Sets the role
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * Retrieves the role
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }
}