<?php

namespace App\Http\Resources\V1;

use App\Utils\FieldFormatter;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $fields = ['id', 'login', 'is_admin'];

        return FieldFormatter::formatFieldsToCamelCase($this, $fields);
    }
}
