<?php
/**
 * @package     Parable Filesystem
 * @license     MIT
 * @author      Robin de Graaf <hello@devvoh.com>
 * @copyright   2015-2016, Robin de Graaf, devvoh webdevelopment
 */

namespace Parable\Filesystem;

class Path
{
    /** @var string */
    protected $basedir;

    /**
     * @param string $basedir
     *
     * @return $this
     */
    public function setBasedir($basedir)
    {
        $this->basedir = rtrim($basedir, DS);
        return $this;
    }

    /**
     * @return string
     */
    public function getBasedir()
    {
        return $this->basedir;
    }

    /**
     * @param string $dir
     *
     * @return string
     */
    public function getDir($dir)
    {
        $dir = str_replace('/', DS, $dir);
        return $this->basedir . DS . ltrim($dir, DS);
    }
}
