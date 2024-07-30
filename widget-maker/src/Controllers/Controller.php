<?php 

namespace WidgetMaker\Controllers;

class Controller { 

    protected function jsonResponse(int $response_code, bool $success, array $data = [], string $message = '')
    {
        header('Content-Type: application/json');
        http_response_code($response_code);

        $response = [
            'success' => $success,
            'response_code' => $response_code,
            'message' => $message,
            'data' => $data,
        ];

        echo json_encode($response);
        exit();
    }

}