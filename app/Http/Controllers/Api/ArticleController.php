<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AdditionalField;
use App\Models\Article;
use App\Models\DeviceToken;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Validator;
use Socialite;
use App\Models\Category;
use App\Models\Comment;

class ArticleController extends Controller
{

    public function str_replace_n_new($search, $replace, $subject, $occurrence)
    {
        $s = $subject;
        $counter = 1;
        $s = preg_replace_callback("/".$search."/", function ($m) use (&$counter,$occurrence,$replace) {
        
             #-- replacement for 2nd occurence of "abc"
             if ($counter++ == $occurrence) {
                  return $replace;
             }
        
             #-- else leave current match
             return $m[0];
        
        }, $s);
        return $s;
    }
        public function save_article(Request $request)
        {
           
            $validator = Validator::make($request->all(), [
                'image' => 'max:5000',
            ]);


            $user=auth('api')->user();
            $category=Category::find($request->category_id);
            if($validator->fails()){
                return response()->json($validator->errors(), 422);
            }
            /*if(strtolower($category->name)=='video film')

            {
            $url=preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"100%\" height=\"100%\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",$request->content);
            preg_match('/src="([^"]+)"/', $url   , $match);
       
             if(count($match)==0)
             {
                return response()->json(['message' => 'Please Enter Vaild Url'], 422);
 
             }
            }*/
            






        if($request->hasFile('image'))
        {

         
        $image = time().'.'.$request->image->extension();

        $request->image->move(public_path('images'.'/'.$user->id.'/'.str_replace(' ', '_', strtolower($category->name)).'/image/'), $image); 
        $path=('images'.'/'.$user->id.'/'. str_replace(' ', '_', strtolower($category->name)).'/image/').$image;

        }
        if($request->has('content'))
        {
           

        if(  strtolower($category->name)!='video film' && strtolower($category->name)!='article' && !is_null($request->file('content')))
        {
        $content = time().'.'.$request->content->extension();
       
        $request->content->move(public_path('images'.'/'.$user->id.'/'. str_replace(' ', '_', strtolower($category->name)).'/content/'), $content); 
        $content_path=('images'.'/'.$user->id.'/'. str_replace(' ', '_', strtolower($category->name)).'/content/').$content;
        }
        elseif(strtolower($category->name)=='video film')

        {
            if (str_contains($request->content, 'watch')) { 
            $url=preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i","<iframe width=\"100%\" height=\"100%\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",$request->content);
            preg_match('/src="([^"]+)"/', $url   , $match);
             $url = $match[1];
               }else{
                $url="//www.youtube.com/embed/".substr($request->content,17);

            }
            $content_path=$url;
        }
        elseif(strtolower($category->name)=='article')

        {
        $content_path='tests';
        }
        else if(strtolower($category->name)=='book' && is_null($request->file('content')))
        {
            $content_path='tests';
        }



        }
        if(isset($request->cost))
        {
            $cost=$request->cost;
        }
        else
        {
            $cost=0;
        }
        $article=Article::create([
        'user_id'=>$user->id,
        'title'=>$request->title,
        'description'=>$request->description,
        'purchase_type'=>$request->purchase_type,
        'category_id'=>$request->category_id,
        'content'=>$content_path,
        'cost'=>$cost,
        'image'=>$path]);
        Article::where('id',$article->id)->update(['url'=>'api/article/'.$article->id]);
     


        if(strtolower($category->name)=='article' || (strtolower($category->name)=='book' && is_null($request->file('content'))))

