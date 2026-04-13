<?php

namespace App\Traits;

trait ApiResponse
{
    protected function respond($data = null, $status = 200, $message = null)
    {
        $response = [
            'status' => $status,
            'message' => $message ?? 'Success',
            'data' => $data,
        ];

        return $this->response->setJSON($response)->setStatusCode($status);
    }

    protected function respondSuccess($data, $message = 'Success', $status = 200)
    {
        return $this->respond($data, $status, $message);
    }

    protected function respondError($error, $status = 400, $data = null)
    {
        return $this->respond($data, $status, $error);
    }

    protected function respondNotFound($message = 'Resource not found')
    {
        return $this->respondError($message, 404);
    }

    protected function respondUnauthorized($message = 'Unauthorized')
    {
        return $this->respondError($message, 401);
    }

    protected function respondForbidden($message = 'Forbidden')
    {
        return $this->respondError($message, 403);
    }

    protected function respondValidationError($errors)
    {
        return $this->respondError('Validation error', 422, ['errors' => $errors]);
    }
}
