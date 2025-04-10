@extends('layouts.front.masternoindex')
@section('content')
<div class="page-title-container" style="height: 2px">
<div class="container">
</div>
</div>
<!---->
<div class="container">
<div class="row">
<div class="col-md-10">
<div class="packagelist_head">
<ul class="breadcrumbs ">
<li><a href="{{url('/')}}">Home /</a></li>
<li class="active">Cookie Policy</li>
</ul>
</div>
</div>
<div class="col-md-2">
</div>
</div>
</div>
<!---->
<section >
<div class="container">
<div class="row">
<div class="col-md-12">
@if(env("WEBSITENAME")==1)
<h3>Cookie Policy</h3>
<p>World Gateway Pvt Ltd respects your privacy and is committed to safeguard the security of your personal data. We respect your need to understand how information is being collected, used, disclosed, transferred and stored. Thus we have developed below Cookie policy to familiarize you with our practices. We advise you to carefully read this policy together with our Website privacy policy.</p>
<h4>1. Purpose</h4>
<p>World Gateway Pvt Ltd uses cookies and other technologies to enhance your experience when you use our website. To that effect, we have developed the below cookie policy to familiarize you with our practices.</p>
<h4>2. Scope</h4>
<p>This policy is applicable to all individuals who visit our website and to all information collected by means of the cookies.</p>
<h4>3. What is a Cookie?</h4>
<p>Cookies are a feature of web browser software that allows web servers to temporarily store information within your browser. They are generally used to make websites work, to keep track of your movements within the website, to remember your login details, and for similar activities. Cookies are sent to the originating website on subsequent visit or to another website that recognizes the specific cookie. Most Web browsers automatically accept cookies. Cookies allow websites to recognize the device through which the website is accessed. Cookies can be used to store your preferences and past actions which can further be used to provide specific functionalities or options suited to your preferences, thus improving your website experience. Cookies cannot access any other information on your computer. Most Web browsers automatically accept cookies. Of course, by changing the options on your web browser or using certain software programs, you can control and delete how and whether cookies will be accepted by your browser. You can also edit your browser options to choose not to receive cookies in the future.</p>
<h4>4. Types of cookies</h4>
<p>There are different types of cookies, and they can be distinguished on the basis of their origin, function and lifespan. Important characteristics of cookies include the following:</p>
<ul>
<li>a. First party cookies are cookies that are stored by the website you are visiting, while third party cookies are stored by a website other than the one you are visiting.</li>
<li>Please note that we do not control the collection or further use of your data by third parties.</li>
<li>b. <b>Necessary cookies</b> are necessary to allow the technical operation of a website (e.g., they enable you to move around on a website and to use its features).</li>
<li>c. <b>Performance cookies</b> collect data on the performance of a website such as the number of visitors, the time spent on the website and error messages.</li>
<li>d. <b>Functionality cookies</b> increase the usability of a website by remembering your choices (e.g. language, region, login, and so on).</li>
<li>e. <b>Targeting/advertising cookies</b> enable a website to send you personalized advertising.</li>
<li>f. <b> Session cookies</b> are temporary cookies that are erased once you close your browser while persistent or permanent cookies stay on your device until you manually delete them or until your browser deletes them based on the duration period specified in the persistent cookie file.</li>
</ul>
<br>
<h4>5. Information collected and our purpose for using cookies and other technologies</h4>
<p>In order to help us maintain and improve our service to you, World Gateway Pvt Ltd website, online services, applications, and advertisements may use 'cookies' to collect information related to your use of the website. Cookies may also be used to carry out transactions and disabling them may affect the functionality of this website.</p>
<p>a. World Gateway Pvt Ltd India and its partners may use cookies or other technologies to record anonymous, non-personal information (not including your name, address email address or telephone number) about your visits to this and other websites in order to measure advertising effectiveness.</p>
<p>b. We may also collect non-personal information about your visit to our website, based on your browsing (click stream) activities. This information may include but is not limited to the pages browsed and products and services viewed or booked. This helps us to better manage and develop our offers and to provide you with better products and services tailored to your individual interests and needs. We may use this information to measure the entry and exit points of visitors to the website and respective numbers of visitors to various pages and sections of the website and details of searches performed. We may also use this information to measure the usage of advertising banners, other click through from the website.</p>
<p>c. As is true of most we gather some information automatically and store it in log files. This information includes Internet Protocol (IP) addresses, browser type and language, Internet Service Provider (ISP), referring and exit pages, operating system, date/time stamp, and clickstream data. We use this information to understand and analyse trends, to administer the website, to learn about user behaviour on the website, and to gather demographic information about our user base as a whole. World Gateway Pvt Ltd may use this information in our marketing and advertising services.</p>
<p>d. In some of our email messages, we use a “click-through URL” linked to content on the World Gateway Pvt Ltd website. When customers click one of these URLs, they pass through a separate web server before arriving at the destination page on our website. We track this click-through data to help us determine interest in particular topics and measure the effectiveness of our customer communications. If you prefer not to be tracked in this way, you should not click text or graphic links in the email messages.</p>
<p>e. Pixel tags enable us to send email messages in a format customers can read, and they tell us whether mail has been opened. We may use this information to reduce or eliminate messages sent to customers.</p>
<h4>6. Analytics Tools</h4>
<p>We use various analytics tools and third party technologies including Google Analytics to collect and analyze cookies. We have contractual relationship with these third party analytics companies, who collect this information. They may combine this information with other information that they already have independently collected from other websites. Many of these companies collect and use information under their own privacy policies.</p>
<h4>7. Controlling cookies</h4>
<p>Most internet browsers are set to automatically accept cookies. Depending on your browser, you can set your browser to warn you before accepting cookies, or you can set it to refuse them. If you do not want to receive cookies, most browsers allow you to control cookies through their setting preferences. Disabling cookies may impact your experience on our website. If you use different devices to access our website, you will need to ensure that each browser of each device is set to your cookie preference.</p>
<p>To learn more about cookies and how to disable them,
please visit <a href="http://www.allaboutcookies.org/manage-cookies/stop-cookies-installed.html" target="_blank">http://www.allaboutcookies.org/manage-cookies/stop-cookies-installed.html</a>
</p>
<h4>8. Changes to the policy</h4>
<p>This policy is effective as of 01st January 2020. We reserve the right to update or change this policy at any time, and we will provide you with the updated policy when we make any substantial updates at the earliest either through email or by providing a prominent policy of change on the website. You should check the policy periodically. Your continued use of the website after we post any modifications to the policy on this page will constitute your acknowledgment of the modifications and your consent to abide and be bound by the modified policy.</p>
@elseif(env("WEBSITENAME")==0)
<h4>Cookie Policy</h4>
<p>Rapidex Travels respects your privacy and is committed to safeguard the security of your personal data. We respect your need to understand how information is being collected, used, disclosed, transferred and stored. Thus we have developed below Cookie policy to familiarize you with our practices. We advise you to carefully read this policy together with our Website privacy policy.</p>
<h5>1. Purpose</h5>
<p>Rapidex Travels uses cookies and other technologies to enhance your experience when you use our website. To that effect, we have developed the below cookie policy to familiarize you with our practices.</p>
<h5>2. Scope</h5>
<p>This policy is applicable to all individuals who visit our website and to all information collected by means of the cookies.</p>
<h5>3. What is a Cookie?</h5>
<p>Cookies are a feature of web browser software that allows web servers to temporarily store information within your browser. They are generally used to make websites work, to keep track of your movements within the website, to remember your login details, and for similar activities. Cookies are sent to the originating website on subsequent visit or to another website that recognizes the specific cookie. Most Web browsers automatically accept cookies. Cookies allow websites to recognize the device through which the website is accessed. Cookies can be used to store your preferences and past actions which can further be used to provide specific functionalities or options suited to your preferences, thus improving your website experience. Cookies cannot access any other information on your computer. Most Web browsers automatically accept cookies. Of course, by changing the options on your web browser or using certain software programs, you can control and delete how and whether cookies will be accepted by your browser. You can also edit your browser options to choose not to receive cookies in the future.</p>
<h5>4. Types of cookies</h5>
<p>There are different types of cookies, and they can be distinguished on the basis of their origin, function and lifespan. Important characteristics of cookies include the following:</p>
<p>a. First party cookies are cookies that are stored by the website you are visiting, while third party cookies are stored by a website other than the one you are visiting.
Please note that we do not control the collection or further use of your data by third parties.
</p>
<p>b. <b>Necessary cookies</b> are necessary to allow the technical operation of a website (e.g., they enable you to move around on a website and to use its features).</p>
<p>c. <b>Performance cookies</b> collect data on the performance of a website such as the number of visitors, the time spent on the website and error messages.</p>
<p>d. <b>Functionality cookies</b> increase the usability of a website by remembering your choices (e.g. language, region, login, and so on).</p>
<p>e. <b>Targeting/advertising cookies</b> enable a website to send you personalized advertising.</p>
<p>f. <b>Session cookies</b> are temporary cookies that are erased once you close your browser while persistent or permanent cookies stay on your device until you manually delete them or until your browser deletes them based on the duration period specified in the persistent cookie file.</p>
<h5>5. Information collected and our purpose for using cookies and other technologies</h5>
<p>In order to help us maintain and improve our service to you, Rapidex Travels website, online services, applications, and advertisements may use 'cookies' to collect information related to your use of the website. Cookies may also be used to carry out transactions and disabling them may affect the functionality of this website.</p>
<p>a. Rapidex Travels India and its partners may use cookies or other technologies to record anonymous, non-personal information (not including your name, address email address or telephone number) about your visits to this and other websites in order to measure advertising effectiveness.</p>
<p>b. We may also collect non-personal information about your visit to our website, based on your browsing (click stream) activities. This information may include but is not limited to the pages browsed and products and services viewed or booked. This helps us to better manage and develop our offers and to provide you with better products and services tailored to your individual interests and needs. We may use this information to measure the entry and exit points of visitors to the website and respective numbers of visitors to various pages and sections of the website and details of searches performed. We may also use this information to measure the usage of advertising banners, other click through from the website.</p>
<p>c. As is true of most we gather some information automatically and store it in log files. This information includes Internet Protocol (IP) addresses, browser type and language, Internet Service Provider (ISP), referring and exit pages, operating system, date/time stamp, and clickstream data. We use this information to understand and analyse trends, to administer the website, to learn about user behaviour on the website, and to gather demographic information about our user base as a whole. Rapidex Travels may use this information in our marketing and advertising services.</p>
<p>d. In some of our email messages, we use a “click-through URL” linked to content on the Rapidex Travels website. When customers click one of these URLs, they pass through a separate web server before arriving at the destination page on our website. We track this click-through data to help us determine interest in particular topics and measure the effectiveness of our customer communications. If you prefer not to be tracked in this way, you should not click text or graphic links in the email messages.</p>
<p>e. Pixel tags enable us to send email messages in a format customers can read, and they tell us whether mail has been opened. We may use this information to reduce or eliminate messages sent to customers.</p>
<h5>6. Analytics Tools</h5>
<p>We use various analytics tools and third party technologies including Google Analytics to collect and analyze cookies. We have contractual relationship with these third party analytics companies, who collect this information. They may combine this information with other information that they already have independently collected from other websites. Many of these companies collect and use information under their own privacy policies.</p>
<h5>7. Controlling cookies</h5>
<p>Most internet browsers are set to automatically accept cookies. Depending on your browser, you can set your browser to warn you before accepting cookies, or you can set it to refuse them. If you do not want to receive cookies, most browsers allow you to control cookies through their setting preferences. Disabling cookies may impact your experience on our website. If you use different devices to access our website, you will need to ensure that each browser of each device is set to your cookie preference.<a href="http://www.allaboutcookies.org/manage-cookies/stop-cookies-installed.html" target="_blank">http://www.allaboutcookies.org/manage-cookies/stop-cookies-installed.html</a></p>
<h5>8. Changes to the policy</h5>
<p>This policy is effective as of 01st January 2020. We reserve the right to update or change this policy at any time, and we will provide you with the updated policy when we make any substantial updates at the earliest either through email or by providing a prominent policy of change on the website. You should check the policy periodically. Your continued use of the website after we post any modifications to the policy on this page will constitute your acknowledgment of the modifications and your consent to abide and be bound by the modified policy.</p>
@endif
</div>
</div>
</div>
<!---->
</section>
@endsection