<?php


namespace app\core;


abstract class Model
{
    /**
     * ============================================================================================
     * Propiedades de la clase
     * ============================================================================================
     */
    public const RULE_REQUIRED = 'required';
    public const RULE_EMAIL = 'email';
    public const RULE_MIN = 'min';
    public const RULE_MAX = 'max';
    public const RULE_MATCH = 'match';
    public const RULE_DATE = 'date';
    public array $errors = [];

    /**
     * ============================================================================================
     * Método para cargar los datos pasados al controlador
     * @param $data
     * ============================================================================================
     */
    public function loadData($data)
    {
        foreach ($data as $key => $value)
        {
            if (property_exists ($this, $key))
            {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * ============================================================================================
     * Método abstracto que se llamará desde el controlador para aplicar las reglas de validación
     * @return array
     * ============================================================================================
     */
    abstract public function rules(): array;

    /**
     * ============================================================================================
     * Método que valida cada uno de los campos con las reglas de validación establecidas
     * @return bool
     * ============================================================================================
     */
    public function validate()
    {
        foreach ($this->rules () as $attribute => $rules)
        {
            $value = $this->{$attribute};
            foreach ($rules as $rule)
            {
                $ruleName = $rule;
                if (!is_string ($ruleName))
                {
                    $ruleName = $rule[0];
                }
                if ($ruleName === self::RULE_REQUIRED && !$value)
                {
                    $this->addError($attribute, self::RULE_REQUIRED);
                }
                if ($ruleName === self::RULE_EMAIL && !filter_var ($value, FILTER_VALIDATE_EMAIL))
                {
                    $this->addError($attribute, self::RULE_EMAIL);
                }
                if ($ruleName === self::RULE_MIN && strlen ($value) < $rule['min'])
                {
                    $this->addError($attribute, self::RULE_MIN, $rule);
                }
                if ($ruleName === self::RULE_MAX && strlen ($value) > $rule['max'])
                {
                    $this->addError($attribute, self::RULE_MAX, $rule);
                }
                if ($ruleName === self::RULE_MATCH && $value !== $this->{$rule['match']})
                {
                    $this->addError($attribute, self::RULE_MATCH, $rule);
                }
            }
        }

        return empty($this->errors);
    }

    /**
     * ============================================================================================
     * Método que agrega el mensaje de error a cada regla que no se cumple en la validación
     * @param string $attribute
     * @param string $rule
     * ============================================================================================
     */
    public function addError(string $attribute, string $rule, $params = [])
    {
        $message = $this->errorMessages ()[$rule] ?? '';
        foreach ($params as $key => $value)
        {
            $message = str_replace ("{{$key}}", $value, $message);
        }
        $this->errors[$attribute][] = $message;
    }

    /**
     * ============================================================================================
     * Método que devuelve los mensajes de error por cada regla de validacion
     * @return string[]
     * ============================================================================================
     */
    public function errorMessages()
    {
        return [
            self::RULE_REQUIRED => 'This field is required',
            self::RULE_EMAIL => 'This field must be a valid email address',
            self::RULE_MIN => 'Min length of this field must be {min}',
            self::RULE_MAX => 'Max length of this field must be {max}',
            self::RULE_MATCH => 'This field must be the same as {match}',
        ];
    }

    public function hasError($attribute)
    {
        return $this->errors[$attribute] ?? false;
    }

    public function getFirstError($attribute)
    {
        return $this->errors[$attribute][0] ?? false;
    }
}