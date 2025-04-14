@extends('layouts.front.master')
	@if(env("WEBSITENAME")==1)
		@section('keywords','India travel, travel in India, cheap air tickets, cheap flights, flight, hotels, hotel, holidays, air travel, air tickets, holiday packages, travel packages, tour packages, International travel, Theworldgateway')
		@section('desc',' Find best deals at TheWorldGateway for Flight Tickets, Hotels, Holiday Packages for India &amp; International travel. Book cheap air tickets online for Domestic &amp; International airlines, customized Tour packages and special deals on Hotel Bookings. ')
		@section("title", 'TheWorldGateway - Travel Website 50% OFF on Holidays, Flights & Hotels')
	@elseif(env("WEBSITENAME")==0)
		@section('keywords','India travel, travel in India, cheap air tickets, cheap flights, flight, hotels, hotel, holidays, air travel, air tickets, holiday packages, travel packages, tour packages, International travel, RapidexTravels')
		@section('desc','Find best deals at RapidexTravels for Flight Tickets, Hotels, Holiday Packages for India &amp; International travel. Book cheap air tickets online for Domestic &amp; International airlines, customized Tour packages and special deals on Hotel Bookings.')
		@section("title", 'RapidexTravels - Travel Website 50% OFF on Holidays, Flights & Hotels')
	@endif

@section('content')

<section>
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:400,400i,700,900&display=swap" rel="stylesheet">   <style>
      body {
        text-align: center;
        padding: 40px 0;
        background: #EBF0F5;
      }
        h1 {
          color: #88B04B;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-weight: 900;
          font-size: 40px;
          margin-bottom: 10px;
        }
        p {
          color: #404F5E;
          font-family: "Nunito Sans", "Helvetica Neue", sans-serif;
          font-size:20px;
          margin: 0;
        }
      i {
        color: #9ABC66;
        font-size: 100px;
        line-height: 200px;
        margin-left:-15px;
      }
      .card {
        background: white;
        padding: 60px;
        border-radius: 4px;
        box-shadow: 0 2px 3px #C8D0D8;
        display: inline-block;
        margin: 0 auto;
      }
    </style>

    <body>
      <div class="card">
      <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
        <i class="checkmark">✓</i>
      </div>
        <h1>Success</h1> 
        <p>We received your Payment;<br/> we'll be in touch shortly!</p>
      </div>
    </body>


</section>
@endsection