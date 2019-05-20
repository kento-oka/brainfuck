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
namespace Kentoka\Brainfuck;

/**
 *
 */
interface Token{

    /**
     * ポインタをインクリメントする
     */
    public const T_INC_POINTER  = ">";

    /**
     * ポインタをデクリメントする
     */
    public const T_DEC_POINTER  = "<";

    /**
     * ポインタが指す値をインクリメントする
     */
    public const T_INC_VALUE    = "+";

    /**
     * ポインタが指す値をデクリメントする
     */
    public const T_DEC_VALUE    = "-";

    /**
     * ポインタが指す値を出力する
     */
    public const T_OUTPUT       = ".";

    /**
     * 入力から1バイト読み込み、ポインタが指す先に代入する
     */
    public const T_INPUT        = ",";

    /**
     * ポインタの指す値が0なら、対応するT_BACKの直後へプログラムポインタを移動する
     */
    public const T_JUMP         = "[";

    /**
     * ポインタの指す値が0でないなら、対応するT_JUMPの直後へプログラムポインタを移動する
     */
    public const T_BACK         = "]";
}
