<x-header pagetitle="about" />
<div class="contactbanner bannerstyle">
    <div class="d-flex justify-content-center">
        <h2><span><a href="{{ url('/')}}">Home</a></span><span class="currenttext"> / Contact</span></h2>
    </div>
</div>
<div class="container-fluid my-5 py-4">
        <div class="row">
            <div class="col-md-6">
                <h2  class="mb-2">Contact Us</h2>
                <form class="cform">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter your name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Your Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Your Message</label>
                        <textarea class="form-control" id="message" rows="4" placeholder="Enter your message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </form>
            </div>
            <div class="col-md-6 clocation">
                <h2 class="mb-2">Our Location</h2>
                <iframe 
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d246144.37453964158!2d-0.48243456234524125!3d51.507217134760734!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48761cb344df64fd%3A0xfda12648c5be4c09!2sLondon%2C%20UK!5e0!3m2!1sen!2s!4v1691418245625!5m2!1sen!2s" 
                    width="100%" 
                    height="450" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    
</div>
<x-footer />