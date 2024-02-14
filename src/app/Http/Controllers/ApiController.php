<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;


class ApiController extends BaseController
{
    public function sendApiRequest(Request $request) {
        $params = $request->post();

        $access_token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImU0ZDgyMzJhZjNiNmYwOTJmYzkzNjYxMGFjMjEyM2RiNDcxZDUwYWUzYWY2YWU2ZmEzYWQ5ODI0ZjE2YTRkMzM1YjJiN2E1NzYxMDFmZDhlIn0.eyJhdWQiOiI0NjgwYjViZS0zYTkzLTQ0YjQtOWZmMy1lODczZTZiYjBmY2EiLCJqdGkiOiJlNGQ4MjMyYWYzYjZmMDkyZmM5MzY2MTBhYzIxMjNkYjQ3MWQ1MGFlM2FmNmFlNmZhM2FkOTgyNGYxNmE0ZDMzNWIyYjdhNTc2MTAxZmQ4ZSIsImlhdCI6MTcwNzkzNzA0NywibmJmIjoxNzA3OTM3MDQ3LCJleHAiOjE3MTI0NDgwMDAsInN1YiI6IjEwNjYzMjUwIiwiZ3JhbnRfdHlwZSI6IiIsImFjY291bnRfaWQiOjMxNTYzODk0LCJiYXNlX2RvbWFpbiI6ImFtb2NybS5ydSIsInZlcnNpb24iOjIsInNjb3BlcyI6WyJjcm0iLCJmaWxlcyIsImZpbGVzX2RlbGV0ZSIsIm5vdGlmaWNhdGlvbnMiLCJwdXNoX25vdGlmaWNhdGlvbnMiXSwiaGFzaF91dWlkIjoiNjcxNGY4ZDItZGVkNS00Y2ZlLTg1ODktYmEzYTIyMTI3ZTI3In0.JAqxaAaFVPVJPvu2Hrhv5q2Oiytc6oPqirW9BAJQKnqZMBJFnI6YjV0P5LqIVZf7N8rvw9uAdaLPhx8Q6_AOtka-9ueEt8dHGndRnSl2R8GRPqr8dSy35jDlaAwrDDhKmQIoWYyTbUiLuUI6WAVCa-deQbUFQiyOpgNRDBP_bsuNQk8zXQgqdahXtVsKInkQV-uN7lnWUfBDHOK2Hs2UIshJ0QjtrZCPGHFlyQY4C_8-xkmu-B53CAJwBrzmg3TJ6nTIHY7OkvG0Xii7QqNTDEkP9KsuhLWXJ4PbPUisxCxB3vrlXBpgM6GDoTdwKbkOImM2lUAA2q2ji9ZrOQOnsg';
        $subdomain = 'lelyasoboleva1998';
        $link = 'https://' . $subdomain . '.amocrm.ru/api/v4/leads/complex';
        $headers = [
            'Authorization: Bearer ' . $access_token
        ];
        $body = [
            [
                'price' => intval($params['price']),
                '_embedded' => [
                    'contacts' => [
                        [
                            'first_name' => $params['username'],
                             "custom_fields_values" => [
                                [
                                   "field_id" => 217333,
                                   "values" => [
                                      [
                                         "value" => $params['longer_than_30_sec']
                                      ]
                                   ]
                                ],
                                [
                                    "field_code" => "EMAIL",
                                    "values" => [
                                        [
                                            "enum_code" => "WORK",
                                            "value" => $params['email']
                                        ]
                                    ]
                                ],
                                [
                                    "field_code" => "PHONE",
                                    "values" => [
                                        [
                                            "enum_code" => "WORK",
                                            "value" => $params['phone']
                                        ]
                                    ]
                                ],
                             ]
                        ]
                    ]
                ]
            ]
        ];
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl,CURLOPT_USERAGENT,'amoCRM-oAuth-client/1.0');
        curl_setopt($curl,CURLOPT_URL, $link);
        curl_setopt($curl,CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl,CURLOPT_HEADER, false);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, 1);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curl,CURLOPT_POSTFIELDS, json_encode($body));

        $out = curl_exec($curl);
        $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);
        $code = (int)$code;
        $errors = [
            400 => 'Bad request',
            401 => 'Unauthorized',
            403 => 'Forbidden',
            404 => 'Not found',
            500 => 'Internal server error',
            502 => 'Bad gateway',
            503 => 'Service unavailable',
        ];

        try
        {
            if ($code < 200 || $code > 204) {
                throw new Exception(isset($errors[$code]) ? $errors[$code] : 'Undefined error', $code);
            }
            return response()->json(['success' => 'success', 200]);
        } catch(\Exception $e)
        {
            die('Ошибка: ' . $e->getMessage() . PHP_EOL . 'Код ошибки: ' . $e->getCode());
        }

    }
}
