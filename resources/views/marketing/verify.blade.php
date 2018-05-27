@include ('layouts.partials.marketing.header')
<!--    /*====================== verify-banner  =============================*/-->
<div class="verify-banner">
    <div class="overlay space" style="background-color: transparent;background-position: 100% 50%;">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h1 style="font-size: 36px">Make yourself known</h1>
                    <div style="max-width: 305px;margin: 0 auto;">
                        <a href="#" data-toggle="modal" data-backdrop="true" data-target="#SignUpModal" class="btn banner-button">Sign up now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--    /*====================== verity-content  =============================*/-->
<main class="verity-content">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="content">
                    <h3>About verified accounts <img src="{{ url('/assets/images/icon04.svg') }}" style="height: 30px;vertical-align: middle;"/></h3>
                    <p>The blue verified badge on Followback lets people know that an account of public interest is authentic. The badge appears next to the name on an account’s profile. It is always the same color and placed in the same location. Accounts that don’t have the blue verified badge next to their name but that display it somewhere else, for example in the profile photo, header photo or bio are not verified accounts. Verified badges must be applied by Followback, and accounts that use a badge as a part of profile photos, background photos, or in any other way that implies verified status, are subject to permanent account suspension.</p>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="content">
                    <h3>What types of accounts get verified?</h3>
                    <p>The blue verified badge on Followback lets people know that an account of public interest is authentic. A verified badge does not imply an endorsement by Followback.</p>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="content">
                    <h3>How can I get verified?</h3>
                    <p>If you think your account should be verified, message us in the chat or email us at <a href="mailto:verified@followback.com">verified@followback.com</a></p>
                </div>
            </div>
        </div>
    </div>
</main>
@include ('layouts.partials.marketing.footer')
