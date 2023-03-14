<?php

namespace App\Traits;

trait ApiResponseTrait
{
  /**
   * 定義統一例外回應方法
   *
   * @param mixed $message 錯誤訊息
   * @param mixed $status HTTP狀態碼
   * @param mixed|null $code 錯誤編碼
   * @return \Illuminate\Http\Response
   */
  public function errorResponse($message, $status, $code = null)
  {
    $code = $code ?? $status;

    return response()->json(
      [
        'code' => $code,
        'message' => $message
      ],
      $status
    );
  }
}