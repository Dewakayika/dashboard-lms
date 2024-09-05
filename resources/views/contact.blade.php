@section('title')
Meels on Wheels
@endsection
@vite('resources/css/contact.css')
@vite('resources/css/flying.css')

@extends('layouts.app')

@section('content') 
<div class="row align-items-center">
    <div class="col-lg-5 px-5 mx-auto">
        <img
            src="https://bit.ly/3UtjVa6"
            alt=""
            class="img-fluid mb-4 mb-lg-0 flying"></div>
        <div class="col-lg-6">
            <form>
                <input name="name" type="text" class="feedback-input" placeholder="Name"/>
                <input name="email" type="text" class="feedback-input" placeholder="Email"/>
                <textarea name="text" class="feedback-input" placeholder="Comment"></textarea>
                <div class="d-grid gap-2">
                    <button class="btn btn-warning" type="button">SUBMIT</button>
                </div>
            </form>
        </div>
    </div>

@endsection