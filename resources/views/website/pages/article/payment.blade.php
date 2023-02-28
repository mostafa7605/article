@extends('website.layouts.app')
@section('content')
    <div class="articles-containerr payment container">

        <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation"
            data-cc-on-file="false"
            data-stripe-publishable-key="pk_test_51HzOMSBvnNTFpcxYuiz0sZdc9r0CDHQmAM04dwLjVLQqJAnhGNFkYTKq1rW5dynnk8FxP8mczdUhiNXJnWCsudqE00XXV9wGy2"
            id="payment-form">
            @csrf
            <input type="hidden" name="article_id" value="{{ $id }}">
            <input type="hidden" name="cost" value="{{ $cost }}">

            <div class="row">
                <div class="col-md-8">
                    <div class="panel panel-default credit-card-box">
                        <div class="panel-heading display-table">
                            <div class="row display-tr">
                                <h3 class="panel-title display-td">Payment Details</h3>
                                <p>Complete your purchase by providing<br> your payment details.</p>
                            </div>
                        </div>
                        <div class="panel-body mt-4">

                            @if (Session::has('success'))
                                <div class="alert alert-success text-center">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <p>{{ Session::get('success') }}</p>
                                </div>
                            @endif


                            <div class='form-row row mb-3'>
                                <div class='col-xs-12 form-group required'>
                                    <label class='control-label'>Name on Card</label> <input class='form-control'
                                        size='4' type='text' required>
                                </div>
                            </div>

                            <div class='form-row row mb-3'>
                                <div class='col-xs-12 form-group required'>
                                    <label class='control-label'>Card Number</label> <input autocomplete='off'
                                        class='form-control card-number' size='20' type='text' required>
                                </div>
                            </div>

                            <div class='form-row row mb-3'>
                                <div class='col-xs-12 col-md-4 form-group cvc required mb-3'>
                                    <label class='control-label'>CVC</label> <input autocomplete='off'
                                        class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'
                                        required>
                                </div>
                                <div class='col-xs-12 col-md-4 form-group expiration required mb-3'>
                                    <label class='control-label'>Expiration Month</label> <input
                                        class='form-control card-expiry-month' placeholder='MM' size='2'
                                        type='text' required>
                                </div>
                                <div class='col-xs-12 col-md-4 form-group expiration required mb-3'>
                                    <label class='control-label'>Expiration Year</label> <input
                                        class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                        type='text' required>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-xs-12">

                                </div>
                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="pay_number d-none d-lg-block">
                        <h3>Pay for</h3>
                        <div class="position-relative w-100" style="height:auto; max-height: 268px;max-width: 362px;">
                            <img src="{{ asset($article->image) }}" class="panner " style="height: 268px;width: 100%;" />
                            <div class="position-absolute bottom-0 start-50 translate-middle-x "
                                style="
                        background: transparent url('img/jeff-sheldon-9SyOKYrq-rE-unsplash.png') 0% 0% no-repeat padding-box;
                        box-shadow: 0px 3px 6px #00000029;
                        border-radius: 6px;
                        opacity: 1;
                        backdrop-filter: blur(21px);
                        -webkit-backdrop-filter: blur(21px);
                        width: 80%;
                        padding: 15px 10px 15px 10px;
                        color: #fff;margin-bottom: 20px;">
                                <p class=""
                                    style="font-size: 15px;
                        display: flex;
                        align-items: baseline;">
                                    Published {{ date('F d, Y', strtotime($article->created_at)) }}
                                    <img style="margin-left: 7px;" src="{{ asset('assets/img/tag.svg ') }}">
                                </p>
                                <h3 style="font-size: 20px">{{ $article->title }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="price_payment">
                        <h3>Total</h3>
                        <p>${{ $article->cost }}</p>
                    </div>
                    <div class="button_payment">
                        <button class="" type="submit">Pay ${{ $article->cost }}</button>
                    </div>
                    <div class="terms_payment">
                        <p> By clicking the button, you agree to the <a href=""  data-bs-toggle="modal" data-bs-target="#exampleModal">Terms of service</a>
                            <br> as well as the
                            
                        </p>
                    </div>
                </div>
            </div>

        </form>

    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                {{-- <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div> --}}
                <div class="modal-body modal-body-footer" style="padding: 50px 40px 30px 40px;">
                    <div class="d-flex align-items-start" >
                        <div class="nav flex-column nav-pills me-3 " style="border-right: 1px solid #EFEFEF;width: 300px;" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                            
                            <button class="nav-link active" id="v-pills-terms1-tab" data-bs-toggle="pill" data-bs-target="#v-pills-terms1"
                                type="button" role="tab" aria-controls="v-pills-terms1" aria-selected="true">Interpretation and Definitions</button>
    
                            <button class="nav-link" id="v-pills-terms2-tab" data-bs-toggle="pill" data-bs-target="#v-pills-terms2"
                                type="button" role="tab" aria-controls="v-pills-terms2" aria-selected="false">Acknowledgment</button>
    
                            <button class="nav-link" id="v-pills-terms3-tab" data-bs-toggle="pill" data-bs-target="#v-pills-terms3"
                                type="button" role="tab" aria-controls="v-pills-terms3" aria-selected="false">Links to Other websites</button>
    
                            <button class="nav-link" id="v-pills-terms4-tab" data-bs-toggle="pill" data-bs-target="#v-pills-terms4"
                                type="button" role="tab" aria-controls="v-pills-terms4" aria-selected="false">Termination</button>
    
                            
                            
                            <button class="nav-link" id="v-pills-terms5-tab" data-bs-toggle="pill" data-bs-target="#v-pills-terms5" type="button"
                                role="tab" aria-controls="v-pills-terms5" aria-selected="true">Limitation of Liability</button>
                            
                            <button class="nav-link" id="v-pills-terms6-tab" data-bs-toggle="pill" data-bs-target="#v-pills-terms6" type="button"
                                role="tab" aria-controls="v-pills-terms6" aria-selected="false">“AS IS “ Disclaimer</button>
                            
                            <button class="nav-link" id="v-pills-terms7-tab" data-bs-toggle="pill" data-bs-target="#v-pills-terms7"
                                type="button" role="tab" aria-controls="v-pills-terms7" aria-selected="false">Coverning law</button>
                            
                            <button class="nav-link" id="v-pills-terms8-tab" data-bs-toggle="pill" data-bs-target="#v-pills-terms8"
                                type="button" role="tab" aria-controls="v-pills-terms8" aria-selected="false">Disputes Resolution</button>
    
    
                            <button class="nav-link" id="v-pills-terms9-tab" data-bs-toggle="pill" data-bs-target="#v-pills-terms9"
                                type="button" role="tab" aria-controls="v-pills-terms9" aria-selected="false">For European Union Users</button>
                            
                            <button class="nav-link" id="v-pills-terms10-tab" data-bs-toggle="pill" data-bs-target="#v-pills-terms10"
                                type="button" role="tab" aria-controls="v-pills-terms10" aria-selected="false">United States Legal Compliance</button>
    
    
    
    
                        </div>
                        <div class="tab-content" id="v-pills-tabContent" style="height: 350px;overflow: auto;width: 740px;padding-right:10px;">
                            <div class="tab-pane fade show active paragraph_footer" id="v-pills-terms1" role="tabpanel" aria-labelledby="v-pills-terms1-tab">
                                Paragraphs are the building blocks of papers. Many students define paragraphs in terms of length: a paragraph is a group
                                of at least five sentences, a paragraph is half a page long, etc. In reality, though, the unity and coherence of ideas
                                among sentences is what constitutes a paragraph. A paragraph is defined as “a group of sentences or a single sentence
                                that forms a unit” (Lunsford and Connors 116). Length and appearance do not determine whether a section in a paper is a
                                paragraph. For instance, in some styles of writing, particularly journalistic styles, a paragraph can be just one
                                sentence long. Ultimately, a paragraph is a sentence or group of sentences that support one main idea. In this handout,
                                we will refer to this as the “controlling idea,” because it controls what happens in the rest of the paragraph.
                                How do I decide what to put in a paragraph?
                                Before you can begin to determine what the composition of a particular paragraph will be, you must first decide on an
                                argument and a working thesis statement for your paper. What is the most important idea that you are trying to convey to
                                your reader? The information in each paragraph must be related to that idea. In other words, your paragraphs should
                                remind your reader that there is a recurrent relationship between your thesis and the information in each paragraph. A
                                working thesis functions like a seed from which your paper, and your ideas, will grow. The whole process is an organic
                                one—a natural progression from a seed to a full-blown paper where there are direct, familial relationships between all
                                of the ideas in the paper.
                                
                                The decision about what to put into your paragraphs begins with the germination of a seed of ideas; this “germination
                                process” is better known as brainstorming. There are many techniques for brainstorming; whichever one you choose, this
                                stage of paragraph development cannot be skipped. Building paragraphs can be like building a skyscraper: there must be a
                                well-planned foundation that supports what you are building. Any cracks, inconsistencies, or other corruptions of the
                                foundation can cause your whole paper to crumble.
                                
                                So, let’s suppose that you have done some brainstorming to develop your thesis. What else should you keep in mind as you
                                begin to create paragraphs? Every paragraph in a paper should be:
                                
                                Unified: All of the sentences in a single paragraph should be related to a single controlling idea (often expressed in
                                the topic sentence of the paragraph).
                                Clearly related to the thesis: The sentences should all refer to the central idea, or thesis, of the paper (Rosen and
                                Behrens 119).
                                Coherent: The sentences should be arranged in a logical manner and should follow a definite plan for development (Rosen
                                and Behrens 119).
                                Well-developed: Every idea discussed in the paragraph should be adequately explained and supported through evidence and
                                details that work together to explain the paragraph’s controlling idea (Rosen and Behrens 119).
                                How do I organize a paragraph?
                                There are many different ways to organize a paragraph. The organization you choose will depend on the controlling idea
                                of the paragraph. Below are a few possibilities for organization, with links to brief examples:
                                
                                Narration: Tell a story. Go chronologically, from start to finish. (See an example.)
                                Description: Provide specific details about what something looks, smells, tastes, sounds, or feels like. Organize
                                spatially, in order of appearance, or by topic. (See an example.)
                                Process: Explain how something works, step by step. Perhaps follow a sequence—first, second, third. (See an example.)
                                Classification: Separate into groups or explain the various parts of a topic. (See an example.)
                                Illustration: Give examples and explain how those examples support your point. (See an example in the 5-step process
                                below.)
                            </div>
                            <div class="tab-pane fade" id="v-pills-terms2" role="tabpanel" aria-labelledby="v-pills-terms2-tab">
                                2
                            </div>
                            <div class="tab-pane fade" id="v-pills-terms3" role="tabpanel" aria-labelledby="v-pills-terms3-tab">
                                3
                            </div>
                            <div class="tab-pane fade" id="v-pills-terms4" role="tabpanel" aria-labelledby="v-pills-terms4-tab">
                                4
                            </div>
    
    
    
                            <div class="tab-pane fade" id="v-pills-terms5" role="tabpanel" aria-labelledby="v-pills-terms5-tab">
                                5
                            </div>
                            <div class="tab-pane fade" id="v-pills-terms6" role="tabpanel" aria-labelledby="v-pills-terms6-tab">
                                6
                            </div>
                            <div class="tab-pane fade" id="v-pills-terms7" role="tabpanel" aria-labelledby="v-pills-terms7-tab">
                                7
                            </div>
                            <div class="tab-pane fade" id="v-pills-terms8" role="tabpanel" aria-labelledby="v-pills-terms8-tab">
                                8
                            </div>
                            <div class="tab-pane fade" id="v-pills-terms9" role="tabpanel" aria-labelledby="v-pills-terms9-tab">
                                9
                            </div>
                            <div class="tab-pane fade" id="v-pills-terms10" role="tabpanel" aria-labelledby="v-pills-terms10-tab">
                                10
                            </div>
    
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" style="background: transparent;color:#5D5960;border:0;box-shadow: none;" class="btn btn-secondary" data-bs-dismiss="modal">
                        <img src="{{ asset('assets/img/left-arrow.png') }}" style="margin-right: 5px;" width="13px" />
                        Decline
                    </button>
                    <button type="button" style="background: #F9C100;color:#000;border:0;box-shadow: none;padding: 10px 30px;" class="btn btn-primary" data-bs-dismiss="modal">
                        Accept
                        <img src="{{ asset('assets/img/right-arrow.png') }}" style="margin-left: 5px;" width="13px" />
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script type="text/javascript">
        $(function() {
            var $form = $(".require-validation");
            $('form.require-validation').bind('submit', function(e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'
                    ].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }

            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        });
    </script>
@endpush
