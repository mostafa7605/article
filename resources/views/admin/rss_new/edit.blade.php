@extends('admin.layouts.app')

<style>
    #wrap {
	/* max-width: 90%; */
	/* margin: auto; */
	padding: 1rem 0;
    border-radius: 10px;
    padding-top:0
    }
    #wrap.title {
		margin: 0 0 1rem 0;
		color: #a0a0a0;
	}

	.input {
		border: 1px solid #7f7f7f;
		border-radius: 0.4rem;
		padding: 0.5rem;
		cursor: text;
        border:0;
        padding-left: 0;
	}

	.tags, #tag {
		display: inline-block;
	}
    .tags{
        display: flex;
        flex-wrap: wrap;
    }
	#tag {
		border: none;
		font-size: 1.05rem;
		padding: 0.3rem 0;
        background:#F7F7F7
	}

	.tag {
		display: inline-block;
		border: 1px solid #d0d0d0;
		padding:0rem 0.2rem;
		border-radius: 0.4rem;
		margin:  3px;
        mix-width: 73px;
        height: 19px;
        background: #DBDBDB 0% 0% no-repeat padding-box;
        border-radius: 5px;
        display: flex;
        justify-content: space-between;
	}

	.tag-name {
		color: #242424;
        margin:0;
        margin-top: 0.5px;

	}

	.remove {
	    padding: 0px 2.5px;
        margin: 2px 0px;
        font-size: 12px;
        font-weight: 700;
        color: #e0e0e0;
        cursor: pointer;
        background: #fff;
        margin-left: 10px;
        margin-left: 10px;
        width: 12px;
        height: 12px;
        color: #000;
        font-size: 10px;
	}

	.tip {
		font-size: 0.9rem;
		color: #9f9f9f;
		margin-left: 3px;
	}
    .rss_create .circle-icon ,.rss_create .vertical_line{
        top:5
    }


    .cell-status input:checked ~ span {
    background: #fff;
  }
  .cell-status input:checked ~ span:after {
    left: 34px;
    background:  #804E08 !important;
  }
  
  .cell-status input:checked ~ span:active::after {
    left: 17px;
    background:   #804E08 !important;
  }
  .cell-status input:checked ~  .toggle_background{
  border: 1px solid  #804E08 !important;
  }
  .cell-status input:not(:checked) ~ span:active {
    background: #a3a3a3;
  }
  .circle-icon{
      color: #804E08 !important;
  }


  code {
  font-family: monospace;
}

.loading{
    display:none;
}

/* Hide builtin progress bar */
.custom-progress + .uploadcare--widget .uploadcare--widget__progress {
  display: none !important;
}
.meter {
  height: 5px;
  position: relative;
  display: block;
  margin: 10px 0;
}
.meter > span {
  position: relative;
  display: block;
  width: 0;
  height: 100%;
  border-radius: 8px;
  background-color: #804E08;
  /* background-image: linear-gradient(
    to top,
    rgb(43, 194, 83) 37%,
    rgb(84, 240, 84) 69%
  ); */
  box-shadow: inset 0 2px 9px rgba(255, 255, 255, 0.3),
    inset 0 -2px 6px rgba(0, 0, 0, 0.4);
  
}
.meter > span:after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  background-image: linear-gradient(
    -45deg,
    rgba(255, 255, 255, 0.2) 25%,
    transparent 25%,
    transparent 50%,
    rgba(255, 255, 255, 0.2) 50%,
    rgba(255, 255, 255, 0.2) 75%,
    transparent 75%
  );
  z-index: 1;
  background-size: 50px 50px;
  -webkit-animation: meter-move 2s linear infinite;
  animation: meter-move 2s linear infinite;
  border-radius: 8px;
}
@-webkit-keyframes meter-move {
  0% {
    background-position: 0 0;
  }
  100% {
    background-position: 50px 50px;
  }
}
@keyframes meter-move {
  0% {
    background-position: 0 0;
  }
  100% {
    background-position: 50px 50px;
  }
}