        {
            
        preg_match_all('/@[a-zA-Z0-9 .!?"-]*#/', $request->content, $matches);
        $text=$request->content;

        foreach(array_count_values($matches[0]) as $value=>$key)
        {

        for ($i = 1; $i <=($key); $i++) {
            $color=   '#' . dechex(rand(0,10000000));

        $newText = "<p class='add-comment-tag' style='color:".$color.";display:inline;' data-index=".$i.">".$value."</p>";  

        $text=$this->str_replace_n_new( $value, $newText, $text, $i);


        }
       

        $username= str_replace("@", "",$value);
        $username=str_replace("#", "", $username);
        $find=User::where('username',$username)->orWhere('name',$username)->first();
        if(!is_null($find))
        {
           $users=User::find($find->id);
          $article->tagged_people()->attach($users);
        }
  
         }
        $re = '/<([^>\s]+)[^>]*>(?:\s*(?:<br \/>|&nbsp;|&thinsp;|&ensp;|&emsp;|&#8201;|&#8194;|&#8195;)\s*)*<\/\1>/m';
        $subst = '';
        $text = preg_replace($re, $subst, $text);

        $file =  $article->id.'.html';
        $data = $text;
        file_put_contents($file, $data);
        $content =$file;
        
        \Storage::disk('public')->put('documents', $content);
        $article->update(['content'=> $file]);

       
         }
        if($request->has('additional_fields')){
            
            foreach($request->additional_fields as $additional_field)
            {
                $additional_fields = AdditionalField::find(intval(filter_var($additional_field['id'], FILTER_SANITIZE_NUMBER_INT)));
                $article->article_additional_fields()->attach($additional_fields,[
                    'value' => $additional_field['value']]);
            }
      

        }

        if($request->has('tagged_people')){
        $users = User::find($request->tagged_people);
        $article->tagged_people()->attach($users);

        }
        //save tags

            if($request->has('tags'))
            {
            foreach($request->tags as $tag_article)
            {

            if(!is_null($tag_article))
            {
            $tag= \DB::table('tags')->where('tag',$tag_article)->first();
            if(is_null( $tag))
            {
            $tag=\DB::table('tags')->insertGetId(['tag'=>$tag_article]);

            \DB::table('tags_article')->insert(['article_id'=>$article->id,'tag_id'=> $tag]);

            }
            else
            {
            \DB::table('tags_article')->insert(['article_id'=>$article->id,'tag_id'=> $tag->id]);

            }

            }

            }

            }
        $data=['name'=>'http://api_rwrite.momentum-sol.com/api/article/'.$article->id];
     
