<?php

namespace App\Http\Requests\Notebook;

/**
 * @OA\Schema(
 *     title="NotebookUpdateRequest",
 *     description="Notebook store request",
 *     @OA\Xml(
 *         name="NotebookUpdateRequest"
 *     ),
 *		 @OA\Property(
 * 		 		property="full_name",
 *     		title="Full name",
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
 *     		format="email",
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
 * 		 		property="photo_file",
 *     		title="Photo file",
 *     		description="Image file",
 *     		format="binary",
 * 			  type="string"
 *		 )
 * )
 */
class NotebookUpdateRequest extends NotebookRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		$id = $this->route('id');

		return [
			'full_name' => 'string|max:200|nullable',
			'company_name' => 'string|max:200|nullable',
			'phone_number' => 'phone:RU|max:20|unique:notebooks,phone_number,' . $id . '|nullable',
			'email' => 'email:rfc|unique:notebooks,email,' . $id . '|nullable',
			'date_of_birth' => 'date|date_format:Y-m-d|nullable',
			'photo_file' => 'image|mimes:jpg,png,jpeg|max:2048|nullable'
		];
	}
}
