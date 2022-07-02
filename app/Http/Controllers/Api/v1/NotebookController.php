<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Notebook\NotebookStoreRequest;
use App\Http\Requests\Notebook\NotebookUpdateRequest;
use App\Models\Notebook;
use App\Http\Resources\NotebookResource;

class NotebookController extends Controller
{
	public function index()
	{
		return NotebookResource::collection(Notebook::all());
	}

	public function show(int $id)
	{
		return new NotebookResource(Notebook::findOrFail($id));
	}

	public function store(NotebookStoreRequest $request)
	{
		$notebook = Notebook::create($request->all());
		$notebook->savePhotoFromRequest($request);
		return new NotebookResource($notebook);
	}

	public function update(NotebookUpdateRequest $request, int $id)
	{
		$notebook = Notebook::findOrFail($id);
		$notebook->update($request->all());
		$notebook->savePhotoFromRequest($request);
		return new NotebookResource($notebook);
	}

	public function destroy(int $id)
	{
		$notebook = Notebook::findOrFail($id);
		$notebook->deletePhoto();
		$notebook->delete();
		return response()->noContent();
	}
}