        \Mail::send('emails.email_admin', $data, function ($message)  {
            $message->to('info@r-write.com')->subject('R-Write: Article Review');
            $message->from('info@r-write.com', 'R-Write');
        });
        return response()->json([
        'message' => 'Article Saved successfully',
        'article'=>$article,
        'add'=>$request->additional_fields
        ], 200);
        }

        public function get($id)
        {
            $article=Article::find($id);
         
            if(strtolower($article->category->name)=='article')$this->update_comment_colors($article);

            return view ('article',compact('article'));

        }

        public function update_comment_colors($article)
        {
      
            $content=\File::get(public_path($article->content));
            
            $text =  $content;
            $doc = new \DOMDocument();
            @$doc->loadHTML($text);
            
            for( $i=0;$i<count($doc->getElementsByTagName('div'));$i++) {
                $div=$doc->getElementsByTagName('div')[$i];
                $value=$div->nodeValue;
                $index=$div->getAttribute('data-index');
    
    
             $tagged_name = str_replace("@", "", $value);
             $tagged_name = str_replace("#", "", $tagged_name);
             $tagged_name = str_replace("|", "", $tagged_name);
             $tagged_name = ltrim($tagged_name);
         
            $tagged= Comment::where('article_id',$article->id)->where('tagged_name',$tagged_name)->where('index',$index)->first();
            $registered_names=User::where('username',$tagged_name)->first();
    
            if($div->getAttribute( 'class' )=='add_comment')
            {
                if(!is_null($tagged))
                {
    
                
                foreach ($div->childNodes as $img) {
                    if($img->nodeName=='img')
                    {
                        $img->setAttribute('src', '/images/Red.svg');
                    }
              
                }
            
              
                $doc->getElementsByTagName('div')[$i-1]->setAttribute( 'class' ,'comment_red_main');
                 $div->setAttribute('class', 'comment_red');
            }
            }
            else if($div->getAttribute( 'class')=='send_invitation')
        {
    
            if(!is_null($registered_names))
            {
    
            
            foreach ($div->childNodes as $img) {
                if($img->nodeName=='img')
                {
                    $img->setAttribute('src', '/images/blue.png');
                }
          
            }
        
          
            $doc->getElementsByTagName('div')[$i-1]->setAttribute('class' ,'add_comment_main');
             $div->setAttribute('class', 'add_comment');
        }
    
        }
           
              
               
            }
            $text= trim($doc->saveHTML()); 
    
          
    // dd( $text);
    
    \File::delete($article->id . '.html');
    
    $file =  $article->id . '.html';
    $data = $text;
    file_put_contents($file, $data);
    $content = $file;
    
    \Storage::disk('public')->put('documents', $content);
    
    //  dd($text);
    
        }

            public function article_get($id)
            {
            $article=Article::where('id',$id)->with('user')->with('category')->when(auth('api')->user(), function ($query)  {
                $query->with(['purchased' => function ($hasMany)  {


                return $hasMany->select(  \DB::raw('(CASE WHEN purchased_articles.user_id = ' .  auth('api')->user()->id . ' THEN true ELSE false END) AS purchased'));
                }]);  
                })->with('tags')->with('article_additional_fields')->where('show',1)->where('approved',1)->orderBy('created_at', 'DESC')->first();

            return response()->json([
            'message' => 'Article Returned successfully',
            'data'=>$article
            ], 200);


            }


            public function article_get_user($id)
            {
            $article=Article::where('id',$id)->with('user')->with('category')->when(auth('api')->user(), function ($query)  {
                $query->with(['purchased' => function ($hasMany)  {


                return $hasMany->select(  \DB::raw('(CASE WHEN purchased_articles.user_id = ' .  auth('api')->user()->id . ' THEN true ELSE false END) AS purchased'));
                }]);  
                })->with('tags')->with('article_additional_fields')->orderBy('created_at', 'DESC')->first();

            return response()->json([
            'message' => 'Article Returned successfully',
            'data'=>$article
            ], 200);


            }

        public function all(Request $request)
        {

            if(!$request->has('paginate'))
            {

            $paginate=10;    
            }
            else
            {
            $paginate=$request->paginate;
            }
          
                $articles=Article::with('user')->with('category')->when(auth('api')->user(), function ($query)  {
                $query->with(['purchased' => function ($hasMany)  {


                return $hasMany->select(  \DB::raw('(CASE WHEN purchased_articles.user_id = ' .  auth('api')->user()->id . ' THEN true ELSE false END) AS purchased'));
                }]);  
                })->where('show',1)->where('approved',1)->orderBy('created_at', 'DESC')->paginate($paginate);
            return response()->json([
                'message' => 'Article Returned Successfully',
                'data'=>$articles
                ], 200);
        }


        public function  get_article_category($id,Request $request)

        {

            if(!$request->has('paginate'))
            {

            $paginate=10;    
            }
            else
            {
            $paginate=$request->paginate;
            }
           
            $articles=Article::where('category_id',$id)
              ->when(auth('api')->user(), function ($query)  {
                $query->with(['purchased' => function ($hasMany)  {
    
    
                    return $hasMany->select(  \DB::raw('(CASE WHEN purchased_articles.user_id = ' .  auth('api')->user()->id . ' THEN true ELSE false END) AS purchased'));
                }]);  
                })->with('user')->with('category')->where('show',1)->where('approved',1)->orderBy('created_at', 'DESC')->paginate($paginate);
            return response()->json([
                'message' => 'Article Returned Successfully',
                'data'=>$articles
                ], 200);  
        }


        
}