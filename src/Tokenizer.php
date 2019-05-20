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

use Kentoka\Brainfuck\Memory\MemoryInterface;

/**
 *
 */
class Tokenizer implements TokenizerInterface{

    const TOKEN_MAP = [
        ">" => TokenizerInterface::T_INC_POINTER,
        "<" => TokenizerInterface::T_DEC_POINTER,
        "+" => TokenizerInterface::T_INC_VALUE,
        "-" => TokenizerInterface::T_DEC_VALUE,
        "." => TokenizerInterface::T_OUTPUT,
        "," => TokenizerInterface::T_INPUT,
        "[" => TokenizerInterface::T_JUMP,
        "]" => TokenizerInterface::T_BACK,
    ];

    /**
     * @var resource
     */
    private $resource;

    /**
     * Constructor.
     *
     * @param resource $resource
     */
    public function __construct($resource){
        if(!is_resource($resource)){
            throw new \InvalidArgumentException();
        }

        $mode   = stream_get_meta_data($resource)["mode"] ?? null;

        if(null === $mode || (strpos($mode, "r") === false && strpos($mode, "+") !== false)){
            throw new \InvalidArgumentException();
        }

        $this->resource;
    }

    /**
     * {@inheritDoc}
     */
    public function pop(){
        if(feof($this->resource)){
            return null;
        }

        if(false === ($token = fread($this->resource, 1))){
            throw new \RuntimeException();
        }

        return self::TOKEN_MAP[$token] ?? TokenizerInterface::T_DUST;
    }

    public function getPointer(): int{

    }
}
