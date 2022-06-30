<?php


namespace app\models;


use app\core\Model;

class User extends Model
{
    /**
     * ============================================================================================
     * Propiedades de la clase
     * ============================================================================================
     */
    public string $firstname;
    public string $lastname;
    public string $birthdate;
    public string $email;
    public string $password;
    public string $passwordConfirm;

    public function create()
    {
    }

    public function rules(): array
    {
        return [
            'firstname' => [self::RULE_REQUIRED],
            'lastname' => [self::RULE_REQUIRED],
            'birthdate' => [self::RULE_REQUIRED, self::RULE_DATE],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 5], [self::RULE_MAX, 'max' => 10]],
            'passwordConfirm' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']],
        ];
    }
}