<?php

if (!function_exists('getWebsiteData')) {
    function getWebsiteData($key = null)
    {
        // Get the website name from the environment variable
        $websitename = env('WEBSITENAME');
        
        // Default website data in case the website name is not set correctly or is missing
        $defaultWebsiteData = [
            'name' => 'Default Website Name',
            'logo' => url('/public/uploads/default-img.webp'),
            'favicon' => 'loading.....',
            'faviconApple' => 'loading.....',
            'alt' => 'loading',
            'route' => route('home'),
            'contact_email' => 'loading.....',
            'sender_email' => 'loading.....',
            'reply_to_email' => 'loading.....',
            'support_email' => 'loading.....',
            'reservation_email' => 'loading.....',
            'noreply_email' => 'loading.....',
            'cc_email' => 'loading.....',
            'bcc_email' => 'loading.....',
            'website_address' => 'loading.....',
            'phone' => 'loading....',
            'facebook' => 'facebook',
            'twitter' => 'twitter',
            'instagram' => 'instagram',
            //'googleplus' => 'googleplus',
            'googlemap' => null, // Default to null if no map is available
            'metaAuthor' => 'loading.....',
            'gtagId' => 'gtag loading.....',
            
            'ogTitle' => 'loading.....',
            'ogDescription' => 'loading.....',
            'ogImage' => 'loading.....',
            'twitterTitle' => 'loading.....',
            'twitterDescription' => 'loading.....',
            'twitterImage' => 'loading.....',

            'adminLoginTitle' => 'title loading.....',
            'developerName' => 'Developed By: Cherry Tech',
            'startingYear' => '2006',
            'copyRight' => 'All Rights Reserved - by loading....',

            /*if no seo available for webpage, it will use default*/
            'defaultTitle' => 'title loading.....',
            'metaKeywords' => 'tour packages',
            'metaDescription' => 'enjoy luxury tour packages',

            'metaTitle_Home' => '',
            'metaKeywords_Home' => '',
            'metaDescription_Home' => '',

            'metaTitle_Testimonials' => '',
            'metaKeywords_Testimonials' => '',
            'metaDescription_Testimonials' => '',
        ];

        // Initialize website data as empty
        $websiteData = [];

        // If website name is "1", set data for 'The World Gateway'
        if ($websitename == "1") {
            $websiteData = [
                'name' => 'The World Gateway',
                'logo' => url('/public/uploads/twg.png'),
                //'favicon' => url('/public/favicon/twg_favicon_io-new/twg-favicon.ico'),
                'favicon' => url('/public/favicon/twg_favicon_io-new/twg-favicon-16x16.png'),
                'faviconApple' => url('/public/favicon/twg_favicon_io-new/twg-apple-touch-icon.png'),
                'alt' => 'The World Gateway',
                'route' => route('home'),
                'contact_email' => 'contact@theworldgateway.com',
                'sender_email' => 'theworldgateway@gmail.com',
                'reply_to_email' => 'theworldgateway@gmail.com',
                'support_email' => 'support@theworldgateway.com',
                'reservation_email' => 'reservations@theworldgateway.com',
                'noreply_email' => 'noreply@theworldgateway.com',
                'cc_email' => 'theworldgateway@gmail.com',
                'bcc_email' => 'theworldgateway@gmail.com',
                'website_address' => 'http://www.theworldgateway.com',
                'phone' => '9650731717',
                'facebook' => 'https://www.facebook.com/theworldgateway',
                'twitter' => 'https://www.twitter.com/theworldgateway',
                'instagram' => 'https://www.instagram.com/theworldgateway',
                //'googleplus' => 'https://plus.google.com/theworldgateway',
                'keyword' => 'The World Gateway, Holiday Packages, Hotel Booking, Flight Booking, Tour Activities, Car Rental, Visa Assistance, Forex Exchange, Travel Insurances',
                'description' => 'The world Gateway, Holiday Packages, Hotel Booking, Flight Booking, Tour Activities, Car Rental, Visa Assistance, Forex Exchange, Travel Insurances',
                'title' => 'The World Gateway',
                'googlemap' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3501.208970999417!2d77.35142401442873!3d28.65346098240954!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfb2eb76f031f%3A0xa11086f8388220c4!2sThe+World+Gateway+(theworldgateway.com)!5e0!3m2!1sen!2sin!4v1538112314411" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>',
                'metaAuthor' => 'The World Gateway',
                'gtagId' => 'UA-141582107-1',
                
                'ogTitle' => 'The World Gateway | Book Cheap Flights, Hotels & Holiday Packages Online',
                'ogDescription' => 'Find the best travel deals with The World Gateway! Book cheap flights, top-rated hotels, and customized holiday packages for domestic & international travel. Exclusive discounts on airfare, hotels, and tours – plan your next trip today!',
                'ogImage' => url('/public/uploads/twg.png'),
                'twitterTitle' => 'Exclusive Travel Deals! 🌍✈️ Book Flights, Hotels & Holiday Packages at TheWorldGateway',
                'twitterDescription' => 'Book smarter, travel better! 🎟️✨ Find the best prices on flights, hotels & tours with TheWorldGateway.',
                'twitterImage' => url('/public/uploads/twg.png'),

                'adminLoginTitle' => 'The World Gateway',
                'developerName' => 'Developed By: Cherry Tech',
                'startingYear' => '2006',
                'copyRight' => 'All Rights Reserved - by The World Gateway',

                /*if no seo available for webpage, it will use default*/
                'defaultTitle' => 'The World Gateway - Travel Website 50% OFF on Holidays, Flights & Hotels',
                'metaKeywords' => 'Explore our exclusive holiday packages designed for all travelers. Whether you are looking for family vacation deals, honeymoon tour packages, or last-minute getaways, we have the perfect trip for you!',
                'metaDescription' => '\u{2705} Find the best travel deals with The World Gateway! Book cheap flight tickets, top-rated hotels, and customized holiday packages for India & international destinations. Get exclusive discounts on domestic & international flights, hotels, and tour packages.',

                'metaTitle_Home' => '',
                'metaKeywords_Home' => '',
                'metaDescription_Home' => '',

                'metaTitle_Testimonials' => 'The World Gateway',
                'metaKeywords_Testimonials' => '.',
                'metaDescription_Testimonials' => '.',

            ];
        }
        // If website name is "0", set data for 'Rapidex Travels'
        elseif ($websitename == "0") {
            $websiteData = [
                'name' => 'Rapidex Travels',
                'logo' => url('/public/uploads/logo.png'),
                //'favicon' => url('/public/favicon/rt_favicon_io/rt-favicon.ico'),
                'favicon' => url('/public/favicon/twg_favicon_io-new/rt-favicon-16x16.png'),
                'faviconApple' => url('/public/favicon/rt_favicon_io/rt-apple-touch-icon.png'),
                'alt' => 'Rapidex Travels',
                'route' => route('home'),
                'contact_email' => 'support@rapidextravels.com',
                'sender_email' => 'rapidextravels@gmail.com',
                'reply_to_email' => 'rapidextravels@gmail.com',
                'support_email' => 'support@rapidextravels.com',
                'reservation_email' => 'reservations@rapidextravels.com',
                'noreply_email' => 'noreply@rapidextravels.com',
                'cc_email' => 'rapidexholidays@gmail.com',
                'bcc_email' => 'rapidexholidays@gmail.com',
                'website_address' => 'http://www.rapidextravels.com',
                'phone' => '9910293193',
                'facebook' => 'rapidextravels',
                'x' => 'rapidextravels',
                'instagram' => 'rapidextravels',
                //'googleplus' => 'rapidextravels',
                'keyword' => 'RapidexTravels, Holiday Packages, Hotel Booking, Flight Booking, Tour Activities, Car Rental, Visa Assistance, Forex Exchange, Travel Insurances',
                'description' => 'RapidexTravels Holiday Packages, Hotel Booking, Flight Booking, Tour Activities, Car Rental, Visa Assistance, Forex Exchange, Travel Insurances',
                'title' => 'Rapidex Travels',
                'googlemap' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3501.2055317245763!2d77.35164931442873!3d28.653563982409544!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfac0abc518bb%3A0x1702ec46d823bbe4!2sRapidex%20Travels!5e0!3m2!1sen!2sin!4v1568192236563!5m2!1sen!2sin" width="100%" height="350" frameborder="0" style="border:0" allowfullscreen></iframe>',
                'metaAuthor' => 'Rapidex Travels',
                'gtagId' => 'UA-118897981-1',
                
                'ogTitle' => 'Explore Exclusive Vacation Packages – Family, Honeymoon, and Budget-Friendly Getaways',
                'ogDescription' => 'loading.....',
                'ogImage' => url('/public/uploads/logo.png'),
                'twitterTitle' => 'Dream. Explore. Discover. 🏝️ Book Flights, Hotels & Tour Packages at Unbeatable Prices!',
                'twitterDescription' => 'Turn your travel dreams into reality! 🌎🛫 Get the best deals on flights, hotels & customized holiday packages.',
                'twitterImage' => url('/public/uploads/logo.png'),

                'adminLoginTitle' => 'Rapidex Travels',
                'developerName' => 'Developed By: Cherry Tech',
                'startingYear' => '2006',
                'copyRight' => 'All Rights Reserved - by Rapidex Travels',

                /*if no seo available for webpage, it will use default*/
                'defaultTitle' => 'Rapidex Travels',
                'metaKeywords' => 'Our personalized tour packages and exclusive travel deals ensure you get the best family vacation offers, romantic honeymoon packages, and unforgettable last-minute holiday deals.',
                'metaDescription' => 'Find the best vacation packages, from affordable family vacation deals to luxury honeymoon tours and last-minute getaways. Perfect trips for every traveler.',

                'metaTitle_Home' => '',
                'metaKeywords_Home' => '',
                'metaDescription_Home' => '',

                'metaTitle_Testimonials' => 'Rapidex Travels',
                'metaKeywords_Testimonials' => '.',
                'metaDescription_Testimonials' => '.',
            ];
        }

        // If no valid website name, fall back to default data
        else {
            $websiteData = $defaultWebsiteData;
        }

        // Return the specific key or the full array
        if ($key) {
            return $websiteData[$key] ?? null; // Return null if key doesn't exist
        }

        return $websiteData; // Return the full website data array
    }
}