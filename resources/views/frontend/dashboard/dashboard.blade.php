@extends('frontend.master')
@section('stylesheet')
    
@endsection
@section('contain')
<div class="col-md-9 col-sm-8 col-xs-12">
    <div class="home-slider-wrapper slider-wrapper">
        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item active">
                    <img src="{{asset('frontend/echallan/assets/img/ocei_banner.png')}}" alt="Frist Slide" style="width:100%;">
                </div>

                <div class="item">
                    <img src="{{asset('frontend/echallan/assets/img/slider/slide-2.jpg')}}" alt="Secound Slide" style="width:100%;">
                </div>

                <div class="item">
                    <img src="{{asset('frontend/echallan/assets/img/slider/slide-3.jpg')}}" alt="Third Slide" style="width:100%;">
                </div>
            </div>

            <!-- Left and right controls -->
        </div>
    </div>
    <div class="clearfix col-xs-12 padding-lr0">
        <div class="padding-lr0 col-xs-12 homepage-tab-wrapper margin-top10">
            <ul class="nav nav-tabs tab-links"role="tablist">
            </ul>
           
        </div>
    </div>
</div>
@endsection