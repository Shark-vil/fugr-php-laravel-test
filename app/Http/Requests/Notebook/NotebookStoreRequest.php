<?php

namespace App\Http\Requests\Notebook;

class NotebookStoreRequest extends NotebookRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'full_name' => 'required|string|max:200',
			'company_name' => 'string|max:200|nullable',
			'phone_number' => 'required|phone:RU|max:20|unique:notebooks',
			'email' => 'required|email:rfc|unique:notebooks',
			'date_of_birth' => 'date|date_format:Y-m-d|nullable',
			'photo_file' => 'image|mimes:jpg,png,jpeg|max:2048|nullable'
		];
	}
}
