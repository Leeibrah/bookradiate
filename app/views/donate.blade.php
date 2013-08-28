@extends('layouts.bookcheetah')

{{-- Web site Title --}}
@section('title')
@parent
:: Register
@stop


@section('css')

 <link rel="stylesheet" href="{{ asset('assets/styles/css/donate.css')}} ">

@stop


@section('content')

<h2 class="gradient-title">Donate to keep BookCheetah free</h2>

<form method="post" action="payment" class="form-horizontal">

  <fieldset>
  	<legend><h3 class="gradient-light">Purchase Information</h3></legend>
  		<label for="amount">Amount (USD)</label>
		<input type="text" name="amount" id="amount">
	
	</fieldset>

	<fieldset>
  		<legend><h3 class="gradient-light">Charitable Options</h3></legend>
  		<label>
  			We share our proceeds with educational and environmental non-profits. 
  			To which of the following would you like us to send a share of the proceeds from this purchase:
  		</label>
  		<div class="radio">
  			<input type="radio" name="charity" value="Teach for America">
  			<a target="_blank" href="http://www.teachforamerica.com/">Teach For America</a>
  		</div>
  		<div class="radio">
  			<input type="radio" name="charity" value="Cheetah Conservation Fund">
  			<a target="_blank" href="http://www.cheetah.org/">Cheetah Conservation Fund</a>
  		</div>
  		<div class="radio">
  			<input type="radio" name="charity" value="school: Alabama A &amp; M University" checked="checked">
  			Student Government at Alabama A &amp; M University
  		</div>
    </fieldset>

    <fieldset>
  		<legend><h3 class="gradient-light">Billing Information</h3></legend>
  		<label>Card Type</label>
  		<div class="radio">
            <input type="radio" name="credit-card-type" value="Paypal">
            <img src="https://www.paypal.com/en_US/i/logo/PayPal_mark_37x23.gif" style="margin-right:7px;">
            <span style="font-size:11px; font-family: Arial, Verdana;">
            The safer, easier way to pay.
        	</span>
        </div>

        <div class="radio"><input type="radio" name="credit-card-type" value="Visa"> Visa </div>
        <div class="radio"><input type="radio" name="credit-card-type" value="MasterCard"> MasterCard </div>
        <div class="radio"><input type="radio" name="credit-card-type" value="Discover"> Discover </div>
        <div class="radio"><input type="radio" name="credit-card-type" value="Amex"> Amex </div>
        <hr>
        <div id="cc-details">
            <label for="credit-card">Credit Card Number</label>
        <input name="credit-card" class="large" type="text" value="">
            <label for="cvs">CVV</label>
        <input name="cvs" type="text" class="small" value="">
        <button class="tip ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only" type="button" role="button" aria-disabled="false"><span class="ui-button-text">What's this?</span></button>
            <label for="expiration">Expiration Date</label>
		        <select class="expiration-month">
				  <option value="1">1</option>
				  <option value="2">2</option>
				  <option value="3">3</option>
				  <option value="4">4</option>
				  <option value="5">5</option>
				  <option value="6">6</option>
				  <option value="7">7</option>
				  <option value="8" selected="selected">8</option>
				  <option value="9">9</option>
				  <option value="10">10</option>
				  <option value="11">11</option>
				  <option value="12">12</option>
				</select>

				<select class="expiration-year">
				  <option value="2013">2013</option>
				  <option value="2014" selected="selected">2014</option>
				  <option value="2015">2015</option>
				  <option value="2016">2016</option>
				  <option value="2017">2017</option>
				  <option value="2018">2018</option>
				  <option value="2019">2019</option>
				  <option value="2020">2020</option>
				  <option value="2021">2021</option>
				  <option value="2022">2022</option>
				  <option value="2023">2023</option>
				</select>
	    </div>
	    <div style="margin-top:3px;"></div>
	    <br /><hr>

	    <label for="first-name">First Name</label>
	    <input name="first-name" type="text" class="" value="">

	    <label for="first-name">Last Name</label>
	    <input name="last-name" type="text" class="" value="">

	    <label for="first-name">Street Address 1</label>
	    <input name="last-name" type="text" class="" value="">



	    <label for="first-name">Street Address 2</label>
	    <input name="last-name" type="text" class="" value="">

	    <label for="first-name">City</label>
	    <input name="last-name" type="text" class="" value="">

	    <label for="first-name">Country</label>
	    <input name="last-name" type="text" class="" value="">

	    <label for="first-name">State / Province / Region</label>
	    <input name="last-name" type="text" class="" value="">

	    <label for="first-name">Zip Code</label>
	    <input name="last-name" type="text" class="" value="">
     </fieldset>
     <button type="submit" class="btn btn-primary">Donate Now</button>
 </form>

 

@stop

