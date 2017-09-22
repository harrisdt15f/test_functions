<?php

/**
File:		KlinValidator.php
Version:	0.1
Auhor:		Akeem Aweda [akeem@aweklin.com or aweklin@yahoo.com]
Description:This is a very simple and basic class, primarily aims to validate HTML form based on the $_POST method or any other array object.
The class uses regular expressions and some php built-in validation techniques
 */
class KlinValidator {

	// regular expressions that will be used
	private $regexes = [
		'required' => ['rule' => "[a-z0-9A-Z]+", 'msg' => 's% cannot be empty'],
		'alphanum' => ['rule' => "^[0-9a-zA-Z ,.-_\\s\?\!]+\$", 'msg' => 'The value in s% is not a valid alpha-numeric'],
		'date' => ['rule' => "^[0-9]{4}[-/][0-9]{1,2}[-/][0-9]{1,2}\$", 'msg' => 'The value in s% is invalid date'],
		'number' => ['rule' => "^[-]?[0-9,]+\$", 'msg' => 'The value in s% is invalid number'],
		'price' => ['rule' => "^[0-9.,]*(([.,][-])|([.,][0-9]{2}))?\$", 'msg' => 'The value in s% is invalid price'],
		'int' => ['rule' => "", 'msg' => 'The value in s% is not a valid integer'],
		'float' => ['rule' => "", 'msg' => 'The value in s% is not a valid decimal'],
		'bool' => ['rule' => "", 'msg' => 'The value in s% is not a valid boolean'],
		'ip' => ['rule' => "", 'msg' => 'The value in s% is not a valid ip'],
		'minlen' => ['rule' => "", 'msg' => 'The length of characters in s% cannot be less than d%'],
		'maxlen' => ['rule' => "", 'msg' => 'The length of characters in s% cannot be more than d%'],
		'exactlen' => ['rule' => "", 'msg' => 'The length of characters in s% must be exactly d%'],
		'email' => ['rule' => "", 'msg' => 'The value in s% is invalid e-mail'],
		'matches' => ['rule' => "", 'msg' => 'The value in s% does not match d%'],
		'url' => ['rule' => "", 'msg' => 'The value in s% is invalid url'],
	];

	// where validation rules are stored
	private $validations = [];

	public $validationErrors = '';


    /**
     * * Add validation rule(s) to the given field. This is a chanable method.
     *
     * Note that a field must be unique in the $this->validations object.
     *
     * @param string $field Field to be validated
     * @param string $displayName The human friendly name for the given field
     * @param array $rules Rule(s) to apply to the given field
     * @return $this
     */
    public function addRules($field, $displayName, $rules = []) {
		if (!empty($field) && !empty($rules)) {
			if (empty($displayName)) {
				$displayName = $field;
			}

			if (!array_key_exists($field, $this->validations)) {
				$this->validations[$field] = ['displayName' => $displayName, 'rules' => $rules];
			}
		}

		return $this;
	}

	/**
	 *
	 * Returns a true/false indicating the success or failure of the model validation.
	 *
	 * @param array @items The items to be validated. This in most cases, would be $_POST.
	 *
	 * @return boolean
	 */
	public function validated($items) {
		if (empty($this->validations)) {
			return true;
		} else {

			$isValid = true;
			$this->validationErrors = '';

			foreach ($items as $key => $value) {
				if (array_key_exists($key, $this->validations)) {
					$rules = $this->validations[$key]['rules'];

					foreach ($rules as $rule) {
						$braceLocation = mb_strpos($rule, '[');
						$ruleArray = [];
						$param = '';
						$pattern = '';

						if ($braceLocation) {
							$ruleArray = explode('[', $rule);
							$rule = $ruleArray[0];
							$param = str_replace(']', '', $ruleArray[1]);
						} else {
							$pattern = $this->regexes[$rule]['rule'];
						}

						switch ($rule) {
						case 'email':
							$isValid = filter_var($value, FILTER_VALIDATE_EMAIL);
							break;
						case 'url':
							$isValid = filter_var($value, FILTER_VALIDATE_URL);
							break;
						case 'ip':
							$isValid = filter_var($value, FILTER_VALIDATE_IP);
							break;
						case 'int':
							$isValid = filter_var($value, FILTER_VALIDATE_INT);
							break;
						case 'float':
							$isValid = filter_var($value, FILTER_VALIDATE_FLOAT);
							break;
						case 'bool':
							$isValid = filter_var($value, FILTER_VALIDATE_BOOLEAN);
							break;
						case 'minlen':
							$isValid = (empty($value) ? false : strlen($value) >= (int) $param);
							break;
						case 'maxlen':
							$isValid = (empty($value) ? false : strlen($value) <= (int) $param);
							break;
						case 'exactlen':
							$isValid = (empty($value) ? false : strlen($value) === (int) $param);
							break;
						case 'matches':
							$isValid = (empty($value) ? false : $value === $items[$param]);
							break;
						default:
							$isValid = filter_var($value, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '!' . $pattern . '!i'))) !== false;
							break;
						}

						if ($isValid === false) {
							$message = str_replace('s%', $this->validations[$key]['displayName'], $this->regexes[$rule]['msg']) . '<br>';
							if ($braceLocation != -1) {
								$message = str_replace('d%', $param, $message);
							}
							$this->validationErrors .= $message;
						}
					}
				}
			}

			return $isValid;
		}
	}
}

$test = new KlinValidator();
