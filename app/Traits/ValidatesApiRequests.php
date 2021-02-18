<?php
namespace App\Traits;
use Illuminate\Support\Facades\Validator;
//use App\Http\Requests\LocationRequest;
trait ValidatesApiRequests
{
    protected $payload;
    protected $rules;
    protected $messages;

    protected function validateRequest()
    {
        $validator = Validator::make($this->payload, $this->rules, $this->messages);
        if($validator->fails())
        {
            return json_decode($validator->errors()->all());
        }
    }
}

?>