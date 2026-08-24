<?php if(ismobile()) {?>

<section class="pet-detail-new">
    <div class="cust-container-md">
		<div class="detail-pet">
			<div class="image">
				<img src="{{ asset('assets/dashboard/assets/images/pet-image-card.svg') }}" alt="image" />
			</div>
                <div class="pet-detal">
                    <p>Something is not right with an important member of the family — your pet. But concerns don't always happen during your veterinarian's regular office hours.</p>
                </div>
                <div class="pet-detal col-100">
                    <p>TeleVet Wellness is here to help!</p>
                    <p>Pet parents can connect to one of our licensed vets 24/7, 365 days a year, from a computer or mobile device — no appointment needed.</p>
                    <p>They can help answer the critical question of whether or not what is happening with your pet constitutes an emergency that requires a trip to the animal hospital now, can be monitored and cared for at home, or can wait until an appointment with the family vet.</p>
                    <p>Concerns or questions about your pet? Call 866-936-3239 to consult with a vet for immediate advice on your next step and provide peace of mind.</p>
                    <p>Anytime, anywhere.</p>
                </div>
        </div>
    </div>
</section>

<?php } else { ?>

<div class="row">
	<div class="col-md-12 grid-margin">
		<div class="row">
			<div class="col-12 col-xl-6 mb-4 mb-xl-0">
				<div class="my-main-heading">
					<div class="pet-logo"><i class="fas fa-paw"></i></div>
						<div class="pet-heading">
							<h3 class="font-weight-bold">My Pets</h3>
							<h6 class="font-weight-normal mb-0">Welcome to the pet care station</h6>
                        </div>
                </div>
            </div>
        </div>
    </div>
	<div class="col-md-12 d-flex align-items-stretch">
		<div class="sickdog-sec">
			<div class="row">
				<div class="col-md-3">
					<div class="my-firstpet-sec"><img src="{{ asset('assets/images/sickDog.jpg') }}"></div>
				</div>
				<div class="col-md-9">
					<div class="my-firstpettext">

                              <p>Something is not right with an important member of the family — your pet. But concerns don't always happen during your veterinarian's regular office hours.</p>
                              <p>TeleVet Wellness is here to help!</p>
                              <p>Pet parents can connect to one of our licensed vets 24/7, 365 days a year, from a computer or mobile device — no appointment needed.</p>
							  <p>They can help answer the critical question of whether or not what is happening with your pet constitutes an emergency that requires a trip to the animal hospital now, can be monitored and cared for at home, or can wait until an appointment with the family vet.</p>
							  <p>Concerns or questions about your pet? Call 866-936-3239 to consult with a vet for immediate advice on your next step and provide peace of mind.</p>
                              <p>Anytime, anywhere.</p>
							  
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php } ?>