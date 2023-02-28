@extends('website.layouts.app')
<style>
    .error {
        color: red;
    }

    .select2-container {
        width: 100% !important;
    }

    .select2-container--default .select2-selection--multiple,
    .select2-container--open .select2-dropdown--below {
        border-color: #F9C100 !important;
    }
</style>
@section('content')
    <section class="create-articale">
        <form id="regForm" class="m-0" method="POST" action="{{ route('save_article') }}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-lg-9 col-md-8">
                    <div class="main_articale" style="height: calc(100vh - 127px);padding: 10px;">
                        <div class="tab">
                            <div class="head-articale mb-5">
                                <ul>
                                    <li class="active">
                                        <h3>1. Category</h3>
                                    </li>
                                    <li>
                                        <h3>2. Publishing</h3>
                                    </li>
                                    <li>
                                        <h3>3. Publication Avatar & Distribution</h3>
                                    </li>
                                    <li>
                                        <h3>4. General Information</h3>
                                    </li>
                                </ul>
                            </div>
                            <h2 class="question-1"> <img src="{{ asset('assets/img/rock.svg ') }}" /> Which category best
                                describe you ?</h2>
                            <div class="d-flex">
                                <div class="radio-check">

                                    <div class="button">
                                        <input type="radio" id="book" value="3" name="category"
                                            onclick=myFunction1('3') />
                                        <label class="btn btn-default add-article-type" for="book"> <img
                                                src="{{ asset('assets/img/articale1.png') }}" /> <br> Book </label>
                                        <img src="{{ asset('assets/img/check.png') }}" class="check" width="30px" />
                                    </div>
                                    <div class="button">
                                        <input type="radio" id="article" value="1" name="category"
                                            onclick=myFunction1('1') />
                                        <label class="btn btn-default add-article-type" for="article"> <img
                                                src="{{ asset('assets/img/articale2.png') }}" /> <br> Article </label>
                                        <img src="{{ asset('assets/img/check.png') }}" class="check" width="30px" />
                                    </div>
                                    <div class="button">
                                        <input type="radio" id="album" value="4" name="category"
                                            onclick=myFunction2('4') />
                                        <label class="btn btn-default add-article-type" for="album"> <img
                                                src="{{ asset('assets/img/articale3.png') }}" /> <br> Album Cover </label>
                                        <img src="{{ asset('assets/img/check.png') }}" class="check" width="30px" />
                                    </div>
                                    <div class="button">
                                        <input type="radio" id="art" value="5" name="category"
                                            onclick=myFunction2('5') />
                                        <label class="btn btn-default add-article-type" for="art"> <img
                                                src="{{ asset('assets/img/articale4.png') }}" /> <br> Art </label>
                                        <img src="{{ asset('assets/img/check.png') }}" class="check" width="30px" />
                                    </div>
                                    <div class="button">
                                        <input type="radio" id="video" value="2" name="category"
                                            onclick=myFunction2('2') />
                                        <label class="btn btn-default add-article-type" for="video"> <img
                                                src="{{ asset('assets/img/articale5.png') }}" /> <br> Video </label>
                                        <img src="{{ asset('assets/img/check.png') }}" class="check" width="30px" />
                                    </div>
                                </div>
                            </div>
                            <label id="category-error" class="error" style="display: none;" for="category">This field is
                                required.</label>
                        </div>
                        <div class="tab">
                            <div class="head-articale mb-5">
                                <ul>
                                    <li>
                                        <h3>1. Category</h3>
                                    </li>
                                    <li class="active">
                                        <h3>2. Publishing</h3>
                                    </li>
                                    <li>
                                        <h3>3. Publication Avatar & Distribution</h3>
                                    </li>
                                    <li>
                                        <h3>4. General Information</h3>
                                    </li>
                                </ul>
                            </div>
                            <div id="main-file">
                                <div class="file-drop-area">
                                    <div>
                                        <h3 class="fake-btn">Drag file here or browse.</h3>
                                        {{-- <p class="fake-btn">files should be JPEG or PDF</p> --}}
                                    </div>
                                    <div>
                                        {{-- <ul>
                                            <li><span>Aspect Ratio 16 : 9</span></li>
                                            <li><span>Recommended size 1080x576</span></li>
                                        </ul> --}}
                                    </div>
                                    <input class="file-input" id="file" name="file_upload1"
                                        onchange="javascript:updateList()" type="file">
                                </div>
                                <label id="file-error" class="error" style="display: none;" for="file">This field is
                                    required.</label>
                                <div>
                                    <ul id="fileList" class="file-list">

                                    </ul>
                                </div>
                            </div>
                            <div class="main-editor">
                                <textarea id="editor" name="cktext" row="5"></textarea>

                            </div>
                            <label id="editor-error" style="display: none; color: red;" for="editor">This field is
                                required.</label>
                        </div>
                        <div class="tab">
                            <div class="head-articale mb-5">
                                <ul>
                                    <li>
                                        <h3>1. Category</h3>
                                    </li>
                                    <li>
                                        <h3>2. Publishing</h3>
                                    </li>
                                    <li class="active">
                                        <h3>3. Publication Avatar & Distribution</h3>
                                    </li>
                                    <li>
                                        <h3>4. General Information</h3>
                                    </li>
                                </ul>
                            </div>
                            <div class="Publication">
                                <div>
                                    <h2 class="question-1"> <img src="{{ asset('assets/img/rock.svg ') }}" /> Add Image
                                    </h2>
                                    <p>
                                        This works like a user icon and appears in previews of your publication content
                                        throughout Rwrite.<br>
                                        It is rectangular and should be 1450 x 400 px in size.
                                    </p>
                                    <div class="file-drop-area">
                                        <div>
                                            <h3 class="fake-btn">Drag file here or browse.</h3>
                                            <p class="fake-btn2" id="fake-btn2">files should be image</p>
                                        </div>
                                        <input class="file-input" name="file_upload2" id="file2"
                                            onchange="javascript:updateList2()" type="file">
                                    </div>
                                    <label id="file2-error" class="error" style="display: none;" for="file2">This
                                        field is required.</label>
                                </div>
                                <div>
                                    <h2 class="question-1"> <img src="{{ asset('assets/img/rock.svg ') }}" />
                                        Distribution </h2>
                                    <p>This will set your distribution cost.</p>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault1" checked value="Free">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Free
                                        </label>
                                    </div>
                                    <div class="form-check position-relative">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault"
                                            id="flexRadioDefault2" value="Purchase">
                                        <label class="form-check-label" style="margin-top: 5px;" for="flexRadioDefault2">
                                            Purchase
                                        </label>
                                        <input class="form-control purchase" placeholder="00,00" type="number"
                                            name="money" value="0"><span style="margin: 5px 0 0 10px;">$</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab">
                            <div class="head-articale mb-5">
                                <ul>
                                    <li>
                                        <h3>1. Category</h3>
                                    </li>
                                    <li>
                                        <h3>2. Publishing</h3>
                                    </li>
                                    <li>
                                        <h3>3. Publication Avatar & Distribution</h3>
                                    </li>
                                    <li class="active">
                                        <h3>4. General Information</h3>
                                    </li>
                                </ul>
                            </div>
                            <div class="General">
                                <div>
                                    <h2 class="question-1"> <img src="{{ asset('assets/img/rock.svg ') }}" /> Title </h2>
                                    <p>
                                        This will appear in your publication homepage and helps reader understand your
                                        publication.
                                    </p>
                                    <input type="text" name="title" class="form-control"
                                        placeholder="Add title…" />
                                </div>

                                <div>
                                    <h2 class="question-1"> <img src="{{ asset('assets/img/rock.svg ') }}" /> Descreption
                                    </h2>

                                    <input type="text" name="description" class="form-control"
                                        placeholder="Add description..." />
                                </div>

                                <div>
                                    <h2 class="question-1"> <img src="{{ asset('assets/img/rock.svg ') }}" /> Tags </h2>
                                    <p>
                                        Adding tags (up to 5) allow people to search for and discover your publication.
                                    </p>
                                    <select class="form-control js-example-tokenizer" name="tags[]" multiple="multiple">

                                    </select>
                                    <label id="tags-error" class="error" style="display: none;" for="tags">This
                                        field is required.</label>
                                </div>

                                <div>
                                    <h2 class="question-1"> <img src="{{ asset('assets/img/rock.svg ') }}" /> Subtitles
                                    </h2>
                                    <p>
                                        Adding subtitles allow people to know more details about your product.
                                    </p>
                                    <div class="row" id="aditional_fields_">
                                        <div class="col-md-4 ">
                                            <input type="text" name="writer" class="form-control"
                                                placeholder="Writer Name…" />
                                        </div>
                                        <div class="col-md-4 ">
                                            <input type="text" name="artWork" class="form-control"
                                                placeholder="ArtWork…" />
                                        </div>
                                        <div class="col-md-4 ">
                                            <input type="text" name="designer" class="form-control"
                                                placeholder="Designer…" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="nunber-button" style="">
                            <div style="text-align:center; display: none;">
                                <span class="step">1</span>
                                <span class="step">2</span>
                                <span class="step">3</span>
                            </div>
                            <div class="buttons" style="overflow:auto;">
                                <div style="float:right; margin-top: 5px;">
                                    <button type="button" class="previous">Previous</button>
                                    <button type="button" class="next">Next</button>
                                    <button type="button" class="submit">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 col-md-4 circle"
                    style="background: #000;border-bottom: 2px solid #F9C100;position: relative;">
                    <div class="card">
                        <div class="percent">
                            <svg>
                                <circle cx="105" cy="105" r="100"></circle>
                                <circle cx="105" cy="105" r="100" id="circle"></circle>
                            </svg>
                            <div id="number">

                            </div>
                        </div>
                    </div>
                    <div style="text-align: center; margin-top: 40px;width:100%; position: absolute; bottom: 0; left: 0%;">
                        <ul
                            style="
                        display: flex;
                        align-items: center;
                        justify-content: space-evenly;
                        width: 100%;color:#fff;margin-bottom:20px;list-style: none;">
                            <li>
                                <h3 style="font-size:14px;font-weight:400;">Step</h3>
                            </li>
                            <li id="steps_number">

                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </form>
    </section>
