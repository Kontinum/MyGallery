<?php
class Validation
{
    private $db,
            $errors = array(),
            $passed = false;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    public function check($source,$fields = array())
    {
        foreach ($fields as $name => $rules) {
            $value = trim(escape($source[$name]));

            $displayName = ucwords(str_replace(['_','-']," ",$name));

            $rules = explode('|',$rules);

            foreach ($rules as $rule) {
                if($rule == 'required' && empty($value)){
                    $this->addError("{$displayName} is required");
                }elseif(!empty($value)){
                    if(!preg_match("/:/",$rule)){
                        switch ($rule){
                            case 'email' :
                                if(!filter_var($value,FILTER_VALIDATE_EMAIL)){
                                    $this->addError("Email that you have entered is not valid");
                                }
                            break;
                            case 'int':
                                if(!filter_var($value,FILTER_VALIDATE_INT)){
                                    $this->addError("{$displayName} is not an integer");
                                }
                            break;
                        }
                    }else{
                        list ($ruleName, $ruleValue) = explode(':',$rule);

                        switch ($ruleName){
                            case 'min' :
                                if(strlen($value) < $ruleValue){
                                    $this->addError("{$displayName} must be higher than {$ruleValue} characters");
                                }
                            break;
                            case 'max':
                                if(strlen($value) > $ruleValue){
                                    $this->addError("{$displayName} must be lower than {$ruleValue} characters");
                                }
                            break;
                            case 'matches':
                                if($value !== $source[$ruleValue]){
                                    $this->addError("{$displayName} must be same as {$ruleValue}");
                                }
                            break;
                            case 'unique':
                                $check = $this->db->get($ruleValue,[$name,'=',$value]);
                                if($check->count()){
                                    $this->addError("That {$displayName} is already in database");
                                }
                            break;
                        }
                    }
                }
            }
        }
        if(empty($this->errors)){
            $this->passed = true;
        }
        return $this;
    }

    public function passed()
    {
        return $this->passed;
    }

    public function addError($error)
    {
        $this->errors[] = $error;
    }

    public function errors()
    {
        return $this->errors;
    }
}