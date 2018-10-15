@extends('layouts.app')

@section('html-body')
    <body>
    <div id="app" class="background-image campaign-page" style="background-image: url(/img/background-campaign.png);">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-8 left-panel">
                    <a href="/">
                        <img src="/img/logo-gradient.png" alt="Powershare logo" class="logo">
                    </a>
                    @include('public.partials.nav')
                    <div class="inspire">
                        <div class="ps-card">
                            <p> 1. What is POWERSHARE?</p>
                            <p>POWERSHARE is a mutually beneficial crowdfunding platform which turns unused CPU power
                                into fuel for important ideas and causes.</p>
                            <p> 2. How does POWERSHARE work?</p>
                            <p>Backers donate their CPU power to campaigns of their choice.</p>
                            <p> 3. How is POWERSHARE different from other Crowdfunding platforms?</p>
                            <p>It uses browser-based mining to fire up important causes and ideas, therefore anybody can
                                become a supporting hero without spending a penny from their pockets. Backers can choose
                                between traditional donation and mining for donation.</p>
                            <p> 4. What is Crowdfunding?</p>
                            <p>Crowdfunding is the practice of funding a project by raising money from a large number of
                                people who each contribute a relatively small amount.
                            <p> 5. What is blockchain?</p>
                            <p>Blockchain is a distributed digital ledger in which all the transactions are recorded
                                chronologically and publicly for everyone to see.</p>
                            <p> 6. What is cryptocurrency?</p>
                            <p>Cryptocurrency is a digital asset which functions on top of the underlying
                                blockchain.</p>
                            <p> 7. What is cryptocurrency mining?</p>
                            <p>Cryptocurrency mining is a process of verifying transactions and adding them into
                                blockchain digital ledger which creates new coins.</p>
                            <p> 8. What is CPU power?</p>
                            <p>CPU is the abbreviation for central processing unit. It is most commonly called a
                                processor, and is the brains of the computer where most calculations take place.</p>
                            <p> 9. What is Coinhive?</p>
                            <p>Coinhive is a set of scrypts that transfer user’s computing power to mining pools, which
                                then mine for cryptocurrency.</p>
                            <p>10. Which currency is mined on POWERSHARE?</p>
                            <p>Currently, Monero.</p>
                            <p>11. What is fundmining?</p>
                            <p>Fundmining is a process of browser-based mining for fundraising purposes only.
                            <p>12. How do I start fundmining?</p>
                            <p>
                                Select a campaign you think is important, go to their page, and click ‘start minig’.
                                <a href="https://www.facebook.com/POWERSHARE.FUND/photos/a.277301432820159/318323972051238/?type=3&theater">For more information, click here.</a>
                            </p>
                            <p>13. How will fundmining affect my computer?</p>
                            <p>Your CPU percentage, shown in ‘task manager’ will rise according to how much speed you
                                are donating. It will slightly increase energy consumption of your computer, and it may
                                slow down if total consumption will rise drastically.
                            <p>14. How much will my computer earn?</p>
                            <p>With Coinhive technology, it will be substantially low. The amount of mined Monero
                                changes according to the network difficulty and size.
                            <p>15. Is my computer safe while mining?</p>
                            <p>Yes, POWERSHARE only uses only your computing power. None of your information is
                                transmitted to us or any other party.</p>
                            <p>16. How much CPU power should I donate?</p>
                            <p>We recommend donating 20-30% of your CPU power.
                            <p>17. How can I check my CPU power usage?</p>
                            <p>Click cntrl+alt+del and go to ‘task manager’. The first box show you how much percent of
                                your CPU is being used.</p>
                            <p>18. How can I donate apart from fundmining?</p>
                            <p>You can directly donate Ethereum from your wallet.
                            <p>19. How do I create a cryptocurrency wallet?</p>
                            <p>We suggest installing Metamask extension which will generate wallets itself.
                                Additionally, Metamask is also integrated into the POWERSHARE platform for more
                                simplicity.
                            <p>20. How long does the account approval process take?</p>
                            <p>Mostly it’s instant, but it can take up to 72 hours.
                            <p>21. How do I start a campaign?</p>
                            <p>
                                Register into your account and go to your profile page. After clicking ‘create a
                                campaign’, you will get a registration form. For further assistance please contact our
                                support.
                                <a href="https://www.facebook.com/POWERSHARE.FUND/photos/a.277301432820159/321132878437014/?type=3&theater">
                                    Click here for more information.
                                </a>
                            </p>
                            <p>22. What kind of campaigns can I create?</p>
                            <p>Any kind that falls into the three main categories: ‘seed a business’ for startups,
                                ‘change lives’ for personal causes, and ‘save planet’ for environmental issues.
                            <p>23. Are there any restrictions?</p>
                            <p>Yes, all the information about it is in the terms and conditions.</p>
                            <p>24. Is private information needed?</p>
                            <p>All the registered accounts should go through KYC process.
                            <p>25. How do I receive the raised funds?</p>
                            <p>On your Monero and/or Ethereum wallet.
                            <p>26. Can I mine for my campaign?</p>
                            <p>Yes.</p>
                            <p>27. Can I mine for multiple campaigns simultaneously?</p>
                            <p>Yes, but not recommended.</p>
                            <p>28. How do I know campaign is not fake?</p>
                            <p>We do our best by manually reviewing every campaign.</p>
                            <p>29. How do I know they receive the funding?</p>
                            <p>All the addresses are public, blockchain technology makes it transparent.</p>
                            <p>30. How do campaigns exchange donated cryptocurrency for fiat?</p>
                            <p>Through various exchanges who have Monero and Ethereum listed.</p>
                            <p>31. Are there any fees?</p>
                            <p>Currently there is no platform fee, but Coinhive takes 30% of mined Monero.</p>
                            <p>32. Is any other website using the same technology?</p>
                            <p>Yes, the hopepage powered by Unicef Australia.</p>
                            <p>33. How is alpha platform different from the final product?</p>
                            <p>It lacks various features: technological solutions, the scrypts, mutual benefit etc.</p>

                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="text-right">
                        @include('public.partials.auth-buttons')
                    </div>
                </div>
            </div>
        </div>
    </div>

    @yield('scripts')

    @stack('scripts-stack')
    </body>
@endsection

@push('scripts-stack')

@endpush
