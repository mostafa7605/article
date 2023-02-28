@extends('website.layouts.app')
@section('content')
    <style>
        /* h3,ul,p{
                margin: 0 !important;
                display: inline !important;
            } */
        .form-control:focus {
            box-shadow: none !important;
        }

        #comment,
        #comment_red {
            height: 100px;
        }

        .close {
            border: none;
            background: transparent;
        }

        .add_comment_main,
        .comment_red_main,
        .send_invitation_main {
            position: relative !important;
            width: fit-content;
            display: inline !important;
        }

        .add-comment-tag {
            cursor: pointer;
            background-color: #e7f1fe !important;
            padding: 3px 5px;
            border-radius: 5px;
            color: #1877F2;
            width: max-content;
        }


        .send_invitation,
        .add_comment,
        .comment_red {
            cursor: pointer;
            background-color: #7171711A !important;
            padding: 3px 5px;
            border-radius: 5px;
            color: #5F5F5F;
            width: max-content;
        }

        .add_comment {
            background-color: #E7F1FE !important;
            color: #1877F2 !important;
        }

        .comment_red {
            background: #CF3A3A1A !important;
            color: #CF3A3A !important;
        }


        .wrapper {
            width: auto !important;
            -webkit-transform: translateZ(0);
            -webkit-font-smoothing: antialiased;
        }

        .wrapper .tooltip,
        .g {
            background: #FFFFFF;
            color: #fff;
            display: block;
            left: 0px;
            margin-bottom: 15px;
            padding: 9px;
            position: absolute;
            -moz-transform: translateY(10px);
            -ms-transform: translateY(10px);
            -o-transform: translateY(10px);
            -moz-transition: all .25s ease-out;
            -ms-transition: all .25s ease-out;
            -o-transition: all .25s ease-out;
            transition: all .25s ease-out;

            border-radius: 6px;
            border: 1px solid #737171;
            display: flex;
            align-items: center;
            transform: translate(-50%, -50%) !important;
            left: 50%;
            top: -40px;
        }

        .tooltip-content {
            display: flex;
            align-items: center;
        }

        .tooltip-content-content {
            background: #000;
            border-radius: 50%;
            padding: 5px 1px 6px 1px;
        }

        .tooltip-content-content span {
            font-size: 12px;
            background: #000;
            border: 3px solid #fff;
            border-radius: 50%;
            padding: 5px 7px 4px 6px;
        }


        /* This bridges the gap so you can mouse into the tooltip without it disappearing */
        .wrapper .tooltip:before,
        .g:before {
            bottom: -20px;
            content: " ";
            display: block;
            height: 20px;
            left: 0;
            position: absolute;
            width: 100%;
        }

        /* CSS Triangles - see Trevor's post */
        .wrapper .tooltip:after,
        .g:after {
            content: "";
            border: 10px solid transparent;
            border-top-color: #5f5f5f;
            position: absolute;
            top: 100%;
            left: 50%;
            margin-left: -9px;
        }

        .add_comment_main .g:after {
            border-top-color: #1877F2;
        }

        .comment_red_main .g:after {
            border-top-color: #CF3A3A;
        }

        .cox {
            margin: 0 25px 0 7px;
            width: 90%;
            display: flex;
            align-items: center;
        }

        .cox h3 {
            font-size: 12px;
            color: #5f5f5f;
            font-weight: bod;
        }

        .button {
            background: #000 !important;
            padding: 8px 12px;
            border-radius: 10px;
            color: #fff;
            text-decoration: none;
            font-size: 12px;
            width: 130px;
            z-index: 11111111111;
            position: relative !important;
        }

        .wrapper:hover .tooltip,
        .g {
            opacity: 1;
            pointer-events: auto;
            -webkit-transform: translateY(0px);
            -moz-transform: translateY(0px);
            -ms-transform: translateY(0px);
            -o-transform: translateY(0px);
            transform: translateY(0px);
        }

        /* IE can just show/hide with no transition */

        .lte8 .wrapper:hover .tooltip {
            display: block;
        }

        .article_style ul li::before {
            content: "\2022";
            color: black;
            font-weight: bold;
            display: inline-block;
            width: 1em;
            margin-left: -1em;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
    <div class="container">
        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ Session::get('success') }}
                @php
                    Session::forget('success');
                @endphp
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <section class="bg">





        @if (!auth()->check())
            <input type="hidden" name="user_id" id="user_id" value="0">
        @else
            <input type="hidden" name="user_id" id="user_id" value="{{ auth()->user()->id }}">
        @endif

    </section>
    <section class="home-content">

        @if ($paid == 1)
            <div class="tittle">
                <p class="Published" style="justify-content: center;">Published
                    {{ date('F d, Y', strtotime($article->created_at)) }}</p>
                <h3>{{ $article->title }}</h3>
                <ul>
                    @foreach (App\Models\ArticleTag::where('article_id', $article->id)->get() as $tag)
                        <li>
                            <span>{{ $tag->tags->tag }}</span>
                        </li>
                    @endforeach
                </ul>
                <div class="writer">
                    @foreach ($article->article_additional_fields as $value)
                        <p>{{ $value->name }} : {{ $value->pivot->value }}</p>
                    @endforeach

                </div>
            </div>
        @else
            @if (Auth::check())
                <div class="d-flex justify-content-between home-content-content">
                    <div class="tittle" style="text-align: left;">
                        <p class="Published">Published {{ date('F d, Y', strtotime($article->created_at)) }}
                            <img style="margin-left: 7px;" src="{{ asset('assets/img/tag.svg ') }}">
                        </p>
                        <h3>{{ $article->title }}</h3>
                        <ul>
                            @foreach (App\Models\ArticleTag::where('article_id', $article->id)->get() as $tag)
                                <li>
                                    <span>{{ $tag->tags->tag }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <div class="writer">
                            @foreach ($article->article_additional_fields as $value)
                                <p>{{ $value->name }} : {{ $value->pivot->value }}</p>
                            @endforeach
                        </div>
                    </div>
                    <div class="Premium">
                        <form action="{{ route('article_pay') }}" method="post">
                            @csrf
                            <input type="hidden" name="article_id" value="{{ $article->id }}">
                            <input type="hidden" name="cost" value="{{ $article->cost }}">

                            <h2><img style="margin-right: 7px;" src="{{ asset('assets/img/tag.svg ') }}" width="15px">
                                <span style="margin-right: 4px;">Premium </span> article
                            </h2>
                            <p>Unlock this and get access to the full article.</p>
                            <button type="submit">${{ $article->cost }}</button>
                        </form>
                    </div>
                </div>
            @endif
        @endif

        <img src="{{ asset($article->image) }}" class="panner" />

        @if ($paid == 1)
            <div class="home-content-body">


                {{-- <div class="add_comment_main">
            <div class="add_comment"><img src="{{ asset('images/blue.png') }}" width="17px" /> | @tyuhijok</div>
            </div>  --}}
                <br>
                <!-- <div class="comment_red_main">
                    <div class="comment_red" style="color:#CF3A3A !important"><img src="{{ asset('images/Red.svg') }}" width="17px" /> | @tyuhijok </div>
                </div> -->


                @if (strtolower($article->category->name) == 'article' || strtolower($article->category->name) == 'book')
                    <div class="article_body article_style mb-3">
                        {!! \File::get(public_path($article->content)) !!}

                    </div>
                @elseif(strtolower($article->category->name) == 'video film')
                    <div class="article_body">
                        <iframe width="100%" height="445" src="{{ asset($article->content) }}"></iframe>
                    </div>
                @elseif(strtolower($article->category->name) == 'art')
                    <img id="article_image" class="panner" src="{{ asset($article->content) }}" alt="">
                @elseif(strtolower($article->category->name) == 'album cover')
                    <audio controls="" style="vertical-align: middle" src="{{ asset($article->content) }}"
                        type="audio/mp3" controlslist="nodownload">
                        Your browser does not support the audio element.
                    </audio>
                @endif

            </div>
        @endif
    </section>



    <!-- send_invitation_modal -->
    <div class="modal fade invite" id="send_invitation_modal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="width: 390px;">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title" style="color: #000000;font-size:12px;">You can invite <span style="color: #B4B2B6" id="text_mention"></span> To become “ R-User “</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="send_invitation_form">
                        @csrf
                        <input type="hidden" id="ar_id" name="article_id" class="form-control"
                            value="{{ $article->id }}">

                        <div class="mb-2">
                            <input type="email" style="background: #F5F5F5;font-size:12px;" name="email" id="email" class="form-control border-0 py-2"
                                placeholder="Email Address" required>
                        </div>
                        <div class="input-group flex-nowrap mb-3">
                            <select style="width: 100px;background: #F5F5F5;font-size:12px;outline: none;" name="country_code" class="input-group-text border-0 py-2" id="country_code" class="form-control">
                                <option data-countryCode="US" value="1" selected>USA (+1)</option>
                                <optgroup label="Other countries">
                                    <option data-countryCode="DZ" value="213">Algeria (+213)</option>
                                    <option data-countryCode="AD" value="376">Andorra (+376)</option>
                                    <option data-countryCode="AO" value="244">Angola (+244)</option>
                                    <option data-countryCode="AI" value="1264">Anguilla (+1264)</option>
                                    <option data-countryCode="AG" value="1268">Antigua &amp; Barbuda (+1268)</option>
                                    <option data-countryCode="AR" value="54">Argentina (+54)</option>
                                    <option data-countryCode="AM" value="374">Armenia (+374)</option>
                                    <option data-countryCode="AW" value="297">Aruba (+297)</option>
                                    <option data-countryCode="AU" value="61">Australia (+61)</option>
                                    <option data-countryCode="AT" value="43">Austria (+43)</option>
                                    <option data-countryCode="AZ" value="994">Azerbaijan (+994)</option>
                                    <option data-countryCode="BS" value="1242">Bahamas (+1242)</option>
                                    <option data-countryCode="BH" value="973">Bahrain (+973)</option>
                                    <option data-countryCode="BD" value="880">Bangladesh (+880)</option>
                                    <option data-countryCode="BB" value="1246">Barbados (+1246)</option>
                                    <option data-countryCode="BY" value="375">Belarus (+375)</option>
                                    <option data-countryCode="BE" value="32">Belgium (+32)</option>
                                    <option data-countryCode="BZ" value="501">Belize (+501)</option>
                                    <option data-countryCode="BJ" value="229">Benin (+229)</option>
                                    <option data-countryCode="BM" value="1441">Bermuda (+1441)</option>
                                    <option data-countryCode="BT" value="975">Bhutan (+975)</option>
                                    <option data-countryCode="BO" value="591">Bolivia (+591)</option>
                                    <option data-countryCode="BA" value="387">Bosnia Herzegovina (+387)</option>
                                    <option data-countryCode="BW" value="267">Botswana (+267)</option>
                                    <option data-countryCode="BR" value="55">Brazil (+55)</option>
                                    <option data-countryCode="BN" value="673">Brunei (+673)</option>
                                    <option data-countryCode="BG" value="359">Bulgaria (+359)</option>
                                    <option data-countryCode="BF" value="226">Burkina Faso (+226)</option>
                                    <option data-countryCode="BI" value="257">Burundi (+257)</option>
                                    <option data-countryCode="KH" value="855">Cambodia (+855)</option>
                                    <option data-countryCode="CM" value="237">Cameroon (+237)</option>
                                    <option data-countryCode="CA" value="1">Canada (+1)</option>
                                    <option data-countryCode="CV" value="238">Cape Verde Islands (+238)</option>
                                    <option data-countryCode="KY" value="1345">Cayman Islands (+1345)</option>
                                    <option data-countryCode="CF" value="236">Central African Republic (+236)</option>
                                    <option data-countryCode="CL" value="56">Chile (+56)</option>
                                    <option data-countryCode="CN" value="86">China (+86)</option>
                                    <option data-countryCode="CO" value="57">Colombia (+57)</option>
                                    <option data-countryCode="KM" value="269">Comoros (+269)</option>
                                    <option data-countryCode="CG" value="242">Congo (+242)</option>
                                    <option data-countryCode="CK" value="682">Cook Islands (+682)</option>
                                    <option data-countryCode="CR" value="506">Costa Rica (+506)</option>
                                    <option data-countryCode="HR" value="385">Croatia (+385)</option>
                                    <option data-countryCode="CU" value="53">Cuba (+53)</option>
                                    <option data-countryCode="CY" value="90392">Cyprus North (+90392)</option>
                                    <option data-countryCode="CY" value="357">Cyprus South (+357)</option>
                                    <option data-countryCode="CZ" value="42">Czech Republic (+42)</option>
                                    <option data-countryCode="DK" value="45">Denmark (+45)</option>
                                    <option data-countryCode="DJ" value="253">Djibouti (+253)</option>
                                    <option data-countryCode="DM" value="1809">Dominica (+1809)</option>
                                    <option data-countryCode="DO" value="1809">Dominican Republic (+1809)</option>
                                    <option data-countryCode="EC" value="593">Ecuador (+593)</option>
                                    <option data-countryCode="EG" value="20">Egypt (+20)</option>
                                    <option data-countryCode="SV" value="503">El Salvador (+503)</option>
                                    <option data-countryCode="GQ" value="240">Equatorial Guinea (+240)</option>
                                    <option data-countryCode="ER" value="291">Eritrea (+291)</option>
                                    <option data-countryCode="EE" value="372">Estonia (+372)</option>
                                    <option data-countryCode="ET" value="251">Ethiopia (+251)</option>
                                    <option data-countryCode="FK" value="500">Falkland Islands (+500)</option>
                                    <option data-countryCode="FO" value="298">Faroe Islands (+298)</option>
                                    <option data-countryCode="FJ" value="679">Fiji (+679)</option>
                                    <option data-countryCode="FI" value="358">Finland (+358)</option>
                                    <option data-countryCode="FR" value="33">France (+33)</option>
                                    <option data-countryCode="GF" value="594">French Guiana (+594)</option>
                                    <option data-countryCode="PF" value="689">French Polynesia (+689)</option>
                                    <option data-countryCode="GA" value="241">Gabon (+241)</option>
                                    <option data-countryCode="GM" value="220">Gambia (+220)</option>
                                    <option data-countryCode="GE" value="7880">Georgia (+7880)</option>
                                    <option data-countryCode="DE" value="49">Germany (+49)</option>
                                    <option data-countryCode="GH" value="233">Ghana (+233)</option>
                                    <option data-countryCode="GI" value="350">Gibraltar (+350)</option>
                                    <option data-countryCode="GR" value="30">Greece (+30)</option>
                                    <option data-countryCode="GL" value="299">Greenland (+299)</option>
                                    <option data-countryCode="GD" value="1473">Grenada (+1473)</option>
                                    <option data-countryCode="GP" value="590">Guadeloupe (+590)</option>
                                    <option data-countryCode="GU" value="671">Guam (+671)</option>
                                    <option data-countryCode="GT" value="502">Guatemala (+502)</option>
                                    <option data-countryCode="GN" value="224">Guinea (+224)</option>
                                    <option data-countryCode="GW" value="245">Guinea - Bissau (+245)</option>
                                    <option data-countryCode="GY" value="592">Guyana (+592)</option>
                                    <option data-countryCode="HT" value="509">Haiti (+509)</option>
                                    <option data-countryCode="HN" value="504">Honduras (+504)</option>
                                    <option data-countryCode="HK" value="852">Hong Kong (+852)</option>
                                    <option data-countryCode="HU" value="36">Hungary (+36)</option>
                                    <option data-countryCode="IS" value="354">Iceland (+354)</option>
                                    <option data-countryCode="IN" value="91">India (+91)</option>
                                    <option data-countryCode="ID" value="62">Indonesia (+62)</option>
                                    <option data-countryCode="IR" value="98">Iran (+98)</option>
                                    <option data-countryCode="IQ" value="964">Iraq (+964)</option>
                                    <option data-countryCode="IE" value="353">Ireland (+353)</option>
                                    <option data-countryCode="IL" value="972">Israel (+972)</option>
                                    <option data-countryCode="IT" value="39">Italy (+39)</option>
                                    <option data-countryCode="JM" value="1876">Jamaica (+1876)</option>
                                    <option data-countryCode="JP" value="81">Japan (+81)</option>
                                    <option data-countryCode="JO" value="962">Jordan (+962)</option>
                                    <option data-countryCode="KZ" value="7">Kazakhstan (+7)</option>
                                    <option data-countryCode="KE" value="254">Kenya (+254)</option>
                                    <option data-countryCode="KI" value="686">Kiribati (+686)</option>
                                    <option data-countryCode="KP" value="850">Korea North (+850)</option>
                                    <option data-countryCode="KR" value="82">Korea South (+82)</option>
                                    <option data-countryCode="KW" value="965">Kuwait (+965)</option>
                                    <option data-countryCode="KG" value="996">Kyrgyzstan (+996)</option>
                                    <option data-countryCode="LA" value="856">Laos (+856)</option>
                                    <option data-countryCode="LV" value="371">Latvia (+371)</option>
                                    <option data-countryCode="LB" value="961">Lebanon (+961)</option>
                                    <option data-countryCode="LS" value="266">Lesotho (+266)</option>
                                    <option data-countryCode="LR" value="231">Liberia (+231)</option>
                                    <option data-countryCode="LY" value="218">Libya (+218)</option>
                                    <option data-countryCode="LI" value="417">Liechtenstein (+417)</option>
                                    <option data-countryCode="LT" value="370">Lithuania (+370)</option>
                                    <option data-countryCode="LU" value="352">Luxembourg (+352)</option>
                                    <option data-countryCode="MO" value="853">Macao (+853)</option>
                                    <option data-countryCode="MK" value="389">Macedonia (+389)</option>
                                    <option data-countryCode="MG" value="261">Madagascar (+261)</option>
                                    <option data-countryCode="MW" value="265">Malawi (+265)</option>
                                    <option data-countryCode="MY" value="60">Malaysia (+60)</option>
                                    <option data-countryCode="MV" value="960">Maldives (+960)</option>
                                    <option data-countryCode="ML" value="223">Mali (+223)</option>
                                    <option data-countryCode="MT" value="356">Malta (+356)</option>
                                    <option data-countryCode="MH" value="692">Marshall Islands (+692)</option>
                                    <option data-countryCode="MQ" value="596">Martinique (+596)</option>
                                    <option data-countryCode="MR" value="222">Mauritania (+222)</option>
                                    <option data-countryCode="YT" value="269">Mayotte (+269)</option>
                                    <option data-countryCode="MX" value="52">Mexico (+52)</option>
                                    <option data-countryCode="FM" value="691">Micronesia (+691)</option>
                                    <option data-countryCode="MD" value="373">Moldova (+373)</option>
                                    <option data-countryCode="MC" value="377">Monaco (+377)</option>
                                    <option data-countryCode="MN" value="976">Mongolia (+976)</option>
                                    <option data-countryCode="MS" value="1664">Montserrat (+1664)</option>
                                    <option data-countryCode="MA" value="212">Morocco (+212)</option>
                                    <option data-countryCode="MZ" value="258">Mozambique (+258)</option>
                                    <option data-countryCode="MN" value="95">Myanmar (+95)</option>
                                    <option data-countryCode="NA" value="264">Namibia (+264)</option>
                                    <option data-countryCode="NR" value="674">Nauru (+674)</option>
                                    <option data-countryCode="NP" value="977">Nepal (+977)</option>
                                    <option data-countryCode="NL" value="31">Netherlands (+31)</option>
                                    <option data-countryCode="NC" value="687">New Caledonia (+687)</option>
                                    <option data-countryCode="NZ" value="64">New Zealand (+64)</option>
                                    <option data-countryCode="NI" value="505">Nicaragua (+505)</option>
                                    <option data-countryCode="NE" value="227">Niger (+227)</option>
                                    <option data-countryCode="NG" value="234">Nigeria (+234)</option>
                                    <option data-countryCode="NU" value="683">Niue (+683)</option>
                                    <option data-countryCode="NF" value="672">Norfolk Islands (+672)</option>
                                    <option data-countryCode="NP" value="670">Northern Marianas (+670)</option>
                                    <option data-countryCode="NO" value="47">Norway (+47)</option>
                                    <option data-countryCode="OM" value="968">Oman (+968)</option>
                                    <option data-countryCode="PW" value="680">Palau (+680)</option>
                                    <option data-countryCode="PA" value="507">Panama (+507)</option>
                                    <option data-countryCode="PG" value="675">Papua New Guinea (+675)</option>
                                    <option data-countryCode="PY" value="595">Paraguay (+595)</option>
                                    <option data-countryCode="PE" value="51">Peru (+51)</option>
                                    <option data-countryCode="PH" value="63">Philippines (+63)</option>
                                    <option data-countryCode="PL" value="48">Poland (+48)</option>
                                    <option data-countryCode="PT" value="351">Portugal (+351)</option>
                                    <option data-countryCode="PR" value="1787">Puerto Rico (+1787)</option>
                                    <option data-countryCode="QA" value="974">Qatar (+974)</option>
                                    <option data-countryCode="RE" value="262">Reunion (+262)</option>
                                    <option data-countryCode="RO" value="40">Romania (+40)</option>
                                    <option data-countryCode="RU" value="7">Russia (+7)</option>
                                    <option data-countryCode="RW" value="250">Rwanda (+250)</option>
                                    <option data-countryCode="SM" value="378">San Marino (+378)</option>
                                    <option data-countryCode="ST" value="239">Sao Tome &amp; Principe (+239)</option>
                                    <option data-countryCode="SA" value="966">Saudi Arabia (+966)</option>
                                    <option data-countryCode="SN" value="221">Senegal (+221)</option>
                                    <option data-countryCode="CS" value="381">Serbia (+381)</option>
                                    <option data-countryCode="SC" value="248">Seychelles (+248)</option>
                                    <option data-countryCode="SL" value="232">Sierra Leone (+232)</option>
                                    <option data-countryCode="SG" value="65">Singapore (+65)</option>
                                    <option data-countryCode="SK" value="421">Slovak Republic (+421)</option>
                                    <option data-countryCode="SI" value="386">Slovenia (+386)</option>
                                    <option data-countryCode="SB" value="677">Solomon Islands (+677)</option>
                                    <option data-countryCode="SO" value="252">Somalia (+252)</option>
                                    <option data-countryCode="ZA" value="27">South Africa (+27)</option>
                                    <option data-countryCode="ES" value="34">Spain (+34)</option>
                                    <option data-countryCode="LK" value="94">Sri Lanka (+94)</option>
                                    <option data-countryCode="SH" value="290">St. Helena (+290)</option>
                                    <option data-countryCode="KN" value="1869">St. Kitts (+1869)</option>
                                    <option data-countryCode="SC" value="1758">St. Lucia (+1758)</option>
                                    <option data-countryCode="SD" value="249">Sudan (+249)</option>
                                    <option data-countryCode="SR" value="597">Suriname (+597)</option>
                                    <option data-countryCode="SZ" value="268">Swaziland (+268)</option>
                                    <option data-countryCode="SE" value="46">Sweden (+46)</option>
                                    <option data-countryCode="CH" value="41">Switzerland (+41)</option>
                                    <option data-countryCode="SI" value="963">Syria (+963)</option>
                                    <option data-countryCode="TW" value="886">Taiwan (+886)</option>
                                    <option data-countryCode="TJ" value="7">Tajikstan (+7)</option>
                                    <option data-countryCode="TH" value="66">Thailand (+66)</option>
                                    <option data-countryCode="TG" value="228">Togo (+228)</option>
                                    <option data-countryCode="TO" value="676">Tonga (+676)</option>
                                    <option data-countryCode="TT" value="1868">Trinidad &amp; Tobago (+1868)</option>
                                    <option data-countryCode="TN" value="216">Tunisia (+216)</option>
                                    <option data-countryCode="TR" value="90">Turkey (+90)</option>
                                    <option data-countryCode="TM" value="7">Turkmenistan (+7)</option>
                                    <option data-countryCode="TM" value="993">Turkmenistan (+993)</option>
                                    <option data-countryCode="TC" value="1649">Turks &amp; Caicos Islands (+1649)
                                    </option>
                                    <option data-countryCode="TV" value="688">Tuvalu (+688)</option>
                                    <option data-countryCode="UG" value="256">Uganda (+256)</option>
                                    <option data-countryCode="GB" value="44">UK (+44)</option>
                                    <option data-countryCode="UA" value="380">Ukraine (+380)</option>
                                    <option data-countryCode="AE" value="971">United Arab Emirates (+971)</option>
                                    <option data-countryCode="UY" value="598">Uruguay (+598)</option>
                                    <!-- <option data-countryCode="US" value="1">USA (+1)</option> -->
                                    <option data-countryCode="UZ" value="7">Uzbekistan (+7)</option>
                                    <option data-countryCode="VU" value="678">Vanuatu (+678)</option>
                                    <option data-countryCode="VA" value="379">Vatican City (+379)</option>
                                    <option data-countryCode="VE" value="58">Venezuela (+58)</option>
                                    <option data-countryCode="VN" value="84">Vietnam (+84)</option>
                                    <option data-countryCode="VG" value="84">Virgin Islands - British (+1284)</option>
                                    <option data-countryCode="VI" value="84">Virgin Islands - US (+1340)</option>
                                    <option data-countryCode="WF" value="681">Wallis &amp; Futuna (+681)</option>
                                    <option data-countryCode="YE" value="969">Yemen (North)(+969)</option>
                                    <option data-countryCode="YE" value="967">Yemen (South)(+967)</option>
                                    <option data-countryCode="ZM" value="260">Zambia (+260)</option>
                                    <option data-countryCode="ZW" value="263">Zimbabwe (+263)</option>
                                </optgroup>
                            </select>
                            <input type="number" style="background: #F5F5F5;font-size:12px;" name="phone" id="phone" class="form-control border-0 py-2" placeholder="Phone Number" required>
                        </div>

                        @if (Auth::check())
                            <div class="mb-3">
                                <button style="width: 100%;
    background: #F9C100;
    border: 0;
    padding: 8px;
    border-radius: 7px;font-size:16px;font-weight: 500;" type="submit" class="send btn-send">Send Invitation</button>
                            </div>
                        @endif
                        <div class="errors"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- add_comment_main -->
    <div class="modal fade invite" id="add_comment_main" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <div class="" style="border-color:#1877F2;">
                        <div class="tooltip-content">
                            <div class="tooltip-content-content"><span style="color:#fff"
                                    id="text_mention_f_letter_blue">f</span></div>
                            <div class="cox">
                                <h3 class="text_name_mention" style="color:#804E08" id="text_mention_blue"></h3>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="blue_form" style="padding: 15px">
                    @csrf
                    <input type="hidden" id="taggedNameModal">
                    <input type="hidden" id="indexModal">

                    <input type="hidden" id="article_id" value="{{ $article->id }}">
                    <div class="modal-body" style="background:#F5F5F5;">
                        <textarea class="form-control" id="comment" placeholder="Comment…"></textarea>
                    </div>
                    @if (Auth::check())
                        <a class="btn btn-secondary d-block m-auto mt-4" style="width: 144px;font-size:17px;"
                            id="save_comment">
                            send</a>
                    @endif
                </form>

            </div>
        </div>
    </div>


    <!-- comment_red_main -->
    <div class="modal fade invite" id="comment_red_main" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <div></div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div style="height:222px;overflow:auto;" class="">
                        <!-- <div class="border-bottom p-3">
                            <div class="" style="border-color:#1877F2;"><div class="tooltip-content"><div class="tooltip-content-content"><span style="color:#fff">f</span></div><div class="cox"><h3 class="text_name_red_mention" style="color:#804E08">@egthtfhgt</h3><span style="color: #AAAAAA;font-size: 10px;margin-left: 9px;">9 : 12 pm</span></div></div></div>
                            <div class="d-flex mt-3 align-items-center">
                                <h3 style="color: #1877F2;padding: 3px;font-size: 10px;background: #d2e4fc;border-radius: 4px;">@lnhijhrwg</h3>
                                <p style="font-size: 10px;padding: 3px;color: #838383;margin-left: 12px !important;">Oh? Bob! How’s it going?</p>
                            </div>
                        </div> -->

                        <div id="commentsData"></div>


                    </div>

                    <form id="red_form" style="padding: 15px">
                        @csrf
                        <input type="hidden" id="taggedNameModalRed">
                        <input type="hidden" id="indexRed">

                        <input type="hidden" id="article_id_red" value="{{ $article->id }}">
                        <div class="modal-body" style="background:#F5F5F5;">
                            <textarea class="form-control" id="comment_red" placeholder="Comment…"></textarea>
                        </div>
                        @if (Auth::check())
                            <a class="btn btn-secondary d-block m-auto mt-4" style="width: 144px;font-size:17px;"
                                id="save_comment_red"> send</a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


@push('scripts')
    <script>
        let user_token = document.getElementById("user_id").value;

        $(document).ready(function() {
            var user = {!! auth()->user() !!}

            if (typeof user !== "undefined") {

                $('.send_invitation_main').mouseover(function(event) {

                    let text = $(event.target).text();
                    text = text.replace('|', '');
                    let first_letter = text.charAt(3);
                    first_letter = first_letter.toUpperCase();

                    var dom_nodes =
                        '<div class="g"><div class="tooltip-content"><div class="tooltip-content-content"><span>' +
                        first_letter + '</span></div><div class="cox"><h3 class="text_name_invitation">' +
                        text +
                        '</h3></div></div><button type="button" class="btn btn-primary button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Invite to R-Write</button></div>';

                    if ($('.g').length <= 0) {

                        $(this).append(dom_nodes);
                    }
                    $(this).find(".button").click(function() {
                        $("#send_invitation_modal").modal('show');
                        $(".text_name_invitation").each(function() {
                            let text_f = $(this).text();
                            document.getElementById("text_mention").innerHTML = '';
                            document.getElementById("text_mention").innerHTML = text_f;
                        });
                    })
                }).mouseleave(function() {
                    $(".g").remove();
                });
            }


        });

        $(document).ready(function() {
            $('.add_comment_main').mouseover(function(event) {
                let index = $(this).attr("data-index")

                let text = $(event.target).text();
                text = text.replace('|', '');
                let first_letter = text.charAt(3);

                first_letter = first_letter.toUpperCase();
                var dom_nodes =
                    '<div class="g" style="border-color:#1877F2;"><div class="tooltip-content"><div class="tooltip-content-content"><span>' +
                    first_letter +
                    '</span></div><div class="cox"><h3 class="text_name_blue" style="color:#1877F2">' +
                    text +
                    '</h3></div></div><button type="button" class="btn btn-primary button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="display: flex;width: 142px;align-items: center;"><img src="{{ asset('images/white.svg') }}" style="margin-right:5px;" width="15px" /> | Add a comment</button></div>';
                if ($('.g').length <= 0) {
                    $(this).append(dom_nodes);
                }
                $(this).find(".button").click(function() {
                    $("#add_comment_main").modal('show');
                    $(".text_name_blue").each(function() {
                        let text_f = $(this).text();
                        let first_letter_modal = text_f.replace('@', '');
                        first_letter_modal = first_letter_modal.charAt(2);
                        document.getElementById("text_mention_blue").innerHTML = '';
                        document.getElementById("text_mention_f_letter_blue").innerHTML =
                            '';
                        document.getElementById("taggedNameModal").value = '';
                        document.getElementById("taggedNameModal").value = text_f;
                        document.getElementById("text_mention_f_letter_blue").innerHTML =
                            first_letter_modal;
                        document.getElementById("text_mention_blue").innerHTML = text_f;
                        document.getElementById("indexModal").value = index
                    });
                });
            }).mouseleave(function() {
                $(".g").remove();
            });

        });

        $(document).ready(function() {
            $('.comment_red_main').mouseover(function(event) {

                let text = $(event.target).text();
                text = text.replace('|', '');
                let first_letter = text.charAt(3);
                first_letter = first_letter.toUpperCase();
                let article_id = document.getElementById("article_id_red").value
                let index = $(this).attr("data-index")


                var dom_nodes =
                    '<div class="g d-block" style="border-color:#CF3A3A;"><div class="d-flex"><div class="tooltip-content d-flex"><div class="tooltip-content-content"><span>' +
                    first_letter +
                    '</span></div><div class="cox"><h3 class="text_name_comment" style="color:#CF3A3A">' +
                    text +
                    '</h3></div></div><button type="button" class="btn btn-primary button" data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="display: flex;width: 142px;align-items: center;" ><img src="{{ asset('images/white.svg') }}" style="margin-right:5px;" width="15px" /> | Add a comment</button></div><p style="color:#AAAAAA;font-size:12px;text-align:center;"><i class="fa-solid fa-arrow-turn-down-right"></i></p></div>';
                if ($('.g').length <= 0) {
                    $(this).append(dom_nodes);
                }
                $(this).find(".button").click(function() {


                    $("#comment_red_main").modal('show');

                    $(".text_name_comment").each(function() {

                        let text_f = $(this).text();
                        document.getElementById("taggedNameModalRed").value = '';
                        document.getElementById("taggedNameModalRed").value = text_f;
                        document.getElementById("indexRed").value = index
                        document.getElementById("text_mention").innerHTML = '';
                        document.getElementById("text_mention").innerHTML = text_f;
                        document.getElementById('commentsData').innerHTML = ''
                        $.ajax({
                            url: "/api/get_comment",
                            type: 'GET',
                            data: {
                                index: index,
                                tagged_name: text_f,
                                article_id: article_id,
                            },
                            success: function(data) {
                                document.getElementById('commentsData')
                                    .innerHTML = data
                            },
                            error: function(request, status, error) {
                                alert('Please Login');
                            }
                        });
                        console.log(text_f, index)
                    });
                });
            }).mouseleave(function() {
                $(".g").remove();
            });

        });

        $('#save_comment').click(function() {

            let index = document.getElementById("indexModal").value
            let taggedName = document.getElementById("taggedNameModal").value
            taggedName = taggedName.replace('@', '');
            taggedName = taggedName.replace('|', '');
            let comment = document.getElementById("comment").value
            let _token = $('meta[name="csrf-token"]').attr('content');
            let article_id = document.getElementById("article_id").value
            if (!comment) {
                return alert('Please Post Comment');
            }

            if (user_token == 0) {
                return alert('Please login first');
            } else {
                $.ajax({
                    url: "/api/save_comment",
                    headers: {
                        "Authorization": `Bearer ${user_token}`
                    },
                    type: 'POST',
                    data: {
                        index: index,
                        taggedName: taggedName,
                        comment: comment,
                        user_token: user_token,
                        article_id: article_id,
                    },
                    success: function(json) {

                        // alert('Done');
                        $('#add_comment_main').modal('hide');

                        document.getElementById("blue_form").reset();

                        // modal.style.display = "none";
                        location.reload();



                    },

                    error: function(request, status, error) {
                        alert('Please Login');
                    }
                });
            }


            //  alert(taggedName);

        });


        $('#save_comment_red').click(function() {

            let index = document.getElementById("indexRed").value
            let taggedName = document.getElementById("taggedNameModalRed").value
            taggedName = taggedName.replace('@', '');
            taggedName = taggedName.replace('|', '');
            let comment = document.getElementById("comment_red").value
            let _token = $('meta[name="csrf-token"]').attr('content');
            let article_id = document.getElementById("article_id_red").value
            if (!comment) {
                return alert('Please Post Comment');
            }

            if (user_token == 0) {
                return alert('Please login first');
            } else {
                $.ajax({
                    url: "/api/save_comment",
                    headers: {
                        "Authorization": `Bearer ${user_token}`
                    },
                    type: 'POST',
                    data: {
                        index: index,
                        taggedName: taggedName,
                        comment: comment,
                        user_token: user_token,
                        article_id: article_id,
                    },
                    success: function(json) {

                        // alert('Done');
                        $('#comment_red_main').modal('hide');

                        document.getElementById("red_form").reset();

                        // modal.style.display = "none";
                        location.reload();



                    },

                    error: function(request, status, error) {
                        alert('Please Login');
                    }
                });
            }


            //  alert(taggedName);

        });


        $("#send_invitation_form").submit(function(event) {
            event.preventDefault();
            $('#send_invitation_modal').modal('hide');
            let email = document.getElementById("email").value
            let phone = document.getElementById("phone").value
            let country_code = document.getElementById("country_code").value
            let article_id = document.getElementById("ar_id").value

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "/send_invitation",
                type: 'POST',

                data: {
                    "_token": "{{ csrf_token() }}",
                    email: email,
                    phone: '+' + country_code + phone,
                    article_id: article_id,
                },
                success: function(data) {

                    $('#send_invitation_modal').modal('hide');
                    document.getElementById("send_invitation_form").reset();
                },

                error: function(jqXHR, json) {
                    for (var error in json.errors) {
                        $('#errors').append(json.errors[error] + '<br>');
                    }
                }
            });

        });
    </script>
    <script></script>
@endpush
