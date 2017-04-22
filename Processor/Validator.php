<?php

namespace HMS\Processor;

use HMS\Database\Database;

class Validator extends Database
{
    private $passed = false,
            $errors = array();

    public function __construct(){
        parent::__construct();
    }
    /**
     * Validate Given Post or Get Array
     *
     * @param array $source
     * @param array $items
     * @return void
     */
    public function validate(array $source, array $items=array()){
        foreach($items as $item => $rules){
            foreach($rules as $rule => $rule_value){
                 $value = trim($source[$item]);

                if($rule === 'required' && empty($value)){
                    $this->setErrors($item,"{$item} is required.");
                } else if(!empty($value)){
                    switch($rule){
                        case 'min':
                            if(strlen($value) < $rule_value){
                                $this->setErrors($item,"{$item} must be a minimum of {$rule_value} characters");
                            }
                        break;

                        case 'max':
                            if(strlen($value) > $rule_value){
                                $this->setErrors($item,"{$item} must be a maximum of {$rule_value} characters");
                            }
                        break;

                        case 'matches':
                            if($value != $source["$rule_value"]){
                                $this->setErrors($item,"{$rule_value} must match {$item}");
                            }
                        break;

                        case 'password':
                        break;

                        case 'unique':
                            if($this->db->has("$rule_value",["$item"=>"$value"])){
                                $this->setErrors($item,"{$item} already exists.");
                            }
                        break;

                        case 'min':
                        break;
                    }
                }
            }
        }

        if(empty($this->getErrors())){
            $this->setPassed(true);
        }
        return $this;
    }
    /**
     * Set passed variable to true/false
     *
     * @param bool $passed
     * @return void
     */
    private function setPassed(bool $passed){
        $this->passed = $passed;
    }
    /**
     * Get passed variable
     *
     * @return void
     */
    public function getPassed(){
        return $this->passed;
    }

}