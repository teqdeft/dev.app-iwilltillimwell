@php
    $showPayment = request()->boolean('paymentmethodselection');
@endphp

<div class="user-package-list {{ $showPayment ? 'd-none' : '' }}">
    @include('user.package')
</div>

<div class="user-holidy-list" style="display: none;">
    @include('user.holiday-package')    
</div>

<div class="user-invoice-section" style="display: none;">    
    @include('user.package.invoice')
</div>

<div class="user-payment-section {{ $showPayment ? '' : 'd-none' }}">
    @include('user.package.payment')
</div>


	

@push('scripts')


<?php 
$pack_list = getPackageIncludeList();

/* echo "<pre>";

print_r($pack_list);

echo "</pre>"; */

$medications = [

    ['name' => 'Medication A', 'price' => 100],

    ['name' => 'Medication B', 'price' => 200],

    ['name' => 'Medication C', 'price' => 150],

];

?>



	

	<div class="modal fade" id="change-plan-required-action-" tabindex="-1" aria-labelledby="yourModalLabel" aria-hidden="true">

		<div class="modal-dialog modal-dialog-centered modal-sm">

		<div class="modal-content">



		  <!-- Header -->

		  <div class="modal-header">

			<h5 class="modal-title font-weight-bold">

				Confirm Your Action

			</h5>

			<button type="button" class="close" data-dismiss="modal">

				<span>&times;</span>

			</button>

		  </div>



		  <!-- Body -->

		  <div class="modal-body">



			<p class="text-muted mb-3">

				Please select one of the following options:

			</p>



			<!-- Radio Options -->

			<div class="border rounded p-3 mb-3">



				<div class="custom-control custom-radio mb-2">

					<input type="radio" id="change_yes"

						   name="change_package"

						   class="custom-control-input"

						   value="yes">

					<label class="custom-control-label font-weight-500" for="change_yes">

						Change Base Package

					</label>

				</div>



				<div class="custom-control custom-radio">

					<input type="radio" id="change_no"

						   name="change_package"

						   class="custom-control-input"

						   value="no">

					<label class="custom-control-label font-weight-500" for="change_no">

						Keep Base Package & Select Optional Services

					</label>

				</div>



			</div>



			<!-- Optional Services -->

			<div id="optionalServices" style="display:none;">



				<h6 class="mb-3 font-weight-bold">Optional Services</h6>



				<ul class="list-group mb-3">



					@foreach($medications as $key => $med)

					<li class="list-group-item d-flex justify-content-between align-items-center">



						<div class="custom-control custom-checkbox">

							<input type="checkbox"

								   class="custom-control-input"

								   id="med_{{ $key }}"

								   name="medications[]"

								   value="{{ $med['name'] }}"

								   data-price="{{ $med['price'] }}">

								   

							<label class="custom-control-label" for="med_{{ $key }}">

								{{ $med['name'] }}

							</label>

						</div>



						<span class="badge badge-primary badge-pill">

							${{ $med['price'] }}

						</span>



					</li>

					@endforeach



				</ul>



				<!-- Total -->

				<div class="text-right font-weight-bold">

					Total: $<span id="totalAmount">0</span>

				</div>



			</div>



		  </div>



		</div>

	  </div>

	</div>







<script>

$(function () {



    const modal = $('#change-plan-required-action');

    const optionalSection = $('#optionalServices');

    const totalDisplay = $('#totalAmount');



    modal.modal({backdrop: 'static',keyboard: false}).modal("show");

    $(document).on('change', 'input[name="change_package"]', function () {



        if (this.value === 'yes') {

            optionalSection.slideUp();

			modal.modal("hide");

        }



        if (this.value === 'no') {

            optionalSection.slideDown();

        }



    });



    // Calculate Total

    $(document).on('change', 'input[name="medications[]"]', function () {



        let total = 0;



        $('input[name="medications[]"]:checked').each(function () {

            total += parseFloat($(this).data('price'));

        });



        totalDisplay.text(total);



    });



});

</script>

<style>

.custom-control-label {cursor: pointer;}

</style>

@endpush