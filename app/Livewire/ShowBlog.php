<?php

namespace App\Livewire;

use App\Models\Article;
use App\Models\Category;
use Livewire\Attributes\Url;
use Livewire\Component;


class ShowBlog extends Component
{


    #[Url]
    Public $categorySlug = null;

    public function render()
    {

        $categories = Category::all();
        // $paginate = 10;

        if(!empty($this->categorySlug))
        {
            $category = Category::where('slug',$this->categorySlug)->first();

                if (empty($category))
                {
                    abort(404);
                }
                else
                {


            $articles = Article::orderBy('created_at','DESC')
                        ->where('category_id',$category->id)
                        // ->where('status',1)
                        ->paginate(6);
            }
        }
        else
        {
            $articles = Article::orderBy('created_at','DESC')
                        ->paginate(6)
                        // ->where('status',1)
                        ;
        }

            $latestArticles = Article::orderBy('created_at','DESC')
                             ->get()
                            //  ->where('status',1)
                             ->take(3);





        return view('livewire.show-blog',[
            'articles' => $articles,
            'categories' => $categories,
            'latestArticles' => $latestArticles
        ]);

    }
}
