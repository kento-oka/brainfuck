<?php
/**
 * kentoka/brainfuck
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.
 * Redistributions of files must retain the above copyright notice.
 *
 * @author      Kento Oka <kento-oka@kentoka.com>
 * @copyright   (c) Kento Oka
 * @license     MIT
 * @since       1.0.0
 */
namespace Kentoka\Brainfuck\Memory;

/**
 *
 */
abstract class AbstractMemory implements MemoryInterface{

    /**
     * {@inheritDoc}
     */
    public function incrementData(int $pointer): MemoryInterface{
        return $this->setData(
            $pointer,
            $this->getData($pointer) + 1
        );
    }

    /**
     * {@inheritDoc}
     */
    public function decrementData(int $pointer): MemoryInterface{
        return $this->setData(
            $pointer,
            $this->getData($pointer) - 1
        );
    }
}
