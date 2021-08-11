<?php

class Random
{
    private $seed;

    /**
     * @param $seed
     */
    public function __construct($seed = false)
    {
        if($seed == false){
            srand();
            $seed = rand(0, 100);
        }
        $this->seed = $seed;
    }

    /**
     * return random number
     *
     * @return int
     */
    public function getRandom(){
        srand($this->seed);
        return rand(0, 100);
    }

    /**
     * Return seed
     *
     * @return int
     */
    public function getSeed(){
        return $this->seed;
    }

    /**
     * @param $seed
     */
    public function setSeed($seed){
        $this->seed = $seed;
    }
}