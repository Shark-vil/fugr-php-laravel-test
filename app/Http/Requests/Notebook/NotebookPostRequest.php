<?php

namespace App\Http\Requests\Notebook;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class NotebookPostRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
		return true;
	}

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

	protected function failedValidation(Validator $validator)
	{
		$errors = (new ValidationException($validator))->errors();

		throw new HttpResponseException(
			response()->json(['errors' => $errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
		);
	}
}
