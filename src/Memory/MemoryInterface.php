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
interface MemoryInterface{

    /**
     * ポインタの指す値を取得する
     *
     * @param int $pointer
     *
     * @return int
     */
    public function getData(int $pointer): int;

    /**
     * ポインタの指す値を設定する
     *
     * @param int $pointer
     * @param int $data
     *
     * @return MemoryInterface
     */
    public function setData(int $pointer, int $data): MemoryInterface;

    /**
     * ポインタの指す値をインクリメントする
     *
     * @param int $pointer
     *
     * @return MemoryInterface
     */
    public function incrementData(int $pointer): MemoryInterface;

    /**
     * ポインタの指す値をデクリメントする
     *
     * @param int $pointer
     *
     * @return MemoryInterface
     */
    public function decrementData(int $pointer): MemoryInterface;

    /**
     * メモリをクリアする
     *
     * @return MemoryInterface
     */
    public function clear(): MemoryInterface;
}
