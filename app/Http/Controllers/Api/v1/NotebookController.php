<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Notebook\NotebookPostRequest;
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

	public function store(NotebookPostRequest $request)
	{
		$notebook = Notebook::create($request->all());
		$notebook->saveAvatarFromRequest($request);
		return new NotebookResource($notebook);
	}

	public function update(NotebookUpdateRequest $request, int $id)
	{
		$notebook = Notebook::findOrFail($id);
		$notebook->update($request->all());
		$notebook->saveAvatarFromRequest($request);
		return new NotebookResource($notebook);
	}

	public function destroy(int $id)
	{
		$notebook = Notebook::findOrFail($id);
		$notebook->delete();
		return response(200);
	}
}
