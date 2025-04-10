@extends('layouts.front.masternoindex')
@section('content')
<style>
@media (max-width: 992px) {
.breadCrumpsCont {
	display: none;
	}
.abtCotntWrapper {
	background: #f2f2f2;
	margin-top: 10px;
	padding-bottom: 1px;
	}
.abtCtntCont {
    padding: 20px;
    background: #fff;
    margin-bottom: 30px;
	}
.abtImgBox {
    min-width: 150px;
	max-width: 225px;
    height: auto;
    overflow: hidden;
    background: #f9f9f9;
    border-radius: 5px;
	margin-bottom: 5px;
	}
.abtImgBox img {
    width: 100%;
    height: 225px;
    border-radius: 5px;
	}
.abtCotnt h4 {
	font-size: 16px;
	line-height: 18px;
	color: #000001;
	font-weight: 500;
	text-align: left;
	margin-bottom: 15px;
	}
.abtCotnt p {
	font-size: 14px;
	line-height: 23px;
	color: #000001;
	font-weight: 500;
	text-align: justify;
	margin-bottom: 0;
	}
}
@media (min-width: 992px) {
.breadCrumpsCont {
	background: #f2f2f2;
	}
.pageContainer {
	width: 1200px;
	margin: 0 auto;
	}
.breadCrumpsCont ul li {
	display: inline-block;
    padding: 15px 0px;
	font-size: 14px;
	line-height: 16px;
	color: #000001;
	font-weight: 500;
	}
.breadCrumpsCont ul li a:hover {
	color: #008cff;
	}
.breadCrumpsCont ul .active {
	color: #008cff;
	font-size: 16px;
	line-height: 16px;
	text-transform: none;
	}
.abtCotntWrapper {
	background: #f2f2f2;
	padding-top: 20px;
	padding-bottom: 20px;
	}
.abtCtntCont {
	border: 1px solid #e7e7e7;
	border-radius: 10px;
	padding: 20px;
	background: #fff;
	margin-bottom: 30px;
	}
.abtImgBox {
	width: 400px;
	height: auto;
	overflow: hidden;
	background: #f9f9f9;
	border-radius: 5px;
	display: flex;
    flex-shrink: 0;
	}
.abtImgBox img {
	width: 100%;
	height: 225px;
	border-radius: 5px;
	}
.abtCotnt h4 {
	font-size: 18px;
	line-height: 20px;
	color: #000001;
	font-weight: 500;
	text-align: left;
	margin-bottom: 15px;
	}
.abtCotnt p {
	font-size: 15px;
	line-height: 26px;
	color: #000001;
	font-weight: 500;
	text-align: justify;
	margin-bottom: 0;
	}
}
</style>
<!--Breadcrumps-->
<div class="breadCrumpsCont">
	<div class="pageContainer">
		<div class="row">
			<div class="col-md-12">
				<div>
					<ul>
						<li><a href="{{ url('/') }}">Home /</a></li>
						<li class="active">About us</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<section>
	<div class="abtCotntWrapper">
		<div class="pageContainer">
			<div class="abtCtntCont clearfix">
				<div class="abtImgBox leftFloat appendRight30">
					<img src="{{ asset("/resources/assets/frontend/") }}/img/who_we_are.jpg" alt="" />
				</div>
				<div class="abtCotnt">
					<h4>Who We Are?</h4>
					<p>We are one of the fastest growing Leisure Travel Company, operating in India and Abroad. Our aim is to meet client's expectations with High quality and Personalized services, Reliability & Flexibility, in accordance with Best rates worldwide. We ensure you always travel with a Smile and Joy, whether it is a Holiday Tour or Business Trip in India and Abroad. We welcome Tourists from other part of the Globe also, assuring the High quality service experience. There's a saying in India, "Athithi Devo Bhava", which means "The Guest is God". Our vision is to grow with Honesty and Transparency, Setting new benchmarks by creating new trends and innovation, whilst demonstrating a commitment to social responsibility.</p>
				</div>
			</div>
			<div class="abtCtntCont clearfix">
				<div class="abtImgBox rightFloat appendLeft30">
					<img src="{{ asset("/resources/assets/frontend/") }}/img/what-we-do.jpg" alt="" />
				</div>
				<div class="abtCotnt">
					<h4>What We Do?</h4>
					<p>We firmly believe in client's satisfaction and work very hard to achieve it. We put our client's comfort on top priority and complete business transparency as a policy. Our partnership with innumerable Hotels, Resorts and Airlines worldwide enable us to provide you with very best holiday deals & offers available in market. You can choose from a multitude of hotels worldwide and book your stay.</p>
				</div>
			</div>
			<div class="abtCtntCont clearfix">
				<div class="abtImgBox leftFloat appendRight30">
					<img src="{{ asset("/resources/assets/frontend/") }}/img/how-work.jpg" alt="" />
				</div>
				<div class="abtCotnt">
					<h4>How we work?</h4>
					<p>We have a dedicated team of Travel professionals, rich in experience and knowledge, who take care of the client's requirements. Having rich in experience and knowledge, our team take care of best suited Travel itineraties, Flight booking, best Hotel selection, Transfer arrangements and Holiday activities, making the Holidays memorable. Our team is always available 24x7 to provide the hassle free and comfortable touring experience. We love to hear the feedback, this motivates us and improvise our services to the unparallel experience.</p>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection