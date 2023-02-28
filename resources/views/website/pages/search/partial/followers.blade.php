<section class="profile-view">

    <div class="follower_content w-100">


        <div class="follower d-flex flex-wrap justify-content-lg-start justify-content-center">
            @if (count($users) == 0)
                <div>

                    <h2>No Results
                    </h2>
                </div>
            @else
                @foreach ($users as $user)
                    @if ($user->id != auth()->user()->id)
                        <div class="card_follower">
                            <div class="card_head">
                                @if (is_null($user->image) || $user->image == '')
                                    <img src="{{ asset('assets/img/person-img.png ') }}" width="110px" height="110px" />
                                @else
                                    <img style="border-radius: 50%;" src="{{ asset($user->image) }}" width="110px"
                                        height="110px">
                                @endif

                                <div>
                                    <ul>
                                        <li>
                                            <span>{{ count(\App\Models\Article::where('user_id', $user->id)->where('approved', 1)->get()) }}</span>
                                            <p>R-Publications</p>
                                        </li>
                                        <li>
                                            <span
                                                id="follower_span_{{ $user->id }}">{{ count(\App\Models\Users_Followers::where('follow_id', $user->id)->get()) }}</span>
                                            <p>Followers</p>
                                        </li>
                                        <li>
                                            <span>{{ count(\App\Models\Users_Followers::where('user_id', $user->id)->get()) }}</span>
                                            <p>Following</p>
                                        </li>
                                    </ul>
                                    <div class="w-100 pt-3">
                                        <a style="cursor: pointer;" onclick="following({{ $user->id }});"
                                            id="follow_link_{{ $user->id }}" class="follow_link">
                                            @if (\App\Models\Users_Followers::where('user_id', auth()->user()->id)->where('follow_id', $user->id)->first())
                                                Unfollow
                                            @else
                                                Follow
                                            @endif
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <a style="text-decoration: none;" href="{{ url('/person_profile/' . $user->id) }}">
                                <h2>{{ ucwords($user->first_name) }} {{ ucwords($user->last_name) }} <span>(
                                        {{ ucwords($user->username) }} )</span></h2>
                            </a>
                            <p>{{ $user->bio }}</p>

                        </div>
                    @endif
                @endforeach
            @endif
        </div>
    </div>



</section>
