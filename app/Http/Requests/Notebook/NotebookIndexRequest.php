<?php

namespace App\Http\Requests\Notebook;

/**
 * @OA\Schema(
 *     title="NotebookIndexRequest",
 *     description="Notebook store request",
 *     @OA\Xml(
 *         name="NotebookIndexRequest"
 *     ),
 *		 @OA\Property(
 * 		 		property="limit",
 *     		title="Number of records",
 *     		description="Number of records to display at a time (from 1 to 100)",
 *     		format="integer"
 *		 ),
 *		 @OA\Property(
 * 		 		property="page",
 *     		title="Page number",
 *     		description="Page number to display records",
 *     		format="integer"
 *		 )
 * )
 */
class NotebookIndexRequest extends NotebookRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'limit' => 'integer|max:100|min:1|nullable',
			'offset' => 'integer|min:0|nullable',
		];
	}
}
