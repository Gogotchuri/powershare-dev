@extends('layouts.app')

@section('html-body')
    <body>
    <div id="app" class="background-image campaign-page static-page faq-page"
         style="background-image: url(/img/faq_background.png);">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('public.partials.mobile-nav')
                    @include('public.partials.nav')
                    @include('public.partials.connect-menu')
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8 left-panel">
                    <a class="d-none d-sm-block" href="/">
                        <img src="/img/logo-gradient.png" alt="Powershare logo" class="logo">
                    </a>
                    @include('public.partials.nav')
                    <div class="inspire">
                        <h1 class="main-heading">Frequently</h1>
                        <h1 class="main-heading">Asked</h1>
                        <h1 class="main-heading">Questions</h1>

                        <p class="question mt-5">What is POWERSHARE?</p>
                        <div class="ps-card answer mb-5">
                            <p>POWERSHARE is a mutually beneficial crowdfunding platform which turns unused CPU power
                                into fuel for important ideas and causes.</p>
                        </div>

                        <p class="question">How does POWERSHARE work?</p>
                        <div class="ps-card answer mb-5">
                            <p>Backers donate their CPU power to campaigns of their choice.</p>
                        </div>

                        <p class="question">How is POWERSHARE different from other Crowdfunding platforms?</p>
                        <div class="ps-card answer mb-5">
                            <p>It uses browser-based mining to fire up important causes and ideas, therefore anybody can
                                become a supporting hero without spending a penny from their pockets. Backers can choose
                                between traditional donation and mining for donation.</p>
                        </div>

                        <p class="question mt-5">What is Crowdfunding?</p>
                        <div class="ps-card answer mb-5">
                            <p>Crowdfunding is the practice of funding a project by raising money from a large number of
                                people who each contribute a relatively small amount.
                            </p>
                        </div>

                        <p class="question mt-5">What is blockchain?</p>
                        <div class="ps-card answer mb-5">
                            <p>Blockchain is a distributed digital ledger in which all the transactions are recorded
                                chronologically and publicly for everyone to see.</p>
                            <p> 6. What is cryptocurrency?</p>
                        </div>

                        <p class="question mt-5">What is cryptocurrency?</p>
                        <div class="ps-card answer mb-5">
                            <p>Cryptocurrency is a digital asset which functions on top of the underlying
                                blockchain.</p>
                        </div>

                        <p class="question mt-5">What is cryptocurrency mining?</p>
                        <div class="ps-card answer mb-5">
                            <p>Cryptocurrency mining is a process of verifying transactions and adding them into
                                blockchain digital ledger which creates new coins.</p>
                        </div>

                        <p class="question mt-5">What is CPU power?</p>
                        <div class="ps-card answer mb-5">
                            <p>CPU is the abbreviation for central processing unit. It is most commonly called a
                                processor, and is the brains of the computer where most calculations take place.</p>
                        </div>

                        <p class="question mt-5">What is Coinhive?</p>
                        <div class="ps-card answer mb-5">
                            <p>Coinhive is a set of scrypts that transfer user’s computing power to mining pools, which
                                then mine for cryptocurrency.</p>
                        </div>

                        <p class="question mt-5">Which currency is mined on POWERSHARE?</p>
                        <div class="ps-card answer mb-5">
                            <p>Currently, Monero.</p>
                        </div>

                        <p class="question mt-5">What is fundmining?</p>
                        <div class="ps-card answer mb-5">
                            <p>Fundmining is a process of browser-based mining for fundraising purposes only.</p>
                        </div>

                        <p class="question mt-5">How do I start fundmining?</p>
                        <div class="ps-card answer mb-5">
                            <p>Select a campaign you think is important, go to their page, and click ‘start minig’.
                                <a href="https://www.facebook.com/POWERSHARE.FUND/photos/a.277301432820159/318323972051238/?type=3&theater">For
                                    more information, click here.</a>
                            </p>
                        </div>

                        <p class="question mt-5">How will fundmining affect my computer?</p>
                        <div class="ps-card answer mb-5">
                            <p>Your CPU percentage, shown in ‘task manager’ will rise according to how much speed you
                                are donating. It will slightly increase energy consumption of your computer, and it may
                                slow down if total consumption will rise drastically.
                            </p>
                        </div>

                        <p class="question mt-5">How much will my computer earn?</p>
                        <div class="ps-card answer mb-5">
                            <p>With Coinhive technology, it will be substantially low. The amount of mined Monero
                                changes according to the network difficulty and size.</p>
                        </div>

                        <p class="question mt-5">Is my computer safe while mining?</p>
                        <div class="ps-card answer mb-5">
                            <p>Yes, POWERSHARE only uses only your computing power. None of your information is
                                transmitted to us or any other party.</p>
                        </div>

                        <p class="question mt-5">How much CPU power should I donate?</p>
                        <div class="ps-card answer mb-5">
                            <p>We recommend donating 20-30% of your CPU power.</p>
                        </div>

                        <p class="question mt-5"></p>
                        <div class="ps-card answer mb-5">
                            <p></p>
                        </div>

                        <p class="question mt-5">17. How can I check my CPU power usage?</p>
                        <div class="ps-card answer mb-5">
                            <p>Click cntrl+alt+del and go to ‘task manager’. The first box show you how much percent of
                                your CPU is being used.</p>
                        </div>

                        <p class="question mt-5">How can I donate apart from fundmining?</p>
                        <div class="ps-card answer mb-5">
                            <p>You can directly donate Ethereum from your wallet.</p>
                        </div>

                        <p class="question mt-5">How do I create a cryptocurrency wallet?</p>
                        <div class="ps-card answer mb-5">
                            <p>We suggest installing Metamask extension which will generate wallets itself.
                                Additionally, Metamask is also integrated into the POWERSHARE platform for more
                                simplicity.</p>
                        </div>

                        <p class="question mt-5">How do I create a cryptocurrency wallet?</p>
                        <div class="ps-card answer mb-5">
                            <p>We suggest installing Metamask extension which will generate wallets itself.
                                Additionally, Metamask is also integrated into the POWERSHARE platform for more
                                simplicity.</p>
                        </div>

                        <p class="question mt-5">How long does the account approval process take?</p>
                        <div class="ps-card answer mb-5">
                            <p>Mostly it’s instant, but it can take up to 72 hours.</p>
                        </div>

                        <p class="question mt-5">How do I start a campaign?</p>
                        <div class="ps-card answer mb-5">
                            <p>Register into your account and go to your profile page. After clicking ‘create a
                                campaign’, you will get a registration form. For further assistance please contact our
                                support.
                                <a href="https://www.facebook.com/POWERSHARE.FUND/photos/a.277301432820159/321132878437014/?type=3&theater">
                                    Click here for more information.
                                </a>
                            </p>
                        </div>

                        <p class="question mt-5">What kind of campaigns can I create?</p>
                        <div class="ps-card answer mb-5">
                            <p>Any kind that falls into the three main categories: ‘seed a business’ for startups,
                                ‘change lives’ for personal causes, and ‘save planet’ for environmental issues.</p>
                        </div>

                        <p class="question mt-5">Are there any restrictions?</p>
                        <div class="ps-card answer mb-5">
                            <p>Yes, all the information about it is in the terms and conditions.</p>
                        </div>

                        <p class="question mt-5">Is private information needed?</p>
                        <div class="ps-card answer mb-5">
                            <p>All the registered accounts should go through KYC process.</p>
                        </div>

                        <p class="question mt-5">How do I receive the raised funds?</p>
                        <div class="ps-card answer mb-5">
                            <p>On your Monero and/or Ethereum wallet.</p>
                        </div>

                        <p class="question mt-5">Can I mine for my campaign?</p>
                        <div class="ps-card answer mb-5">
                            <p>Yes.</p>
                        </div>

                        <p class="question mt-5">Can I mine for multiple campaigns simultaneously?</p>
                        <div class="ps-card answer mb-5">
                            <p>Yes, but not recommended.</p>
                        </div>

                        <p class="question mt-5">How do I know campaign is not fake?</p>
                        <div class="ps-card answer mb-5">
                            <p>We do our best by manually reviewing every campaign.</p>
                        </div>

                        <p class="question mt-5">How do I know they receive the funding?</p>
                        <div class="ps-card answer mb-5">
                            <p>All the addresses are public, blockchain technology makes it transparent.</p>
                        </div>

                        <p class="question mt-5">How do campaigns exchange donated cryptocurrency for fiat?</p>
                        <div class="ps-card answer mb-5">
                            <p>Through various exchanges who have Monero and Ethereum listed.</p>
                        </div>

                        <p class="question mt-5">Are there any fees?</p>
                        <div class="ps-card answer mb-5">
                            <p>Currently there is no platform fee, but Coinhive takes 30% of mined Monero.</p>
                        </div>

                        <p class="question mt-5">Is any other website using the same technology?</p>
                        <div class="ps-card answer mb-5">
                            <p>Yes, the hopepage powered by Unicef Australia.</p>
                        </div>

                        <p class="question mt-5">How is alpha platform different from the final product?</p>
                        <div class="ps-card answer mb-5">
                            <p>It lacks various features: technological solutions, the scrypts, mutual benefit etc.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}" defer></script>
    @yield('scripts')

    @stack('scripts-stack')
    </body>
@endsection

@push('scripts-stack')

@endpush
