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
use Psr\Http\Message\StreamInterface;

/**
 *
 */
class Interpreter{

    /**
     * @mixed[]
     */
    const TOKEN_MAP = [
        ">" => Token::T_INC_POINTER,
        "<" => Token::T_DEC_POINTER,
        "+" => Token::T_INC_VALUE,
        "-" => Token::T_DEC_VALUE,
        "." => Token::T_OUTPUT,
        "," => Token::T_INPUT,
        "[" => Token::T_JUMP,
        "]" => Token::T_BACK,
    ];

    /**
     * @var MemoryInterface
     */
    private $memory;

    /**
     * @var int
     */
    private $dataPointer    = 0;

    /**
     * Constructor.
     *
     * @param MemoryInterface $memory
     * @param int             $dataPointer
     */
    public function __construct(MemoryInterface $memory, int $dataPointer = 0){
        if($this->dataPointer > 0){
            throw new \InvalidArgumentException();
        }

        $this->memory       = $memory;
        $this->dataPointer  = $dataPointer;
    }

    /**
     * 実行する
     *
     * @param StreamInterface $program
     * @param StreamInterface $input
     * @param StreamInterface $output
     *
     * @return void
     */
    public function exec(StreamInterface $program, StreamInterface $input, StreamInterface $output){
        if(!$program->isReadable() || !$program->isSeekable()){
            throw new \InvalidArgumentException();
        }

        if(!$input->isReadable()){
            throw new \InvalidArgumentException();
        }

        if(!$output->isWritable()){
            throw new \InvalidArgumentException();
        }

        $this->memory->clear();

        /**
         * @var bool|int intの時はスタックに積まれているジャンプコマンド位置
         */
        $skipToBack = false;
        $jumpStack  = new \SplStack();

        while(!$program->eof()){
            $programPointer = $program->tell();
            $token          = self::TOKEN_MAP[$program->read(1)] ?? null;

            if(null === $token){
                continue;
            }

            if(
                false !== $skipToBack
                && !($token === Token::T_JUMP || $token === Token::T_BACK)
            ){
                continue;
            }

            switch($token){
                case Token::T_INC_POINTER:
                    $this->dataPointer++;
                    break;

                case Token::T_DEC_POINTER:
                    $this->dataPointer--;
                    break;

                case Token::T_INC_VALUE:
                    $this->memory->incrementData($this->dataPointer);
                    break;

                case Token::T_DEC_VALUE:
                    $this->memory->decrementData($this->dataPointer);
                    break;

                case Token::T_OUTPUT:
                    $output->write(
                        pack("C*", $this->memory->getData($this->dataPointer))
                    );
                    break;

                case Token::T_INPUT:
                    $inByte =  $input->read(1);

                    if("" === $input){
                        throw new \RuntimeException();
                    }

                    $this->memory->setData($this->dataPointer, unpack("C", $inByte)[1]);
                    break;

                case Token::T_JUMP:
                    $jumpStack->push($programPointer);

                    if(false !== $jumpStack){
                        break;
                    }

                    if(0 === $this->memory->getData($this->dataPointer)){
                        $skipToBack = $programPointer;
                    }

                    break;

                case Token::T_BACK:
                    if($jumpStack->isEmpty()){
                        throw new \RuntimeException();
                    }

                    $backPoint = $jumpStack->pop();

                    if(false !== $jumpStack){
                        if($backPoint === $jumpStack){
                            $jumpStack = false;
                        }

                        break;
                    }

                    if(0 !== $this->memory->getData($this->dataPointer)){
                        $program->seek($backPoint);
                    }
                    break;
            }
        }
    }
}
