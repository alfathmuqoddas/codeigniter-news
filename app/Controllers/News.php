<?php

namespace App\Controllers;

use App\Models\NewsModel;
use CodeIgniter\Controller;

class News extends Controller
{
	public function index()
	{

	    echo view('templates/header');
	    echo view('news/overview');
	    echo view('templates/footer');
	}

	public function view($slug)
	{
		$model = new NewsModel();
		$data['news'] = $model -> getNews($slug);

		if (empty($data['news'])) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the news item: ' . $slug);
		}

		$data['title'] = $data['news']['title'];
		$data['slug'] = $slug;

		echo view('templates/header', $data);
		echo view('news/view', $data);
		echo view('templates/footer', $data);
	}

	public function create()
	{
	    $model = new NewsModel();

	    if ($this->request->getMethod() === 'post' && $this->validate([
	        'title' => 'required|min_length[3]|max_length[255]',
	        'body'  => 'required',
	    ])) {
	        $model->save([
	            'title' => $this->request->getPost('title'),
	            'slug'  => url_title($this->request->getPost('title'), '-', true),
	            'body'  => $this->request->getPost('body'),
	        ]);

	        echo view('news/success');
	    } else {
	        echo view('templates/header', ['title' => 'Create a news item']);
	        echo view('news/create');
	        echo view('templates/footer');
	    }
	}
}