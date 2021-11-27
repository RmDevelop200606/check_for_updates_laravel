<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class AlphaRule implements Rule
{
  public function __construct()
  {
    //
  }

  public function passes($attribute, $value)
  {
    //
    return preg_match('/^[!-~]+$/', $value);
  }

  public function message()
  {
    return 'キーワードは半角英数字記号で入力してください';
  }
}