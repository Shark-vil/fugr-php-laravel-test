<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Notebook\NotebookStoreRequest;
use App\Http\Requests\Notebook\NotebookUpdateRequest;
use App\Http\Requests\Notebook\NotebookIndexRequest;
use App\Models\Notebook;
use App\Http\Resources\NotebookResource;
use App\Http\Resources\NotebookCollectionResource;

class NotebookController extends Controller
{
	/**
	 * @OA\Get(
	 *      path="/notebook",
	 *      operationId="indexNotebook",
	 *      tags={"Notebooks"},
	 *      summary="Listing all entries",
	 *      description="Returns a list of records from the database.",
	 *      @OA\Parameter(
	 *          name="limit",
	 *          in="query",
	 *          description="Number of records to display at a time (from 1 to 100)",
	 *          required=false
	 *      ),
	 *      @OA\Parameter(
	 *          name="page",
	 *          in="query",
	 *          description="Page number to display records",
	 *          required=false
	 *      ),
	 *      @OA\Response(
	 *          response=200,
	 *          description="Successful operation",
	 *          @OA\JsonContent(ref="#/components/schemas/NotebookCollectionResource")
	 *      )
	 * )
	 */
	public function index(NotebookIndexRequest $request)
	{
		$limit = math_clamp(intval($request->input('limit', 100)), 1, 100);
		$page = intval($request->input('page', 0));

		$records = Notebook::skip($page * $limit)
			->take($limit)
			->get();

		return new NotebookCollectionResource($records);
	}

	/**
	 * @OA\Get(
	 *      path="/notebook/{id}",
	 *      operationId="showNotebook",
	 *      tags={"Notebooks"},
	 *      summary="Displaying an existing entry",
	 *      description="Retrieves a record from the database by id.",
	 * 			@OA\Parameter(
	 *          name="id",
	 *          in="path",
	 *          description="Id",
	 *          required=true
	 *      ),
	 *      @OA\Response(
	 *          response=200,
	 *          description="Successful operation",
	 *          @OA\JsonContent(ref="#/components/schemas/NotebookResource")
	 *      ),
	 *      @OA\Response(
	 *          response=404,
	 *          description="Record not found",
	 *      )
	 * )
	 */
	public function show(int $id)
	{
		return new NotebookResource(Notebook::findOrFail($id));
	}

	/**
	 * @OA\Post(
	 *      path="/notebook",
	 *      operationId="storeNotebook",
	 *      tags={"Notebooks"},
	 *      summary="Adding an entry to the database",
	 *      description="Adds a new entry to the database.",
	 * 			@OA\RequestBody(
   *     		required=true,
   *     		description="Content",
   *     		@OA\MediaType(
	 *      		mediaType="multipart/form-data",
   *       		@OA\Schema(ref="#/components/schemas/NotebookStoreRequest")
   *     		)
   *   		),
	 *      @OA\Response(
	 *          response=200,
	 *          description="Successful operation",
	 *          @OA\JsonContent(ref="#/components/schemas/NotebookResource")
	 *      ),
	 *      @OA\Response(
	 *          response=422,
	 *          description="Unprocessable Content",
	 *      )
	 * )
	 */
	public function store(NotebookStoreRequest $request)
	{
		$notebook = Notebook::create($request->all());
		$notebook->savePhotoFromRequest($request);
		return new NotebookResource($notebook);
	}

	/**
	 * @OA\Post(
	 *      path="/notebook/{id}",
	 *      operationId="updateNotebook",
	 *      tags={"Notebooks"},
	 *      summary="Update an existing entry",
	 *      description="Updates the fields of a record in the database by ID.",
	 * 			@OA\Parameter(
	 *          name="id",
	 *          in="path",
	 *          description="Id",
	 *          required=true
	 *      ),
	 * 			@OA\RequestBody(
   *     		required=true,
   *     		description="Content",
   *     		@OA\MediaType(
	 *      		mediaType="multipart/form-data",
   *       		@OA\Schema(ref="#/components/schemas/NotebookUpdateRequest")
   *     		)
   *   		),
	 *      @OA\Response(
	 *          response=200,
	 *          description="Successful operation",
	 *          @OA\JsonContent(ref="#/components/schemas/NotebookResource")
	 *      ),
	 *      @OA\Response(
	 *          response=422,
	 *          description="Unprocessable Content",
	 *      ),
	 * 			@OA\Response(
	 *          response=404,
	 *          description="Record not found",
	 *      )
	 * )
	 */
	public function update(NotebookUpdateRequest $request, int $id)
	{
		$notebook = Notebook::findOrFail($id);
		$notebook->update($request->all());
		$notebook->savePhotoFromRequest($request);
		return new NotebookResource($notebook);
	}

	/**
	 * @OA\Delete(
	 *      path="/notebook/{id}",
	 *      operationId="destroyNotebook",
	 *      tags={"Notebooks"},
	 *      summary="Deleting an existing entry",
	 *      description="Deletes a record from the database by ID.",
	 * 			@OA\Parameter(
	 *          name="id",
	 *          in="path",
	 *          description="Id",
	 *          required=true
	 *      ),
	 *      @OA\Response(
	 *          response=204,
	 *          description="Successful operation",
	 *      ),
	 *      @OA\Response(
	 *          response=404,
	 *          description="Record not found",
	 *      )
	 * )
	 */
	public function destroy(int $id)
	{
		$notebook = Notebook::findOrFail($id);
		$notebook->deletePhoto();
		$notebook->delete();
		return response()->noContent();
	}
}
