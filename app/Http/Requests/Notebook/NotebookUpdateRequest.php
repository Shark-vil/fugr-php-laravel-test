<?php

namespace App\Http\Requests\Notebook;

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
