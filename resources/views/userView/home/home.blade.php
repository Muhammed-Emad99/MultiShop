@extends('layout.general')
@section('title')
    Home
@endsection

@section('content')
    <!-- Carousel Start -->
    @include('partial.home.carousel')
    <!-- Carousel End -->


    <!-- Featured Start -->
    @include('partial.home.benefits')
    <!-- Featured End -->


    <!-- Categories Start -->
    @include('partial.home.categories')
    <!-- Categories End -->


    <!-- Products Start -->
    @include('partial.home.featured')
    <!-- Products End -->


    <!-- Offer Start -->
    @include('partial.home.offer')
    <!-- Offer End -->


    <!-- Products Start -->
    @include('partial.home.recent')
    <!-- Products End -->


    <!-- Vendor Start -->
    @include('partial.home.vendor')
    <!-- Vendor End -->

@endsection
