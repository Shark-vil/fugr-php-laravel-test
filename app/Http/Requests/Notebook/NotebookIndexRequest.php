<?php

namespace App\Http\Requests\Notebook;

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
