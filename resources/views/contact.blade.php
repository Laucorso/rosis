<x-web>
    <section class="module bg-dark" data-background="{{asset('images')}}/section-4.jpg">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 offset-sm-3">
                    <h2 class="module-title font-alt mb-0">{{__('Contact Form')}}</h2>
                </div>
            </div>
        </div>
    </section>
    <div class="main">
        <section class="module" id="contact">
          <div class="container">
            <div class="row">
              <div class="col-sm-8 offset-sm-2">
                <h2 class="module-title font-alt">{{__('Get in touch')}}</h2>
                <div class="module-subtitle font-serif"></div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-8 offset-sm-2">
                <form id="contactForm" role="form" method="post" action="/contact.php">
                    @csrf
                  <div class="form-group">
                    <label class="sr-only" for="name">Name</label>
                    <input class="form-control" type="text" id="name" name="name" placeholder="{{__('Your Name')}}*" required="required" data-validation-required-message="Please enter your name."/>
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <label class="sr-only" for="email">Email</label>
                    <input class="form-control" type="email" id="email" name="email" placeholder="{{__('Your Email')}}*" required="required" data-validation-required-message="Please enter your email address."/>
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="form-group">
                    <textarea class="form-control" rows="7" id="message" name="message" placeholder="{{('Your Message')}}*" required="required" data-validation-required-message="Please enter your message."></textarea>
                    <p class="help-block text-danger"></p>
                  </div>
                  <div class="text-center">
                    <button class="btn btn-block btn-round btn-d" id="cfsubmit" type="submit">{{__('Submit')}}</button>
                  </div>
                </form>
                <div class="ajax-response font-alt" id="contactFormResponse"></div>
              </div>
            </div>
          </div>
        </section>
    </div>
    @push('scripts')
    <script>
        $("#contactForm").submit(function (e) {
            e.preventDefault();
            var $ = jQuery;

            var postData = $(this).serializeArray(),
                formURL = $(this).attr("action"),
                $cfResponse = $('#contactFormResponse'),
                $cfsubmit = $("#cfsubmit"),
                cfsubmitText = $cfsubmit.text();

            $cfsubmit.text("Sending...");

            $.ajax({
                url: formURL,
                type: "POST",
                data: postData,
                success: function (data) {
                    $cfResponse.html(data);
                    $cfsubmit.text(cfsubmitText);
                    $('#contactForm input[name=name]').val('');
                    $('#contactForm input[name=email]').val('');
                    $('#contactForm textarea[name=message]').val('');
                },
                error: function (data) {
                    alert("Error occurd! Please try again");
                }
            });
            return false;
        });
        </script>
    @endpush
</x-web>