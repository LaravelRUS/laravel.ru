<?php namespace SU\Post\Models;

use SU\Core\Repository\BaseRepository;

class PostRepo extends BaseRepository {

	public function __construct(Post $post){

		$this->model = $post;
	}

	/**
	 * id автора поста
	 *
	 * @param int $post_id
	 * @return int
	 */
	public function getAuthorId($post_id)
	{
		return $this->model->where("id", $post_id)->get("author_id")->author_id;
	}

}