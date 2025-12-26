@section('title', 'Contact')

<div>
    <main class="main">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow">Home</a>
                    <span></span> Contact us
                </div>
            </div>
        </div>
        <section class="pt-50 pb-50">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 m-auto">
                        <div class="contact-from-area padding-20-row-col wow FadeInUp">
                            <h3 class="mb-10 text-center">Get In Touch (যোগাযোগ করুন)</h3>
                            <p class="text-muted mb-30 text-center font-sm">We are here to help you.(আমরা আপনাকে সাহায্য
                                করার জন্য এখানে আছি।)</p>
                            <form class="contact-form-style text-center" id="contact-form" wire:submit.prevent='save'>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="input-style mb-20">
                                            <input name="name"
                                                class="@error('name') is-invalid @enderror form-control"
                                                placeholder="Full Name" wire:model='name' type="text">
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="input-style mb-20">
                                            <input name="email"
                                                class="@error('email') is-invalid @enderror form-control"
                                                placeholder="Your Email" wire:model='email' type="email">

                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="input-style mb-20">
                                            <input name="phone"
                                                class="@error('phone') is-invalid @enderror form-control"
                                                placeholder="Your Phone" wire:model='phone' type="tel">

                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="input-style mb-20">
                                            <input name="subject"
                                                class="@error('subject') is-invalid @enderror form-control"
                                                placeholder="Subject" wire:model='subject' type="text">


                                            @error('subject')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="textarea-style mb-30">
                                            <textarea class="@error('comment') is-invalid @enderror " name="comment" wire:model='comment' placeholder="Message"></textarea>

                                            @error('comment')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>
                                        <button class="submit submit-auto-width" type="submit">Send message <div
                                                style="height: 15px; width: 15px" wire:loading class="spinner-border"
                                                role="status">
                                                <span class="visually-hidden">Loading...</span>
                                            </div></button>

                                    </div>
                                </div>
                            </form>
                            <p class="form-messege"></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
