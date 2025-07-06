<x-front-template>
    <x-slot:title>Contact Us</x-slot:title>

    <div class="container-fluid">
        <h2>Contact Us</span></h2>
        <div class='container mt-5'>
            <div class='card bg-dark text-white p-5'>
                <div class="row">
                    <div class="col-md-8">
                        <p class="form-intro mb-4"><small>We'd love to hear from you! Please fill out the form below, and
                                our team will get back to you as soon as possible.</p></small>
                        <x-auth-session-status :status="session('status')" />
                        <x-auth-errors :errors="$errors" />
                        @if (session('status') == '')
                            <form action='{{ route('contact_store') }}' method='post'>
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Full Name*</label>
                                    <input type="text" class="form-control" id="name"
                                        placeholder="Enter your name" required name='name'
                                        value='{{ old('name') }}'>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address*</label>
                                    <input type="email" class="form-control" id="email"
                                        placeholder="Enter your email" required name='email'
                                        value='{{ old('email') }}'>
                                </div>
                                <div class="mb-3">
                                    <label for="subject" class="form-label">Subject*</label>
                                    <input type="text" class="form-control" id="subject"
                                        placeholder="Enter subject" required name='subject'
                                        value='{{ old('subject') }}'>
                                </div>
                                <div class="mb-3">
                                    <label for="message" class="form-label">Message*</label>
                                    <textarea class="form-control" id="message" rows="5" placeholder="Enter your message" required name='message'>{{ old('message') }}</textarea>
                                </div>
                                <div class='mb-3'>
                                    @if (config('settings.g_site_key') != '' && config('settings.g_secret_key') != '')
                                        <div class="form-group">
                                            <div class="g-recaptcha" data-sitekey="{{ config('settings.g_site_key') }}">
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <button type="submit" class="btn btn-primary">Send Message</button>
                            </form>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <div class="contact-info">
                            <h4 class='mb-4'>Contact Information</h4>
                            <p><strong><small>Email:</small></strong> <a
                                    href="mailto:{{ config('settings.email') }}">{{ config('settings.email') }}</a></p>
                            @if (config('settings.tell') != '')
                                <p><strong><small>Phone:</small></strong> <a
                                        href="tel:{{ config('settings.tell') }}">{{ config('settings.tell') }}</a></p>
                            @endif
                            @if (config('settings.address') != '')
                                <p><strong><small>Address:</small></strong> {{ config('settings.address') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</x-front-template>
