<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotebookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
					'id' => $request->id,
					'full_name' => $request->full_name,
					'company_name' => $request->company_name,
					'phone_number' => $request->phone_number,
					'email' => $request->email,
					'date_of_birth' => $request->date_of_birth,
					'photo_url' => $request->photo_url
				];
    }
}
