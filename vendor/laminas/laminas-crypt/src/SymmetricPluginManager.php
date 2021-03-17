<?php

/**
 * @see       https://github.com/laminas/laminas-crypt for the canonical source repository
 * @copyright https://github.com/laminas/laminas-crypt/blob/master/COPYRIGHT.md
 * @license   https://github.com/laminas/laminas-crypt/blob/master/LICENSE.md New BSD License
 */

namespace Laminas\Crypt;

use Interop\Container\ContainerInterface;

/**
 * Plugin manager implementation for the symmetric adapter instances.
 *
 * Enforces that symmetric adapters retrieved are instances of
 * Symmetric\SymmetricInterface. Additionally, it registers a number of default
 * symmetric adapters available.
 */
class SymmetricPluginManager implements ContainerInterface
{
    /**
     * Default set of symmetric adapters
     *
     * @var array
     */
    protected $symmetric = [
        'mcrypt' => Symmetric\Mcrypt::class,
    ];

    /**
     * Do we have the symmetric plugin?
     *
     * @param  string $id
     * @return bool
     */
    public function has($id)
    {
        return array_key_exists($id, $this->symmetric);
    }

    /**
     * Retrieve the symmetric plugin
     *
     * @param  string $id
     * @return Symmetric\SymmetricInterface
     */
    public function get($id)
    {
        $class = $this->symmetric[$id];
        return new $class();
    }
}