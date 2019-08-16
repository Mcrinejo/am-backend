<?php

namespace App\Traits;

trait Validator
{
    public function validatePassword($pwd) {
        $regex_password = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/';
        return preg_match($regex_password, $pwd);
    }

    public function validateEmail($email) {
        $regex_email = '/^[A-z0-9\\._-]+@[A-z0-9][A-z0-9-]*(\\.[A-z0-9_-]+)*\\.([A-z]{2,6})$/';
        return preg_match($regex_email, $email);
    }
    
    public function validateAddress($address) {
        $regex_address = '/[A-z0-9][A-z0-9-]{10,75}$/';
        return preg_match($regex_address, $address);
    }

    public function validateStringBasics($string) {
        $regex_text = '/^[ a-zA-ZÀ-ÿ ]*$/';
        return preg_match($regex_text, $string);
    }

    public function validateZipCode($zipcode) {
        $regex_zipcode = '/(?i)^[a-z0-9][a-z0-9\- ]{0,5}[a-z0-9]$/';
        return preg_match($regex_zipcode, $zipcode);
    }
     
    public function validateDate($date) {
        $date = explode('/', $date);
        if(count($date) != 3) {
            return false;
        } 
        return checkdate($date[1], $date[0], $date[2]);
    }
 
    function validateBirthdate($date) {
        if(!$this->validateDate($date)) {
            return false;
        }   
        $bornDate = date_create_from_format('d/m/Y', $date);
        $today = date_create(date("Y-m-d H:i:s"));
        $interval = date_diff($bornDate, $today);
        if($interval->format('%y') > 17) {
            return true;
        } else {
            return false;
        }
    }
}
