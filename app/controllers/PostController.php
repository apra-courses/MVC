<?php

namespace App\Controllers;

use PDO;
use App\models\Post;
use App\Models\Comment;

require_once __DIR__ . '/../models/Post.php';
require_once __DIR__ . '/../models/Comment.php';

class PostController {

    private $layout = __DIR__ . '/../../layout/index.tpl.php';
    private $conn;
    private $post;
    private $comment;
    public $content;

    public function __construct(\PDO $conn) {
        $this->conn = $conn;
        $this->post = new Post($conn);
        $this->comment = new Comment($conn);
    }

    public function display() {
        require $this->layout;
    }

    public function getPosts() {
        $posts = $this->post->all();
        $this->content = view('posts', array('posts' => $posts));
    }

    public function show($postid) {
        $post = $this->post->find($postid);
        $comments = $this->comment->all($postid);
        $this->content = view('post', array('post' => $post, 'comments' => $comments));
    }

    public function create() {
        $this->content = view('newPost');
    }

    public function save() {
        $this->post->save($this->rawDataToPostModel($_POST));
        redirect("/");
    }

    public function store() {
        $this->post->update($this->rawDataToPostModel($_POST));
        redirect("/");
    }

    public function delete($id) {
        $this->post->delete($id);
        redirect("/");
    }

    public function edit($postid) {
        $post = $this->post->find($postid);
        $this->content = view('editPost', array('post' => $post));
    }

    public function saveComment($postid) {
        $comment = new Comment();
        $comment->setComment($_POST['comment']);
        $comment->setPost_id($postid);
        $comment->setEmail($_POST['email']);
        $this->comment->save($comment);

        redirect('/post/' . $postid);
    }

    private function rawDataToPostModel($rawData) {
        $post = new Post();
        $post->setId($rawData['id']);
        $post->setTitle($rawData['title']);
        $post->setMessage($rawData['message']);
        $post->setEmail($rawData['email']);
        $post->setDatecreated($rawData['datecreated']);
        return $post;
    }

}