.upload-container:before {
    position: absolute;
    bottom: 46px;
    left: 56px;
    content: " (or)Drop your image here ";
    color: #242424;
    font-weight: 400;
}
</style>
<style>
    #delete_image{
        cursor: pointer;
    }
    #file_upload{
        opacity: 0;
    }
      .upload-container {
        position: relative;
        text-align: center;
        border: 1px dashed #804E08;
        border-radius: 10px;
      }
      .upload-container input {

        background: #F7F7F7 ;

        padding:100px 0px 0px;
        text-align: center !important;
      }
      .upload-container input:hover {
        background: #ddd;
      }
      .upload-container:before {
        position: absolute;
        content: "Drop your image here, or browse";
        bottom: 50px;
        left: 20px;
      }
      .upload-container:after {
        position: absolute;
        top: 25px;
        content:  url("	http://127.0.0.1:8000/rwrite/assets/images/admin/homepage/Group%20422.svg");
        left: 40%;
      }
      .upload-btn {
        margin-left: 300px;
        padding: 7px 20px;
      }
      .content{
          display: block;
      }
    </style>
	@section('content')
@if(session('status'))
<p id="alert-wishlist"class="alert alert-success"> {{ session('status') }}</p>
@endif

<div class=" create-rss">
    <form id="rss-form" action="{{route('rss.update',$rss->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method("put")
        <div class="row justify-content-center w-100 m-0 p-0">
            <div class="col-12 rss-first-link">
                <span class="col-2 rss-first-link" style="padding-right: 70px;align-items: center;">RSS Link</span>
                <input name="link"  value="{{$rss->link}}" id="rss_link" style="padding-left: 15px !important;" class="form-control col-8 p-0" placeholder="Your link here" type="text">
                <div class=" rss-first-btn col-2"><input type="button"  class="rss-btn" value="Fetch"></div>
            </div>
            <div class="col-12 m-0 p-0 content">
                
                <div class=" col-9 rss-second" style="    padding-right: 20px;    padding-left: 45px;">
                        <div  class="w-100 mb-2" style="    justify-content: space-around; display: flex;">
                            <span style="padding: 0px 40px;">RSS Data</span>
                            <span style="padding: 0px 8px;">Content match</span>                          
                        </div>
                </div>  
                <div class="row rss-first rss-second mt-0">
                    
                    <span class="col-2 rss-first-link">RSS Data</span>
                    
                    <div class=" col-9" >


                        <div class=" scroll-body">
                            <table class="w-100 table  mb-0">
                                <tbody style="border:0" id="table-Body">
                                    @if(isset($rss->rssData))
                                        @foreach($rss->rssData as $data)
                                            <tr>
                                                <td><input name="data[]" value="{{$data->data}}" type="text" readonly style="    border: 0; background: transparent; color: #ADADAD;" /></td>
                                                <td>
                                                    <select name="match[]" class="select_collection">
                                                        <option value="">select type</option>
                                                        <option {{$data->match == 'title' ? 'selected' :'' }} value="title">title</option>
                                                        <option {{$data->match == 'source' ? 'selected' :'' }} value="source">source</option>
                                                        <option {{$data->match == 'author' ? 'selected' :'' }} value="author">author</option>
                                                        <option {{$data->match == 'date' ? 'selected' :'' }} value="date">date</option>
                                                        <option {{$data->match == 'description' ? 'selected' :'' }} value="description">description</option>
                                                        <option  {{$data->match == 'image' ? 'selected' :'' }} value="image">image</option>
                                                        <option  {{$data->match == 'content' ? 'selected' :'' }} value="content">content</option>
                                                        <option  {{$data->match == 'purchase_type' ? 'selected' :'' }} value="purchase_type">purchase_type</option>
                                                        <option  {{$data->match == 'approved' ? 'selected' :'' }} value="approved">approved</option>
                                                        <option  {{$data->match == 'url' ? 'selected' :'' }} value="url">url</option>
                                                        <option  {{$data->match == 'cost' ? 'selected' :'' }} value="cost">cost</option>
                                                        <option  {{$data->match == 'show' ? 'selected' :'' }} value="show">show</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                
                
                    </div>
                </div>
                <div class="row rss-first rss-second mt-0" id="table_error" style="display:none;">

                    <span class="col-2 rss-first-link"></span>

                    <div class=" col-9" >


                        <p
                            id="table_text_error"
                            class="text-error more-info-err"
                            style="color: red;"
                          ></p>


                    </div>
                </div>
                <div  class=" col-10 rss-second rss-section" style="    padding-right: 0px;    padding-left: 50px;">
                    <div class="row">

                        <div class="col-8">
                            <div class="row rss-first rss-second" style="margin-top:57px;padding:0" >
                                <span class="col-3 rss-first-link">RSS Name</span>
                                <div class=" col-8 p-0" >
                                    <div class="row">
                                        <div class="col-11 pr-0 p-0">
                                            <input name="name" id="rss_name" class="form-control " value="{{$rss->name}}" style="background:#F7F7F7 ;border:0;    width: 102%;" placeholder="RSS feed name" type="text">
                                            <p

                                            class="text-error more-info-err"
                                            style="color: red; display:none;"
                                          ></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row rss-first rss-second" style="margin-top:30px;padding:0" >
                                <div class="col-3 rss-first-link">
                                    <span> RSS Timer </span>
                                </div>
                                <div class=" col-8 p-0" >
                                    <div class="row">
                                        <div class="col-11 pr-0 p-0 crone_job">
                                            <span  style="">Fetch data every :</span>
                                            <div>
                                            @php

                                            $hours_timer=$number = range(0,24);
                                                    $mins_timer=$number = range(0,60);
			$time = strtotime($rss->timer);
			 $hours=date('H', $time);
			 $mins= date('i', $time);
			@endphp
                                                <select name="timer_hours" id="hours" class="cron_day">
                                                    @foreach($hours_timer as $hour)
                                                    <option {{ $hours == $hour ? 'selected':'' }}  value="{{$hour}}">{{$hour}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="ml-1">Hrs</span>

                                            </div>

                                            <div>
                                                <select name="timer_mins" id="minutes" class="cron_day">
                                                    @foreach($mins_timer as $min)
                                                    <option {{$mins ==$min ? 'selected':'' }}  value="{{$min}}">{{$min}}</option>
                                                    @endforeach
                                                </select>
                                                <span class="ml-1">Mins</span>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="row rss-first rss-second" style="margin-top:-10px;padding-left:0px; display:none;" id="timee_error">
                                <div class="col-3 rss-first-link">
                                    <span>  </span>
                                </div>
                                <div class=" col-8 p-0" >
                            <p class="text-error more-info-err" 
                            style="color: red;padding-left: 13px;">This field is required</p></div>
                            </div>
                            <div class="row rss-first rss-second" style="margin-top:30px;padding:0" >
                                <span class="col-3 rss-first-link">Content Type</span>
                                <div class=" col-8 p-0" >
                                    <div class="row">
                                        <div class="col-11 pr-0 p-0">
                                            <select name="category_id" class="form-control " style="background:#F7F7F7 ;border:0;    width: 102%;" id="content_type">
                                                @foreach($categories as $category)
                                                <option {{$rss->category_id == $category->id ? 'selected': ''}} value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                            <p class="text-error more-info-err"
                                            style="color: red; display:none;">This field is requerd</p>
                                        </div>
                                    
                                    </div>
                                </div>
                            
                            </div>
                            <div class="row rss-first rss-second" style="margin-top:30px;padding:0" >
                                <span class="col-3 rss-first-link">Extra Tags</span>
                                <div class=" col-8 p-0" >
                                    <div class="row">
                                        <div class="col-11 pr-0 p-0">
                                        <section id="wrap"  style="background:#F7F7F7 ;border:0;    width: 102%;">

                                            <div class="input-container" style="    padding: 0 15px;">
                                                <input type="text" name="tags"  value="" id="tag" placeholder="Your tags here…" autofocus>
                                                
                                                <div class="input" >
                                                    <div class="tags">
                                                   
                                                            @foreach($tags as $tag)
                                                            <div class="tag" data-id="{{$tag}}"><label class="tag-name">{!! '@'.$tag!!}</label><span class="remove" >X</span></div>
                                                        
                                                        @endforeach
                                                    </div>
                                                </div>

                                            </div>
                                        </section>
                                        <p class="text-error more-info-err" id="tags_error"
                                            style="color: red; display:none;">This field is required</p>
                                        
                                        </div>
                                    
                                    </div>
                                </div>
                            
                            </div>
                            <div class="row rss-first rss-second" style="margin-top:30px;padding:0" >
                                <span class="col-3 rss-first-link">Auto Publish</span>
                                <div class=" col-8 p-0" >
                                    <div class="row">
                                        <div class="col-6 pr-0 p-0 p-0">
                                        <div class="cell-status">
                                            <label class="rss_create">
                                                <input type="checkbox" name="publish" {{$rss->publish == 1 ? 'checked' : ''}}>
                                                <span class="toggle_background">
                                                    <div class="circle-icon">on</div>
                                                    <div class="vertical_line">off</div>
                                                </span>

                                            </label>
                                        </div>
                                        </div>
                                    
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                        <div class="col-4" style="margin-top: 57px;">
                                <div class="row" style="justify-content: center;">
                                    <div class="col-12"  style="display: flex; justify-content: center;margin-bottom:20px">
                                        <span>RSS source icon</span>
                                    </div>
                                    <div class="col-10"  style="padding:  12px ;display: flex; justify-content: center;background: #F7F7F7 0% 0% no-repeat padding-box;border: 0.5px solid #E6E6E6;border-radius: 10px;">
                                        <div class="upload-container">
                                            <input type="file" style="width: 90%;" id="file_upload" name="image" />
                                            <p style="color: #ADADAD;padding-bottom: 15px; font-size: 12px;"> Supports : PNG, JPG, JPEG2OOO</p>
                                        </div>                             
                                    </div>
                                    <div class="col-10 loading"  >
                                        <span style="color: #242424;font-size :9px;display: flex;justify-content: space-between;"><span id="uploading">Uploading…</span> <span id="delete_image"><img src="{{asset('rwrite/assets/images/admin/homepage/Group 4119.svg')}}" alt=""></span></span>
                                        <p ><span class="meter"><span></span></span></p>    
                                    </div>
                                </div>

                                

                        </div>
                    </div>

                </div>

                <div class="row" style="   margin-top:80px ;justify-content: center;">
                     <a id="submit" type="submit" value="" style="width: 70px;height: 24px;  background: transparent; border: 0;"><div class="btn" style="font-size: 20px;line-height: 1;color: #FFFFFF;width: 189px;  display: flex; align-items: center; justify-content: center;height: 60px;background: #804E08 0% 0% no-repeat padding-box;border-radius: 6px;">
                       Save
                    </div></a>
                </div>
                
            </div>
            
        </div>
    </form>
</div>

@endsection
@section('scripts')

<script>//fech link
    $('.rss-btn').click(function(){
        var link=$('#rss_link').val();
        $('.content').hide();

        $.ajax({
            url:link ,
            type: 'Get',
            success: function(response){
                var rows='';
                var jsonData=response.results[0];
                // console.log(jsonData ,'aaaaaa')
                Object.keys(jsonData).forEach(function(key) {
                var value = key;
                rows+='<tr>'+
                            '<td><input name="data[]" value="'+value+'" type="text" readonly style="    border: 0; background: transparent; color: #ADADAD;" /></td>'+
                            '<td>'+
                                '<select name="match[]" class="select_collection">'+
                                    '<option value="" selected>select type</option>'+
                                    '<option value="title">title</option>'+
                                    '<option value="description">description</option>'+
                                    '<option value="image">image</option>'+
                                    '<option value=content">content</option>'+
                                    '<option value="purchase_type">purchase_type</option>'+
                                    '<option value="approved">approved</option>'+
                                    '<option value="url">url</option>'+
                                    '<option value="cost">cost</option>'+
                                    '<option value="show">show</option>'+
                                '</select>'+
                            '</td>'+
                        '</tr>';
                });
                $('#table-Body').html('')
                $('#table-Body').html(rows)
                $('.content').show();
            }
        })
    });
</script>


<script>//upload image drag and drop

     
   
    $('#file_upload').change(function(){

        if($(this).val() != null){
            $('.loading').show();
            $('.meter span').animate({width: 275}, 500 );
            setTimeout(uploading, 500);
        }
        
    });
    $('#delete_image').click(function(){
        $('.loading').hide();
        $('#file_upload').val('');
    })

    function  uploading(){
        $('#uploading').html('uploaded');
         $('.loading').hide();
    }

 
   
</script>

<script>//tags script
var divs_remove=document.getElementsByClassName('remove')
      for (var ii = 0; ii < divs_remove.length; ii++) {
        divs_remove[ii].addEventListener('click', deleteTag);
      }

    const query = document.querySelector.bind(document);

    const removeComma = string => string.slice(0, string.length).trim()



    const isInvalid = stringInput => {
	const inputs = Array.from(query('.tags').children).map(input => input.firstElementChild.textContent);

	return  !/^[A-Za-z0-9]{3,}/.test(stringInput) ||
					inputs.some(name => name === removeComma(stringInput)) ||
					query('.tags').children.length >= 10;
    }



    function modifyTags(e) {
        var keycode = (event.keyCode ? event.keyCode : event.which);
        if(keycode == '13') {

                if(isInvalid(e.target.value)) {
                    e.target.value = '';
                    return;
                }

                addTag(e.target.value);
                e.target.value = '';
            
            }

            if(e.key === 'Backspace' && !e.target.value.length) {
                deleteTag(null, query('.tags').children.length - 1);
            }

            //query('.tags-count').textContent = `${10 - query('.tags').children.length}`;
        }
    var items = [];

    var rss_tags=<?php echo(json_encode( $tags,true));?> 
    if( rss_tags.length >0){
        items=rss_tags;
    }
    function addTag(textValue) {
        console.log(textValue)
        items.push(textValue);
        const tag = document.createElement('div'),
        tagName = document.createElement('label'),
        remove = document.createElement('span');

        tagName.setAttribute('class', 'tag-name');
        tagName.textContent = removeComma('@'+textValue);
    
        remove.setAttribute('class', 'remove');
        remove.textContent = 'X';
        remove.addEventListener('click', deleteTag);

        tag.setAttribute('class', 'tag');
        tag.setAttribute('data-id',textValue)
        tag.appendChild(tagName);
        tag.appendChild(remove);

        query('.tags').appendChild(tag);
    }



    function deleteTag(e, i = Array.from(query('.tags').children).indexOf(e.target.parentElement)) {
        const index = query('.tags').getElementsByClassName('tag')[i];
        
        items = items.filter(el => el !==index.dataset.id);
        console.log(items)
        query('.tags').removeChild(index);
    //   query('.tags-count').textContent = `${10 - query('.tags').children.length}`;
    }



    function focus() {
        query('#tag').focus();
    }



    query('.input').addEventListener('click', focus);
    query('#tag').addEventListener('keyup', modifyTags);
</script>

<script>//submit form
    const setSuccess = element => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.text-error');

    errorDisplay.innerText = '';
    errorDisplay.style.display="none";

        };
        const setError = (element, message) => {
    const inputControl = element.parentElement;
    const errorDisplay = inputControl.querySelector('.text-error');

    errorDisplay.innerText = message;
    errorDisplay.style.display="block";

            };
    $('#submit').click(function(){
        console.log(items);
        $('#tag').val(items);
        var divs=document.getElementsByClassName('select_collection')
        let title=0;
        let creator=0;
        let discription=0;
        let content=0;
        let image=0;
        for (var i = 0; i < divs.length; i++) {
            if(divs[i].value=='title'){
                title=1;
            }else if(divs[i].value=='author'){
                creator=1;
            }else if(divs[i].value=='description'){
                discription=1;
            }else if(divs[i].value=='content'){
                content=1;
            }else if(divs[i].value=='image'){
                image=1;
            }

        }



        var form = document.getElementById("rss-form");
        const name = document.getElementById('rss_name');
        const hours = document.getElementById('hours');
        const minutes = document.getElementById('minutes');
        const content_type = document.getElementById('content_type');
        const tag = document.getElementById('tag');
        let x=true;
        const name2 = name.value.trim();
        const hours2 = hours.value.trim();
        const minutes2 = minutes.value.trim();
        const content_type2 = content_type.value.trim();
        const tag2 = tag.value.trim();

        if(title==0&&creator==0&&discription==0&&content==0&&image==0){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Title & Author & Description & Content and Image are required"
             x=false;
        }else if(title==1&&creator==0&&discription==0&&content==0&&image==0){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Author & Description & Content and Image are required"
             x=false;
        }else if(title==0&&creator==1&&discription==0&&content==0&&image==0){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Title & Description & Content and Image are required"
             x=false;
        }else if(title==0&&creator==0&&discription==1&&content==0&&image==0){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Title & Author & Content and Image are required"
             x=false;
        }else if(title==0&&creator==0&&discription==0&&content==1&&image==0){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Title & Author & Description and Image are required"
             x=false;
        }else if(title==0&&creator==0&&discription==0&&content==0&&image==1){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Title & Author & Description and Content are required"
             x=false;
        }else if(title==1&&creator==1&&discription==0&&content==0&&image==0){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Description & Content and Image are required"
             x=false;
        }else if(title==0&&creator==1&&discription==1&&content==0&&image==0){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Title & Content and Image are required"
             x=false;
        }else if(title==0&&creator==0&&discription==1&&content==1&&image==0){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Title & Author and Image are required"
             x=false;
        }else if(title==0&&creator==0&&discription==0&&content==1&&image==1){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Title & Author and Description are required"
             x=false;
        }else if(title==1&&creator==0&&discription==0&&content==0&&image==1){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Author & Description and Content are required"
             x=false;
        }else if(title==1&&creator==0&&discription==0&&content==1&&image==0){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Author & Description and Image are required"
             x=false;
        }else if(title==1&&creator==0&&discription==1&&content==0&&image==0){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Author & Content and Image are required"
             x=false;
        }else if(title==0&&creator==1&&discription==0&&content==0&&image==1){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Title & Description and Content are required"
             x=false;
        }else if(title==0&&creator==1&&discription==0&&content==1&&image==0){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Title & Description and Image are required"
             x=false;
        }else if(title==0&&creator==0&&discription==1&&content==0&&image==1){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Title & Author and Content are required"
             x=false;
        }else if(title==1&&creator==1&&discription==1&&content==0&&image==0){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Content and Image are required"
             x=false;
        }else if(title==0&&creator==1&&discription==1&&content==1&&image==0){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Title and Image are required"
             x=false;
        }else if(title==0&&creator==0&&discription==1&&content==1&&image==1){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Title and Author are required"
             x=false;
        }else if(title==1&&creator==1&&discription==0&&content==0&&image==1){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Description and Content are required"
             x=false;
        }else if(title==0&&creator==1&&discription==1&&content==0&&image==1){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Title and Content are required"
             x=false;
        }else if(title==1&&creator==1&&discription==0&&content==1&&image==0){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Description and Image are required"
             x=false;
        }else if(title==1&&creator==0&&discription==0&&content==1&&image==1){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Author and Description are required"
             x=false;
        }else if(title==1&&creator==0&&discription==1&&content==1&&image==0){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Author and Image are required"
             x=false;
        }else if(title==0&&creator==1&&discription==0&&content==1&&image==1){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Title and Description are required"
             x=false;
        }else if(title==1&&creator==0&&discription==1&&content==0&&image==1){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Author and Content are required"
             x=false;
        }else if(title==1&&creator==0&&discription==1&&content==1&&image==1){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Author are required"
             x=false;
        }else if(title==0&&creator==1&&discription==1&&content==1&&image==1){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Title are required"
             x=false;
        }else if(title==1&&creator==1&&discription==0&&content==1&&image==1){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Description are required"
             x=false;
        }else if(title==1&&creator==1&&discription==1&&content==1&&image==0){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Image are required"
             x=false;
        }else if(title==1&&creator==1&&discription==1&&content==0&&image==1){
             document.getElementById('table_error').style.display="flex";
             document.getElementById('table_text_error').innerText="Content are required"
             x=false;
        }
        else{
            document.getElementById('table_error').style.display="none";
             document.getElementById('table_text_error').innerText=""
        }


        if(name2 === '') {
        setError(name, 'This field is required');
        x=false;
        } else {
        setSuccess(name);
        }
        if(content_type2 === '') {
        setError(content_type, 'This field is required');
        x=false;
        } else {
        setSuccess(content_type);
        }
        if(tag2 === '') {

        document.getElementById('tags_error').style.display="block";
        x=false;
        } else {
            document.getElementById('tags_error').style.display="none";
        }
        if(hours2 == '0'&&minutes2=='0') {
            document.getElementById('timee_error').style.display="flex";
        x=false;
        } else {
            document.getElementById('timee_error').style.display="none";
        }

        if (x) {

            form.submit();

         }


        //form.submit();
    });
</script>
@endsection
