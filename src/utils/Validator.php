<?php

namespace Utils;

class Validator
{
    public function validate($data, $rules)
    {
        $errors = [];
        foreach ($rules as $field => $rule) {
            $rulesArray = explode('|', $rule);
            foreach ($rulesArray as $r) {
                if ($r === 'required' && empty($data[$field])) {
                    $errors[$field][] = "$field is required.";
                }
                if ($r === 'numeric' && isset($data[$field]) && !is_numeric($data[$field])) {
                    $errors[$field][] = "$field must be a numeric value.";
                }
                if ($r === 'date' && isset($data[$field]) && !strtotime($data[$field])) {
                    $errors[$field][] = "$field must be a valid date.";
                }
                if ($r === 'in:debit,credit' && isset($data[$field]) && !in_array($data[$field], ['debit', 'credit'])) {
                    $errors[$field][] = "$field must be either 'debit' or 'credit'.";
                }
            }
        }

        if (!empty($errors)) {
            http_response_code(400);
            echo json_encode(['status' => 400, 'errors' => $errors]);
            exit;
        }

        return $data;
    }
}
