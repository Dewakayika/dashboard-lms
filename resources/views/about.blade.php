@section('title')
    Meels on Wheels
@endsection

@extends('layouts.app')
@vite('resources/css/flying.css')
@section('content')
<!-- banner -->
<div class="container-card">
    <div class="container row flex-lg-row-reverse align-items-center">
        
            <div class="col-lg-7">
                <h1 class="display-5 fw-bold lh-1 mb-3">About Meals On <span>Wheels</span></h1>
                <p class="mt-5 mb-3 text-justify">Meals on Wheel is a Professional Nonprofit Platform. 
                    Here we will provide you only interesting content, which you will like very much. 
                    We're dedicated to providing you the best of Nonprofit, with a focus on dependability and Support. 
                    We're working to turn our passion for Nonprofit into a booming online website. 
                    We hope you enjoy our Nonprofit as much as we enjoy offering them to you.</p>
            </div>

            <div class="col-10 col-sm-8 col-lg-5 flex justify">
            <img
                src="https://bit.ly/3DEnTWR"
                class="rounded flying"
                width="500"
                height="auto"
                loading="lazy"></div>
        </div>
    </div>

    <div class="container-card">
    <div class="container row flex-lg-row-reverse align-items-center">

    <div class="col-10 col-sm-8 col-lg-5 flex justify">
            <img
                src="https://bit.ly/3Uw5L8p"
                class="rounded flying"
                width="500"
                height="auto"
                loading="lazy"></div>

    <div class="col-lg-7">
                <h1 class="display-5 text-center fw-bold lh-1 mb-3">Our <span>Mission</span></h1>
                <p class="mt-5 mb-3 text-justify">Meals on Wheels' mission is to help people in need by making food donations to individuals at home who are unable to buy or prepare their own food. The food provided is food - food that is selected to be healthy for humans, the food is also divided into 2 choices which are cold food for people from far away locations, and warm food for people with locations that match the specified distance. In delivery, the driver who is selected to send food has a professional quality which of course has an assessment from the manager and a delivery rating.</p>
            </div>
        
        </div>
    </div>




@endsection
