<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Rss;
use App\Models\rssData;
use App\Models\Tag;
use Carbon\Carbon;
use App\Models\Tags;
class RssController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $rss_items=Rss::all();
        // dd($ress_items);

        // $ch = curl_init( $rss_items[2]->link);

        // $headers = array();
        // $headers[] = '';

        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // $output = curl_exec($ch);

        // curl_close($ch);
        // $rss_response= json_decode($output);
        // $all_artices=(array)$rss_response->articles;

        // $rss_data=  $rss_items[2]->rssData->whereNotNull('match');//remove (source_id)
        // $rss_data_match=[];
        // $rss_data_match_inverse=[];
        // foreach ($rss_data as  $data) {
        //     $rss_data_match[$data->match]=$data->data;// like (source=>source_name , image=>urlToImage)
        //     $rss_data_match_inverse[$data->data]=$data->match;

        // }
        // $articles=[];
        // $article_data=[];
        // foreach($all_artices as $article){
        //     // dd($rss_data_match,$rss_data_match['image'], $article,((array)$article)['urlToImage']);

        //     foreach( $article as $index=>$data){

        //         if(gettype($data) == 'object'){
        //             $data=(array)$data;
        //             $object_data=[];
        //             foreach ($data as $key => $value) {
        //                 $object_data[$index.'_'.$key]=$value;
        //             }
        //             $object_data=array_intersect_key($object_data,$rss_data_match_inverse);
        //             foreach ($object_data as $i=>$value) {
        //                 $article_data[$rss_data_match[$index]]=$value ;
        //             }
        //         }

        //         else{
        //             foreach ($rss_data_match as $i=>$ar){
        //                 if($index == $ar){
        //                     $article_data[array_search($rss_data_match[$i], $rss_data_match) ]=((array)$article)[$rss_data_match[$i]] ;

        //                 }
        //             }
        //         }

        //     }
        //     array_push($articles, $article_data);
        // }
        // dd($articles);
        return view('admin.rss_new.index',compact('rss_items'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $categories=Category::all();
        return view('admin.rss_new.create',compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        if($request->hasFile('image')){


            $image = time().'.'.$request->image->extension();

            $request->image->move(public_path('images/image_rss/'), $image);
            $path=('images/image_rss/').$image;


        }
        $time=$request->timer_hours.':'.$request->timer_mins.':00';
        $time=strtotime( $time);

        $time= Carbon::parse($time)->format('H:i:s');

        $rss=Rss::create([
            'link'=>$request->link,
            'category_id'=>$request->category_id,
            'name'=>$request->name,
            'publish'=>$request->publish =='on' ? 1 : 0,
            'image'=> $path??'rwrite/assets/images/admin/homepage/rwrite-1@2x.png',
            'timer'=>$time
        ]);
        $tags=explode(",",$request->tags);
        foreach($tags as $tag_rss)
        {
            $tag= \DB::table('tags')->where('tag',$tag_rss)->first();
            if(is_null( $tag))
            {
            $tag=Tags::create(['tag'=>$tag_rss]);
            }
          

            \DB::table('rss_tags')->insert(['rss_id'=>$rss->id,'tag_id'=> $tag->id]);

        }
        foreach($request->data as $index=>$item){
           
            $rss_data=rssData::create([
                'rss_id'=>$rss->id,
                'data'=>$item,
                'match'=>$request->match[$index]
            ]);
            $rss->rssData()->save($rss_data);

        }

        return redirect()->route('rss.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $rss=Rss::find($id);
        if($rss->publish == 1){
            $rss->update(['publish'=>0]);

        }else{
            $rss->update(['publish'=>1]);

        }
        return response()->json(['message'=>'success','status'=>$rss['publish']]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {     
        $categories=Category::all();
        $rss=Rss::find($id);

        $tags=[];
      $tags_data=  \DB::table('rss_tags')->where('rss_id',$id)->get();
       
        foreach ($tags_data as $tag) {
        
            $tag_name= \DB::table('tags')->where('id',$tag->tag_id)->first();

            $name=$tag_name->tag;
            array_push($tags,$name);
        }



        return view('admin.rss_new.edit',compact('categories','rss','tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($request->hasFile('image')){


            $image = time().'.'.$request->image->extension();

            $request->image->move(public_path('images/image_rss/'), $image);
            $path=('images/image_rss/').$image;


        }
        $time=$request->timer_hours.':'.$request->timer_mins.':00';
        $time=strtotime( $time);
        $time= Carbon::parse($time)->format('H:i:s');
        $rss=Rss::find($id);
       \DB::table('rss_tags')->where('rss_id',$id)->delete();
        $rss->rssData()->delete();
        $rss->update([
            'link'=>$request->link,
            'category_id'=>$request->category_id,
            'name'=>$request->name,
            'publish'=>$request->publish =='on' ? 1 : 0,
            'image'=> $path??'rwrite/assets/images/admin/homepage/rwrite-1@2x.png',
            'timer'=>$time,
            'date'=>Carbon::now('Africa/Cairo')
        ]);
        $tags=explode(",",$request->tags);


        foreach($tags as $tag_rss)
        {
            $tag= \DB::table('tags')->where('tag',$tag_rss)->first();
            if(is_null( $tag))
            {
            $tag=Tags::create(['tag'=>$tag_rss]);
            }
          

            \DB::table('rss_tags')->insert(['rss_id'=>$rss->id,'tag_id'=> $tag->id]);

        }
        foreach($request->data as $index=>$item){
            $rss_data=rssData::create([
                'rss_id'=>$rss->id,
                'data'=>$item,
                'match'=>$request->match[$index]
            ]);
            $rss->rssData()->save($rss_data);

        }

        return redirect()->route('rss.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $rss=Rss::find($id);
        // $rss->tags()->delete();
        $rss->rssData()->delete();
        $rss->delete();
        return redirect()->route('rss.index');
    }

    public function get_rss_key(Request $request)
    {

        	$url = $request->link;


            $ch = curl_init($url);

            // Request headers
            $headers = array();
            $headers[] = '';

            // Return the transfer as a string
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            // $output contains the output string
            $output = curl_exec($ch);

            // Close curl resource to free up system resources
            curl_close($ch);
            $rss_response= json_decode($output);





            return response()->json($rss_response);
    }
}
