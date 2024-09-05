@section('title')
    Donation
@endsection

@extends('layouts.app')

@section('content')
    <div class="container flex items-center justify-center">
        <style>
            input::-webkit-outer-spin-button,
            input::-webkit-inner-spin-button {
                -webkit-appearance: none;
                margin: 0;
            }

            .StripeElement {
                box-sizing: border-box;
                height: 50px;
                padding: 15px 12px;
                border: 1px solid transparent;
                border-radius: 4px;
                background-color: white;
                box-shadow: 0 1px 3px 0 #e6ebf1;
                -webkit-transition: box-shadow 150ms ease;
                transition: box-shadow 150ms ease;
            }

            .StripeElement--focus {
                box-shadow: 0 1px 3px 0 #cfd7df;
            }

            .StripeElement--invalid {
                border-color: #fa755a;
            }

            .StripeElement--webkit-autofill {
                background-color: #fefde5 !important;
            }
        </style>
        <div class="w-[800px] bg-white my-6 shadow-md p-10 rounded-sm">
            <form action="{{ route('donor#Checkout') }}" method="post" id="payment-form">
                @csrf
                <div class="flex flex-col">
                    <div class="mb-3">
                        <input type="hidden" value="{{ $name }}" name="name">
                        <input type="hidden" value="{{ $gender }}" name="gender">
                        <input type="hidden" value="{{ $address }}" name="address">
                        <input type="hidden" value="{{ $email }}" name="email">
                        <input type="hidden" value="{{ $phone }}" name="phone">

                        <div class="donate-form__fields" id="js-donate-form-single" role="radiogroup">
                            <h3 class="mb-5 text-lg font-medium text-dark dark:text-white">Donation Amount</h3>
                            <div class="mb-3 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 w-full justify-center gap-4">
                                <div class="col-span-1 w-full">
                                    <input type="radio" id="$10" name="amount" value="10"
                                        class="hidden peer custom-control-input fixed-amount">
                                    <label for="$10"
                                        class="inline-flex justify-between items-center p-5 w-full text-gray-500 bg-white rounded-sm border-gray-200 cursor-pointer peer-checked:border-mow-shine-yellow border-2 border-solid peer-checked:text-mow-shine-yellow hover:text-gray-600 hover:bg-gray-100">
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold">$10</div>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-span-1 w-full">
                                    <input type="radio" id="$20" name="amount" value="20"
                                        class="hidden peer custom-control-input fixed-amount">
                                    <label for="$20"
                                        class="inline-flex justify-between items-center p-5 w-full text-gray-500 bg-white rounded-sm border-gray-200 cursor-pointer peer-checked:border-mow-shine-yellow border-2 border-solid peer-checked:text-mow-shine-yellow hover:text-gray-600 hover:bg-gray-100">
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold">$20</div>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-span-1 w-full">
                                    <input type="radio" id="$50" name="amount" value="50"
                                        class="hidden peer custom-control-input fixed-amount">
                                    <label for="$50"
                                        class="inline-flex justify-between items-center p-5 w-full text-gray-500 bg-white rounded-sm border-gray-200 cursor-pointer peer-checked:border-mow-shine-yellow border-2 border-solid peer-checked:text-mow-shine-yellow hover:text-gray-600 hover:bg-gray-100">
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold">$50</div>
                                        </div>
                                    </label>
                                </div>
                                <div class="col-span-1 w-full">
                                    <input type="radio" id="$100" name="amount" value="100"
                                        class="hidden peer custom-control-input fixed-amount">
                                    <label for="$100"
                                        class="inline-flex justify-between items-center p-5 w-full text-gray-500 bg-white rounded-sm border-gray-200 cursor-pointer peer-checked:border-mow-shine-yellow border-2 border-solid peer-checked:text-mow-shine-yellow hover:text-gray-600 hover:bg-gray-100">
                                        <div class="block">
                                            <div class="w-full text-lg font-semibold">$100</div>
                                        </div>
                                    </label>
                                </div>

                                <div class="col-span-2 w-full">
                                    <div class="mb-3 flex w-full">
                                        <input type="radio" id="custom" name="amount" value="other"
                                            class="hidden peer custom-control-input custom-amount">
                                        <label for="custom"
                                            class="inline-flex justify-between items-center p-5 w-full text-gray-500 bg-white rounded-sm cursor-pointer border-r-0 peer-checked:rounded-tr-none peer-checked:rounded-br-none peer-checked:border-mow-shine-yellow border-2 border-solid peer-checked:text-mow-shine-yellow hover:text-gray-600 hover:bg-gray-100">
                                            <div class="block">
                                                <div class="w-full text-lg font-semibold">Other</div>
                                            </div>
                                        </label>

                                        <div class="custom-amount" style="display: none;">
                                            <input type="number"
                                                class="custom-count  h-full text-2xl peer-checked:visible bg-slate-50 py-2 px-1 border-y-2 border-r-2 border-l-0 border-mow-shine-yellow rounded-tr-sm rounded-br-sm"
                                                id="other" value="0"/>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="card-element"
                                    class="justify-between items-center p-5 w-full text-gray-500 bg-white rounded-sm border border-gray-200">
                                    <div class="block">
                                        <div class="w-full text-lg font-semibold">Card details</div>
                                    </div>
                                    <div id="card-element">
                                        <!-- A Stripe Element will be inserted here. -->
                                    </div>

                                    <!-- Used to display form errors. -->
                                    <div id="card-errors" class="text-mow-red" role="alert"></div>
                            </div>
                            <label for="description"
                                class="justify-between items-center p-5 w-full text-gray-500 bg-white rounded-lg border border-gray-200">
                                <div class="block">
                                    <div class="w-full text-lg font-semibold">Description</div>
                                </div>
                                <div>
                                    <textarea name="description" class="text-dark w-full bg-slate-50 border-slate-500 border-solid border-2 rounded-sm"
                                        id="" cols="80" rows="6" required></textarea>
                                </div>
                            </label>
                        </div>

                        <button class="btn btn-outline-warning mt-4">Submit Payment</button>
            </form>
        </div>
        <script src="https://js.stripe.com/v3/"></script>
        <script>
            $('.custom-control-input').change(function() {
                $("div.custom-amount").toggle($(this).hasClass("custom-amount"))
                $(".custom-count").attr('value', '0');
            })

            $('.custom-count').change(function() {
                $('input.custom-amount:radio').val($(this).val())
            })

            var publishable_key = '{{ env('STRIPE_KEY') }}';
            // Create a Stripe client.
            var stripe = Stripe(publishable_key);

            // Create an instance of Elements.
            var elements = stripe.elements();

            // Custom styling can be passed to options when creating an Element.
            // (Note that this demo uses a wider set of styles than the guide below.)
            var style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '1.25rem',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

            // Create an instance of the card Element.
            var card = elements.create('card', {
                style: style
            });

            // Add an instance of the card Element into the `card-element` <div>.
            card.mount('#card-element');

            // Handle real-time validation errors from the card Element.
            card.addEventListener('change', function(event) {
                var displayError = document.getElementById('card-errors');
                if (event.error) {
                    displayError.textContent = event.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            // Handle form submission.
            var form = document.getElementById('payment-form');
            form.addEventListener('submit', function(event) {
                event.preventDefault();
                stripe.createToken(card).then(function(result) {
                    if (result.error) {
                        // Inform the user if there was an error.
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                    } else {
                        // Send the token to your server.
                        stripeTokenHandler(result.token);
                    }
                });
            });

            // Submit the form with the token ID.
            function stripeTokenHandler(token) {
                // Insert the token ID into the form so it gets submitted to the server
                var form = document.getElementById('payment-form');
                var hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                // Submit the form
                form.submit();
            }
        </script>
    </div>
@endsection
