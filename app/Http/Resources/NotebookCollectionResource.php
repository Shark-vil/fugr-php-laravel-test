<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\NotebookResource;
use App\Models\Notebook;

/**
 * @OA\Schema(
 *     title="NotebookCollectionResource",
 *     description="Notebook collection resource",
 *     @OA\Xml(
 *         name="NotebookCollectionResource"
 *     ),
 * 		 @OA\Property(
 * 		 		property="total",
 *     		title="Total",
 *     		description="Number of records in the database",
 *     		format="int",
 *     		example=10
 *		 ),
 *		 @OA\Property(
 * 		 		property="page",
 *     		title="Page",
 *     		description="Current page number selected",
 *     		format="int",
 *     		example=5
 *		 ),
 *		 @OA\Property(
 * 		 		property="limit",
 *     		title="Limit",
 *     		description="The number of records that can be displayed",
 *     		format="int",
 *     		example=100
 *		 ),
 *		 @OA\Property(
 * 		 		property="left",
 *     		title="Left",
 *     		description="Number of remaining available pages",
 *     		format="int",
 *     		example=0
 *		 ),
 *		 @OA\Property(
 * 		 		property="count",
 *     		title="Count",
 *     		description="Number of records displayed",
 *     		format="int",
 *     		example=1
 *		 ),
 *		 @OA\Property(
 * 		 		property="data",
 *     		type="array",
 *     		@OA\Items(ref="#/components/schemas/NotebookResource")
 *		 )
 * )
 */
class NotebookCollectionResource extends ResourceCollection
{
	public $collects = NotebookResource::class;

	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
	 */
	public function toArray($request)
	{
		$total = Notebook::count();
		$count = $this->collection->count();
		$page = (int)$request->input('page', 0);
		$limit = (int)$request->input('limit', 100);
		$left = (int)(($total / $limit) - $page);

		return [
			'total' => $total,
			'page' => $page,
			'limit' => $limit,
			'left' => max(0, $left),
			'count' => $count,
			'data' => $this->collection,
		];
	}
}
