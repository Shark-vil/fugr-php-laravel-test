<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class Notebook extends Model
{
	use HasFactory;

	private $photosDirectoryPath = 'notebook/photos';

	protected $fillable = [
		'full_name',
		'company_name',
		'phone_number',
		'email',
		'date_of_birth'
	];

	public function savePhotoFromRequest(Request $request)
	{
		if ($request->hasFile('photo_file')) {
			$fileRequest = $request->file('photo_file');
			$fileExtension = $fileRequest->getClientOriginalExtension();
			$fileNameToStore = $this->id . '.' . $fileExtension;
			$fileRequest->storeAs('public/' . $this->photosDirectoryPath, $fileNameToStore);

			if (empty($this->photo_url)) {
				$this->photo_url = $this->photosDirectoryPath . '/' . $fileNameToStore;
				$this->save();
			}
		}
	}

	public function deletePhoto()
	{
		if (empty($this->photo_url)) return;

		$filePath = 'public/' . $this->photo_url;
		if (!Storage::exists($filePath)) return;

		Storage::delete($filePath);
	}
}
