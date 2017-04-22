<?php

namespace HMS\Processor;

class Errors{
    public static $errors = array();

    /**
     * Add Form variable error to error array;
     *
     * @param string $item
     * @param string $error
     * @return void
     */
    private function setErrors(string $item,string $error){
        $this->errors[$item] = $error;
    }
    /**
     * Get errors array
     *
     * @return void
     */
    public function getErrors(){
        return $this->errors;
    }
}