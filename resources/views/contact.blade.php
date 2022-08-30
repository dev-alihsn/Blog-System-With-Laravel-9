@extends('main_layouts.master')
@section('title','MyBlog | contact')
@section('content')
<div class="colorlib-contact">
    <div class="container">
        <div class="alert alert-success global-message d-none"></div>
        <div class="row row-pb-md">
            <div class="col-md-12 animate-box">
                <h2>Contact Information</h2>
                <div class="row">
                    <div class="col-md-12">
                        <div class="contact-info-wrap-flex">
                            <div class="con-info">
                                <p><span><i class="icon-location-2"></i></span> 198 West 21th Street, <br> Suite 721 New York NY 10016</p>
                            </div>
                            <div class="con-info">
                                <p><span><i class="icon-phone3"></i></span> <a href="tel://1234567920">+ 1235 2355 98</a></p>
                            </div>
                            <div class="con-info">
                                <p><span><i class="icon-paperplane"></i></span> <a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
                            </div>
                            <div class="con-info">
                                <p><span><i class="icon-globe"></i></span> <a href="#">yourwebsite.com</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>Message Us</h2>
            </div>
            <div class="col-md-6">
                <x-blog.message status="success" />
                <form onsubmit="return false" method="POST">
                    @csrf
                    <div class="row form-group">
                        <div class="col-md-6">
                            <!-- <label for="fname">First Name</label> -->
                            <x-blog.form.input name="fname" placeholder="Your first name"/>
                        </div>
                        <div class="col-md-6">
                            <!-- <label for="lname">Last Name</label> -->
                            <x-blog.form.input name="lname" placeholder="Your lastname"/>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <!-- <label for="email">Email</label> -->
                            <x-blog.form.input type="email" name="email" placeholder="Your email address" />
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <!-- <label for="subject">Subject</label> -->
                            <x-blog.form.input name="subject" placeholder="Your subject of this message" />
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col-md-12">
                            <!-- <label for="message">Message</label> -->
                            <x-blog.form.textarea name="message" placeholder="Say something about us" />
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Send Message" class="btn btn-primary send-message-btn">
                    </div>
                </form>		
            </div>
            <div class="col-md-6">
                <div id="map" class="colorlib-map"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section("custome_script")
<script>
    $(document).on('click','.send-message-btn', (e) => {
        e.preventDefault();
        let $this = e.target;
        let fname = $($this).parents("form").find('input[name="fname"]').val();
        let lname = $($this).parents("form").find('input[name="lname"]').val();
        let email = $($this).parents("form").find('input[name="email"]').val();
        let subject = $($this).parents("form").find('input[name="subject"]').val();
        let message = $($this).parents("form").find('name="message"').val();
        let csrf_token = $($this).parents("form").find('input[name="_token"]').val();

        let formData = new FormData();
        formData.append('fname',fname);
        formData.append('lname',lname);
        formData.append('email',email);
        formData.append('subject',subject);
        formData.append('message',message);
        formData.append('_token',csrf_token);

        $.ajax({
            url: "{{route('contact.store')}}",
            data: formData,
            type: 'POST',
            dataType: 'JSON',
            processData: false,
            contentType: false,
            success: function(data){
                if(data.success){
                    console.log(data.errors.fname)
                    $('.global-message').fadeIn();
                    $('.global-message').text(data.message);

                    clearData($($this).parents('form'),['fname','lname','email','subject','message'])
                    setTimeout(() => {
                        $('.global-message').fadeOut();
                    }, 5000);
                }else {
                    for(const error in data['errors']){
                        document.querySelectorAll('small').forEach(small => {
                            if(small.classList.contains(error)){
                                small.textContent = data.errors[error];
                            }
                        });
                    }
                }
            }
        });
    });
</script>
@endsection