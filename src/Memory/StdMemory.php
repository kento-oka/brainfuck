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
class StdMemory extends AbstractMemory{

    /**
     * メモリのデータの最大値
     */
    protected const DEFAULT_MEMORY_DATA_MAX = PHP_INT_MAX;

    /**
     * メモリのポインタの最大値(メモリの容量)
     */
    protected const DEFAULT_MEMORY_POINTER_MAX  = 30000;

    /**
     * @var int ポインターの最大値
     */
    private $pointerMax;

    /**
     * @var int データの最大値
     */
    private $dataMax;

    /**
     * @var int[] メモリ
     */
    private $memory = [];

    /**
     * Constructor.
     *
     * @param int $dataMax
     * @param int $pointerMax
     */
    public function __construct(
        int $dataMax = self::DEFAULT_MEMORY_DATA_MAX,
        int $pointerMax = self::DEFAULT_MEMORY_POINTER_MAX
    ){
        if(1 > $dataMax){
            throw new \InvalidArgumentException();
        }

        if(self::DEFAULT_MEMORY_POINTER_MAX > $pointerMax){
            throw new \InvalidArgumentException();
        }

        $this->dataMax      = $dataMax;
        $this->pointerMax   = $pointerMax;
    }

    /**
     * {@inheritDoc}
     */
    public function getData(int $pointer): int{
        if(0 > $pointer || $this->pointerMax < $pointer){
            throw new \RuntimeException();
        }

        return $this->memory[$pointer] ?? 0;
    }

    /**
     * {@inheritDoc}
     */
    public function setData(int $pointer, int $data): MemoryInterface{
        if(0 > $pointer || $this->pointerMax < $pointer){
            throw new \RuntimeException();
        }

        if(0 > $data || $this->dataMax < $data){
            throw new \RuntimeException();
        }

        $this->memory[$pointer] = $data;

        return $this;
    }

    public function clear(): MemoryInterface{
        $this->memory   = [];

        return $this;
    }
}
