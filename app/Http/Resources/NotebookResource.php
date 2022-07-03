<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="NotebookResource",
 *     description="Notebook resource",
 *     @OA\Xml(
 *         name="NotebookResource"
 *     ),
 * 		 @OA\Property(
 * 		 		property="id",
 *     		title="ID",
 *     		description="Record ID in the database",
 *     		format="int64",
 *     		example=1
 *		 ),
 *		 @OA\Property(
 * 		 		property="full_name",
 *     		title="FullName",
 *     		description="Full name of the person",
 *     		format="string",
 *     		example="Zubenko Mihail Petrovih"
 *		 ),
 *		 @OA\Property(
 * 		 		property="company_name",
 *     		title="Company name",
 *     		description="Company name",
 *     		format="string",
 *     		example="OOO Akhen"
 *		 ),
 *		 @OA\Property(
 * 		 		property="phone_number",
 *     		title="Phone number",
 *     		description="Phone number",
 *     		format="string",
 *     		example="+7-(926)-052-25-76"
 *		 ),
 *		 @OA\Property(
 * 		 		property="email",
 *     		title="Email",
 *     		description="Email address",
 *     		format="string",
 *     		example="posts@mail.ru"
 *		 ),
 *		 @OA\Property(
 * 		 		property="date_of_birth",
 *     		title="Date of Birth",
 *     		description="Person date of birth",
 *     		format="date",
 *     		example="2000-06-15"
 *		 ),
 *		 @OA\Property(
 * 		 		property="photo_url",
 *     		title="Photo url",
 *     		description="Web link to image",
 *     		format="string",
 *     		example="http://api.com/storage/notebook/photos/1.png"
 *		 )
 * )
 */
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
