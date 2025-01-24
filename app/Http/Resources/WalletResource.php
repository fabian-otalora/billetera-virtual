<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WalletResource extends JsonResource
{
    private $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->data
        ];
    }

    // /**
    //  * Transform the resource into an array.
    //  *
    //  * @return array<string, mixed>
    //  */
    // public function toArray(Request $request): array
    // {
    //     return parent::toArray($request);
    // }
}
