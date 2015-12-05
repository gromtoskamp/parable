<?php
/**
 * @package     Devvoh
 * @subpackage  Components
 * @subpackage  GetSet
 * @license     MIT
 * @author      Robin de Graaf <hello@devvoh.com>
 * @copyright   2015 Robin de Graaf, devvoh webdevelopment
 */

namespace Devvoh\Components;

class GetSet {
    use \Devvoh\Components\Traits\GetClassName;

    protected $resource = null;
    protected $localResource = [];
    protected $useLocalResource = false;
    protected $globals = ['get', 'post', 'session', 'cookie'];

    /**
     * Return globals
     *
     * @return array
     */
    public function getGlobals() {
        return $this->globals;
    }

    /**
     * Returns the resource type
     *
     * @return null|string
     */
    public function getResource() {
        return $this->resource;
    }

    /**
     * Sets the resource type, which can be either a PHP superglobal (GET/POST/SESSION, etc) or a custom one.
     *
     * @param $type
     *
     * @return \Devvoh\Components\GetSet
     */
    public function setResource($type) {
        $this->resource = $type;

        if (in_array(strtolower($type), $this->getGlobals())) {
            $this->useLocalResource = false;
            $this->resource = strtoupper($type);
        } else {
            $this->useLocalResource = true;
            $this->localResource[$this->getResource()] = [];
        }
        return $this;
    }

    /**
     * Get all from resource if resource set
     *
     * @return array|null
     */
    public function getAll() {
        if (!$this->getResource()) {
            return null;
        }
        if ($this->useLocalResource) {
            return $this->localResource[$this->getResource()];
        }
        return $GLOBALS['_' . $this->getResource()];
    }

    /**
     * Get specific value by key if resource set
     *
     * @param $key
     *
     * @return mixed|null
     */
    public function get($key) {
        if (!$this->getResource()) {
            return null;
        }

        // If local resource, set it as reference
        if ($this->useLocalResource) {
            $reference = $this->localResource[$this->getResource()];
        } else {
            $reference = $GLOBALS['_' . $this->getResource()];
        }

        // Now check reference and whether the key exists
        if (isset($reference[$key])) {
            return $reference[$key];
        }
        return null;
    }

    /**
     * Set specific value by key if resource set
     *
     * @param $key
     * @param $value
     *
     * @return \Devvoh\Components\GetSet|false
     */
    public function set($key, $value) {
        if (!$this->getResource()) {
            return false;
        }

        // If local resource, set it as reference
        if ($this->useLocalResource) {
            $this->localResource[$this->getResource()][$key] = $value;
        } else {
            $GLOBALS['_' . $this->getResource()][$key] = $value;
        }
        return $this;
    }

    /**
     * Set entire array onto the resource
     *
     * @param $values
     *
     * @return \Devvoh\Components\GetSet
     */
    public function setAll($values) {
        if ($this->useLocalResource) {
            $this->localResource[$this->getResource()] = $values;
        } else {
            $GLOBALS['_' . $this->getResource()] = $values;
        }
        return $this;
    }

    /**
     * Start the session
     *
     * @return \Devvoh\Components\GetSet
     */
    public function startSession() {
        session_start();
        return $this;
    }

    /**
     * Destroy the session
     *
     * @return \Devvoh\Components\GetSet
     */
    public function destroySession() {
        session_destroy();
        return $this;
    }

}