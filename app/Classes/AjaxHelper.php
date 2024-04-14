<?php

namespace App\Classes;

class AjaxHelper
{
    /**
     * response
     * @var array
     */
    private static array $response = [];

    /**
     * add error
     * @param string $key
     * @param string|array $error
     * @return void
     */
    public static function addError(string $key, $error): void
    {
        //        self::$response['errors'] = [];
        self::$response['errors'][$key] = $error;

    }

    /**
     * add array with errors
     * @param array $errors
     * @return void
     */
    public static function addErrors(array $errors): void
    {
        if ($errors) {
            foreach ($errors as $key => $error) {
                self::addError($key, $error);
            }
        }
    }

    /**
     * add custom response to responses array
     * @param string|null $action
     * @param string|null $key
     * @param string|null $value
     * @param string|null $attrName
     * @return void
     */
    public static function addResponse(?string $action = null, ?string $key = null, ?string $value = null, ?string $attrName = null): void
    {
        self::$response['res'][] = [
            'action' => $action,
            'key' => $key,
            'value' => $value,
            'attrName' => $attrName
        ];
    }

    /**
     * return custom response
     * @param string|null $action
     * @param string|null $key
     * @param string|null $value
     * @param string|null $attrName
     * @return \Illuminate\Http\JsonResponse
     */
    public static function returnResponse(?string $action = null, ?string $key = null, ?string $value = null, ?string $attrName = null)
    {
        self::addResponse($action, $key, $value, $attrName);
        return self::endAjax();
    }

    /**
     * return single error
     * @param string $error
     * @return \Illuminate\Http\JsonResponse
     */
    public static function returnError(string $error)
    {
        self::addError('error', $error);
        return self::endAjax();
    }

    /**
     * return array with errors
     * @param array $errors
     * @return \Illuminate\Http\JsonResponse
     */
    public static function returnErrors(array $errors)
    {
        if ($errors) {
            foreach ($errors as $key => $error) {
                self::addError($key, $error);
            }
        }
        return self::endAjax();
    }

    /**
     * end ajax and return json response
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public static function endAjax(int $status = 200)
    {
        self::processErrors();
        return response()->json(self::$response, $status);
    }

    /**
     * All errors from array to single string
     * @return void
     */
    private static function processErrors()
    {
        if (isset(self::$response['errors'])) {
            $errors = '';
            if (is_array(self::$response['errors'])) {
                foreach (self::$response['errors'] as $error) {
                    if (is_array($error)) {
                        $errorString = implode('"<br>\n-', $error);
                    } else {
                        $errorString = $error;
                    }
                    $errors .= "- $errorString<br>\n";
                }
            } else {
                $errors = self::$response['errors'] . "<br>\n";
            }
            self::$response['errors'] = $errors;
        }
    }
}