@endsection



@push('scripts')
    <script src="https://cdn.ckeditor.com/4.15.1/standard-all/ckeditor.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/24.0.0/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

    <script>
        $(".js-example-tokenizer").select2({
            tags: true,
            tokenSeparators: [],
            maximumSelectionLength: 5,
        })
    </script>

    <script>
        (function($) {
            $.fn.multiStepForm = function(args) {
                if (args === null || typeof args !== 'object' || $.isArray(args))
                    throw " : Called with Invalid argument";
                var form = this;
                var tabs = form.find('.tab');
                var steps = form.find('.step');
                steps.each(function(i, e) {
                    $(e).on('click', function(ev) {});
                });
                form.navigateTo = function(i) {
                    /*index*/
                    /*Mark the current section with the class 'current'*/
                    tabs.removeClass('current').eq(i).addClass('current');
                    // Show only the navigation buttons that make sense for the current section:
                    form.find('.previous').toggle(i > 0);
                    atTheEnd = i >= tabs.length - 1;
                    form.find('.next').toggle(!atTheEnd);
                    // console.log('atTheEnd='+atTheEnd);
                    form.find('.submit').toggle(atTheEnd);
                    fixStepIndicator(curIndex());
                    return form;
                }

                function curIndex() {
                    /*Return the current index by looking at which section has the class 'current'*/
                    return tabs.index(tabs.filter('.current'));
                }

                function fixStepIndicator(n) {

                    steps.each(function(i, e) {

                        i == n ? $(e).addClass('active') : $(e).removeClass('active');

                        if (n == 0) {
                            document.getElementById("circle").style.setProperty('--percent', 10);
                            $('#number').text('');
                            $('#number').append(`<h3>10<span>%</span></h3><p style="
                font-weight: 200;
                font-size: 24px;
                color: #FFF;
                /* margin-right: 10px; */
            ">Progress
            </p>`);

                            $('#steps_number').text('');
                            $('#steps_number').append(
                                `<h3 style="font-size:14px;font-weight:400;" >1/4</h3>`);


                        }
                        if (n == 1) {
                            document.getElementById("circle").style.setProperty('--percent', 30);
                            $('#number').text('');
                            $('#number').append(`<h3>30<span>%</span></h3><p style="
                font-weight: 200;
                font-size: 24px;
                color: #FFF;
                /* margin-right: 10px; */
            ">Progress
            </p>`);

                            $('#steps_number').text('');
                            $('#steps_number').append(
                                `<h3 style="font-size:14px;font-weight:400;" >2/4</h3>`);

                        }
                        if (n == 2) {
                            document.getElementById("circle").style.setProperty('--percent', 60);
                            $('#number').text('');
                            $('#number').append(`<h3>60<span>%</span></h3><p style="
                font-weight: 200;
                font-size: 24px;
                color: #FFF;
                /* margin-right: 10px; */
            ">Progress
            </p>`);

                            $('#steps_number').text('');
                            $('#steps_number').append(
                                `<h3 style="font-size:14px;font-weight:400;" >3/4</h3>`);

                        }
                        if (n == 3) {
                            document.getElementById("circle").style.setProperty('--percent', 97);
                            $('#number').text('');
                            $('#number').append(`<h3>99<span>%</span></h3><p style="
                font-weight: 200;
                font-size: 24px;
                color: #FFF;
                /* margin-right: 10px; */
            ">Progress
            </p>`);

                            $('#steps_number').text('');
                            $('#steps_number').append(
                                `<h3 style="font-size:14px;font-weight:400;" >4/4</h3>`);

                        }

                    });
                }
                /* Previous button is easy, just go back */
                form.find('.previous').click(function() {
                    document.getElementById('editor-error').style.display = 'none';
                    form.navigateTo(curIndex() - 1);
                });

                /* Next button goes forward iff current block validates */
                form.find('.next').click(function() {
                    if ('validations' in args && typeof args.validations === 'object' && !$.isArray(args
                            .validations)) {
                        if (!('noValidate' in args) || (typeof args.noValidate === 'boolean' && !args
                                .noValidate)) {
                            form.validate(args.validations);
                            if (form.valid() == true) {





                                if (curIndex() + 1 == 2 && $(".main-editor").css('display') == 'block') {
                                    console.log(jQuery.trim(CKEDITOR.instances['editor'].getData()))
                                    if (jQuery.trim(CKEDITOR.instances['editor'].getData()).length === 0) {


                                        document.getElementById('editor-error').style.display = 'block';



                                        return false;
                                    } else {
                                        document.getElementById('editor-error').style.display =
                                            'none';
                                        form.navigateTo(curIndex() + 1);
                                        return true;
                                    }
                                } else {

                                    form.navigateTo(curIndex() + 1);
                                    return true;

                                }
                            }
                            return false;
                        }
                    }
                    form.navigateTo(curIndex() + 1);
                });
                form.find('.submit').on('click', function(e) {
                    if (typeof args.beforeSubmit !== 'undefined' && typeof args.beforeSubmit !==
                        'function')
                        args.beforeSubmit(form, this);
                    /*check if args.submit is set false if not then form.submit is not gonna run, if not set then will run by default*/
                    if (typeof args.submit === 'undefined' || (typeof args.submit ===
                            'boolean' && args
                            .submit)) {
                        form.submit();
                    }
                    return form;
                });
                /*By default navigate to the tab 0, if it is being set using defaultStep property*/
                typeof args.defaultStep === 'number' ? form.navigateTo(args.defaultStep) : null;

                form.noValidate = function() {

                }
                return form;
            };
        }(jQuery));
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            jQuery.validator.addMethod("checkType", function(value, element) {
                var ext = $('#file').val().split('.').pop().toLowerCase();
                let category = $("input[name='category']:checked").val();

                if (category == 4 && ext == 'mp3') {
                    return true
                } else if (category == 5) {

                    if ($.inArray(ext, ['gif', 'png', 'jpg', 'jpeg']) == -1) {
                        $("#file").val('');
                        return false;
                    } else {


                        return true
                    }


                } else if (category == 2 && ext == 'mp4') {
                    return true
                }


            }, "* Please upload right document");


            var val = {
                // Specify validation rules

                rules: {
                    category: {
                        required: true,
                    },

                    file_upload1: {
                        required: true,
                        checkType: true

                    },
                    file_upload2: {
                        required: true,
                        extension: "jpg|jpeg|png|ico|bmp"
                    },
                    flexRadioDefault: {
                        required: true,
                    },

                    title: {
                        required: true,
                    },
                    description: {
                        required: true,
                    },


                },
                messages: {

                    file_upload2: {

                        extension: "Please upload file in these format only (jpg, jpeg, png, ico, bmp)."
                    }
                }
            }
            $("#regForm").multiStepForm({
                beforeSubmit: function(form, submit) {
                    console.log("called before submiting the form");
                    console.log(form);
                    console.log(submit);
                },
                validations: val,
            }).navigateTo(0);
        });



        function clickEvent(first, last) {
            if (first.value.length) {
                document.getElementById(last).focus();
            }
        }
    </script>

    <script>
        updateList = function() {
            var input = document.getElementById('file');
            var output = document.getElementById('fileList');
            var children = "";
            for (var i = 0; i < input.files.length; ++i) {
                children += '<h3 style="position:relative;"> <img src="{{ asset('assets/img/img.svg ') }}" /> ' + input
                    .files.item(i).name +
                    '<span class="clearBackgroundImage" style="font-size: 20px;color: #000;cursor: pointer;position: absolute;left: 96%;top: 23%;">x</span></h3> '
            }
            output.innerHTML = children;
            $(document).ready(function() {
                $(".clearBackgroundImage").click(function() {
                    document.getElementById('file').value = '';
                    $('#fileList').text('');
                });
            });
        }

        updateList2 = function() {
            var input = document.getElementById('file2');
            var output = document.getElementById('fake-btn2');
            var children = "";
            for (var i = 0; i < input.files.length; ++i) {
                children += '<p>' + input.files.item(i).name + '</p>'
            }
            output.innerHTML = children;
        }
    </script>


    <script>
        function myFunction1(id) {
            $(".main-editor").show();
            $("#main-file").hide();
            document.getElementById('aditional_fields_').innerHTML = "";
            $.ajax({
                type: 'GET',
                url: '/aditionalfields/' + id,
                success: function(res) {
                    let aditionalfields = res.aditional;
                    //console.log(aditionalfields);
                    aditionalfields.forEach(elem2 => {
                        $('#aditional_fields_').append(`
                    <div class="col-md-4">
                    <input type="text" name="aditional_fields_values[]" class="form-control" placeholder="${ elem2.name }…" />
                    

                        
                    </div>
                    `);
                    });

                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        }

        function myFunction2(id) {
            $(".main-editor").hide();
            $("#main-file").show();
            document.getElementById('aditional_fields_').innerHTML = "";
            $.ajax({
                type: 'GET',
                url: '/aditionalfields/' + id,
                success: function(res) {
                    let aditionalfields = res.aditional;
                    //console.log(aditionalfields);
                    aditionalfields.forEach(elem2 => {
                        $('#aditional_fields_').append(`
                        <div class="col-md-4">
                        <input type="text" name="aditional_fields_values[]" class="form-control" placeholder="${ elem2.name }…" />
                      

                            
                        </div>
                        `);
                    });

                },
                error: function(data) {
                    console.log('Error:', data);
                }
            });
        }
    </script>

    <script>
        $('#update_form2').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });
        var users = {!! json_encode($users->toArray(), JSON_HEX_TAG) !!};
        var tags = {!! json_encode($tags->toArray(), JSON_HEX_TAG) !!};
        var tagsIn = {!! json_encode($tagsInstagram->toArray(), JSON_HEX_TAG) !!};

        var myEditor;

        CKEDITOR.replace("editor", {
            extraAllowedContent: "br(*)",

            plugins: "dialogui,dialog,a11yhelp,about,basicstyles,bidi,blockquote,clipboard," +
                "button,panelbutton,panel,floatpanel,colorbutton,colordialog,menu," +
                "contextmenu,dialogadvtab,div,elementspath,enterkey,entities,popup," +
                "filebrowser,find,fakeobjects,flash,floatingspace,listblock,richcombo," +
                "font,format,forms,horizontalrule,htmlwriter,iframe,image,indent," +
                "indentblock,indentlist,justify,link,list,liststyle,magicline," +
                "maximize,newpage,pagebreak,pastefromword,pastetext,preview,print," +
                "removeformat,resize,save,menubutton,scayt,selectall,showblocks," +
                "showborders,smiley,sourcearea,specialchar,stylescombo,tab,table," +
                "tabletools,templates,toolbar,undo,wsc,wysiwygarea,mentions,emoji",
            contentsCss: [
                "https://cdn.ckeditor.com/4.15.1/full-all/contents.css",
                "https://ckeditor.com/docs/ckeditor4/4.15.1/examples/assets/mentions/contents.css",
            ],
            height: 150,

            toolbar: [{
                    name: "document",
                    items: ["Undo", "Redo"],
                },
                {
                    name: "basicstyles",
                    groups: ["basicstyles", "cleanup"],
                    items: [
                        "Bold",
                        "Italic",
                        "Underline",
                        "Strike",
                        "Subscript",
                        "Superscript",
                        "-",
                        "RemoveFormat",
                    ],
                },
                {
                    name: "links",
                    items: ["EmojiPanel", "Link", "Unlink"],
                },
                {
                    name: "styles",
                    items: ["Styles", "Format"]
                },

                {
                    name: "insert",
                    items: ["Image", "Table", "HorizontalRule", "SpecialChar"],
                },
                {
                    name: "colors",
                    items: ["TextColor", "BGColor"]
                },
                {
                    name: "document",
                    groups: ["mode", "document", "doctools"],
                    items: [
                        "Source",

                        "Print",
                        "-",
                        "Templates",
                    ],
                },

                {
                    name: "paragraph",
                    groups: ["list", "indent", "blocks", "align", "bidi"],
                    items: [
                        "NumberedList",
                        "BulletedList",
                        "-",
                        "Outdent",
                        "Indent",
                        "-",
                        "Blockquote",
                        "CreateDiv",
                        "-",
                        "JustifyLeft",
                        "JustifyCenter",
                        "JustifyRight",
                        "JustifyBlock",
                        "-",
                        "BidiLtr",
                        "BidiRtl",
                        "Language",
                    ],
                },
            ],


            mentions: [{
                    feed: dataFeed,
                    itemTemplate: '<li data-id="{id}">' +
                        //  '<img class="" style="width:20% hight:20%" src="{avatar}" />' +
                        '<strong class="username">{username}</strong>' +
                        //   '<span class="fullname">{fullname}</span>' +
                        "</li>",
                    outputTemplate: '<p class="add-comment-tag" style="color: crimson; display: inline-block;">@{username}</p>',
                    minChars: 0,
                },
                {
                    feed: tags,
                    marker: "#",
                    itemTemplate: '<li data-id="{id}"><strong>{name}</strong></li>',
                    outputTemplate: '<p class="add-comment-tag" style="color: crimson; display: inline-block;">{name}</p>',
                    minChars: 1,
                },
                {
                    feed: tagsIn,
                    marker: "$",
                    itemTemplate: '<li data-id="{id}"><strong>{name}</strong></li>',
                    outputTemplate: '<p class="add-comment-tag" style="color: crimson; display: inline-block;">{name}</p>',
                    minChars: 1,
                },

            ],
        });
        CKEDITOR.config.forcePasteAsPlainText = false;
        CKEDITOR.config.pasteFromWordRemoveFontStyles = false;
        CKEDITOR.config.pasteFromWordRemoveStyles = false;
        CKEDITOR.config.allowedContent = true;
        CKEDITOR.config.extraAllowedContent = 'p(mso*,Normal)';
        CKEDITOR.config.pasteFilter = null;
        CKEDITOR.config.EnterMode = 'p';

        function dataFeed(opts, callback) {
            var matchProperty = "username",
                data = users.filter(function(item) {
                    return (item[matchProperty].indexOf(opts.query) > -1)
                });

            data = data.sort(function(a, b) {
                return a[matchProperty].localeCompare(b[matchProperty], undefined, {
                    sensitivity: "accent",
                });
            });
            callback(data);
        }
    </script>
@endpush
