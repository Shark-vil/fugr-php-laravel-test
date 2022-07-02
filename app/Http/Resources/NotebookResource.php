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
			'id' => $this->id,
			'full_name' => $this->full_name,
			'company_name' => $this->company_name,
			'phone_number' => $this->phone_number,
			'email' => $this->email,
			'date_of_birth' => $this->date_of_birth,
			'photo_url' => is_string($this->photo_url) ? asset('storage/' . $this->photo_url) : null
		];
	}
}
