<?php
namespace Framework;

class Validation {
    protected $errors = [];
    
    /**
     * Validate required fields
     * 
     * @param array $data The data to validate
     * @param array $fields The required fields
     * @return bool Whether validation passed
     */
    public function required($data, $fields) {
        foreach ($fields as $field) {
            if (empty($data[$field])) {
                $this->addError($field, ucfirst(str_replace('_', ' ', $field)) . ' is required');
            }
        }
        
        return empty($this->errors);
    }
    
    /**
     * Validate email format
     * 
     * @param string $field The field name
     * @param string $value The value to validate
     * @param string $message Optional error message
     * @return bool Whether validation passed
     */
    public function email($field, $value, $message = null) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->addError($field, $message ?? 'Please enter a valid email address');
            return false;
        }
        
        return true;
    }
    
    /**
     * Validate minimum string length
     * 
     * @param string $field The field name
     * @param string $value The value to validate
     * @param int $min The minimum length
     * @param string $message Optional error message
     * @return bool Whether validation passed
     */
    public function minLength($field, $value, $min, $message = null) {
        if (strlen($value) < $min) {
            $this->addError($field, $message ?? "Field must be at least $min characters");
            return false;
        }
        
        return true;
    }
    
    /**
     * Validate maximum string length
     * 
     * @param string $field The field name
     * @param string $value The value to validate
     * @param int $max The maximum length
     * @param string $message Optional error message
     * @return bool Whether validation passed
     */
    public function maxLength($field, $value, $max, $message = null) {
        if (strlen($value) > $max) {
            $this->addError($field, $message ?? "Field cannot exceed $max characters");
            return false;
        }
        
        return true;
    }
    
    /**
     * Validate that a value matches a pattern
     * 
     * @param string $field The field name
     * @param string $value The value to validate
     * @param string $pattern Regular expression pattern
     * @param string $message Optional error message
     * @return bool Whether validation passed
     */
    public function match($field, $value, $pattern, $message = null) {
        if (!preg_match($pattern, $value)) {
            $this->addError($field, $message ?? 'Field format is invalid');
            return false;
        }
        
        return true;
    }
    
    /**
     * Validate that a field matches another field (e.g., password confirmation)
     * 
     * @param string $field The field name
     * @param string $value The field value
     * @param string $matchField The field to match against
     * @param array $data The data array containing both fields
     * @param string $message Optional error message
     * @return bool Whether validation passed
     */
    public function matchField($field, $value, $matchField, $data, $message = null) {
        if ($value !== $data[$matchField]) {
            $this->addError($field, $message ?? 'Fields do not match');
            return false;
        }
        
        return true;
    }
    
    /**
     * Validate a numeric value
     * 
     * @param string $field The field name
     * @param mixed $value The value to validate
     * @param string $message Optional error message
     * @return bool Whether validation passed
     */
    public function numeric($field, $value, $message = null) {
        if (!is_numeric($value)) {
            $this->addError($field, $message ?? 'Field must be a number');
            return false;
        }
        
        return true;
    }
    
    /**
     * Validate value is in a list of allowed values
     * 
     * @param string $field The field name
     * @param mixed $value The value to validate
     * @param array $allowedValues Array of allowed values
     * @param string $message Optional error message
     * @return bool Whether validation passed
     */
    public function inList($field, $value, $allowedValues, $message = null) {
        if (!in_array($value, $allowedValues)) {
            $this->addError($field, $message ?? 'Selected value is not valid');
            return false;
        }
        
        return true;
    }
    
    /**
     * Validate value is not in a list of disallowed values
     * 
     * @param string $field The field name
     * @param mixed $value The value to validate
     * @param array $disallowedValues Array of disallowed values
     * @param string $message Optional error message
     * @return bool Whether validation passed
     */
    public function notInList($field, $value, $disallowedValues, $message = null) {
        if (in_array($value, $disallowedValues)) {
            $this->addError($field, $message ?? 'Selected value is not allowed');
            return false;
        }
        
        return true;
    }
    
    /**
     * Validate date format
     * 
     * @param string $field The field name
     * @param string $value The value to validate
     * @param string $format The date format (default: Y-m-d)
     * @param string $message Optional error message
     * @return bool Whether validation passed
     */
    public function date($field, $value, $format = 'Y-m-d', $message = null) {
        $date = \DateTime::createFromFormat($format, $value);
        
        if (!$date || $date->format($format) !== $value) {
            $this->addError($field, $message ?? 'Please enter a valid date');
            return false;
        }
        
        return true;
    }
    
    /**
     * Validate password strength
     * 
     * @param string $field The field name
     * @param string $value The value to validate
     * @param string $message Optional error message
     * @return bool Whether validation passed
     */
    public function password($field, $value, $message = null) {
        // At least 8 characters
        if (strlen($value) < 8) {
            $this->addError($field, $message ?? 'Password must be at least 8 characters long and contain uppercase, lowercase, number, and special character');
            return false;
        }
        
        // Check for uppercase, lowercase, number, and special character
        $patterns = [
            'uppercase' => '/[A-Z]/',
            'lowercase' => '/[a-z]/',
            'number' => '/[0-9]/',
            'special' => '/[^a-zA-Z0-9]/'
        ];
        
        foreach ($patterns as $pattern) {
            if (!preg_match($pattern, $value)) {
                $this->addError($field, $message ?? 'Password must be at least 8 characters long and contain uppercase, lowercase, number, and special character');
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * Sanitize data to prevent XSS
     * 
     * @param mixed $data The data to sanitize
     * @return mixed Sanitized data
     */
    public function sanitize($data) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = $this->sanitize($value);
            }
            return $data;
        }
        
        // Convert special characters to HTML entities
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
    
    /**
     * Add an error message
     * 
     * @param string $field The field name
     * @param string $message The error message
     * @return void
     */
    protected function addError($field, $message) {
        $this->errors[$field] = $message;
    }
    
    /**
     * Get all error messages
     * 
     * @return array The error messages
     */
    public function getErrors() {
        return $this->errors;
    }
    
    /**
     * Get a specific error message
     * 
     * @param string $field The field name
     * @return string|null The error message or null if no error
     */
    public function getError($field) {
        return $this->errors[$field] ?? null;
    }
    
    /**
     * Check if validation has errors
     * 
     * @return bool Whether validation has errors
     */
    public function hasErrors() {
        return !empty($this->errors);
    }
    
    /**
     * Create a custom validation rule
     * 
     * @param string $field The field name
     * @param mixed $value The value to validate
     * @param callable $function The validation function
     * @param string $message Optional error message
     * @return bool Whether validation passed
     */
    public function custom($field, $value, $function, $message = null) {
        if (!$function($value)) {
            $this->addError($field, $message ?? 'Field validation failed');
            return false;
        }
        
        return true;
    }
}