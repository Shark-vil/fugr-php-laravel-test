<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\NotebookResource;
use App\Models\Notebook;

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
			'left' => $left,
			'count' => $count,
			'data' => $this->collection,
		];
	}
}
