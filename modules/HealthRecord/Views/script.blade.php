<script>

$(document).ready(function() {
    $('.medication_allergies-selection').select2({
        width: '100%',
        minimumInputLength: 2,		
		language: {			
			inputTooShort: function () {			  
				return 'Please search medication';			
				}		
		},
        ajax: {
            url: `${SITE_URL}/search-medication-allergy`,
            dataType: 'json',
            type: "GET",
            quietMillis: 100,
            data: function (params) {
                return {
                keyword: params.term // search term
                };
            },
            processResults: function (response) {
                return {
                    results: $.map(response.data, function (item) {
                        return {
                            text: item.text,
                            damConceptId: `${item.damConceptId}`,
                            medicationAllergyForeignId: `${item.medicationAllergyForeignId}`,
                            damConceptIdType: `${item.damConceptIdType}`,
                            medicationAllergyName: `${item.medicationAllergyName}`,
                            id: item.id,

                        }
                    })
                };
            },
            tags: true,
        }
    }).on('select2:select', function (e) {
        var data = e.params.data;
        console.log( data );
        $('input[name="medicationAllergyForeignId"]').val(data.medicationAllergyForeignId);
        $('input[name="medicationAllergyDamConceptIdType"]').val(data.damConceptIdType);
        $('input[name="medicationAllergyDamConceptId"]').val(data.damConceptId);
        $('input[name="medicationAllergyName"]').val(data.medicationAllergyName);
    }).val(0).trigger('change');

    let medicalNameValue = $('input[name="medicationAllergyName"]').val();

    if( medicalNameValue != '' ){
        var newOption = new Option($('input[name="medicationAllergyName"]').val(), 12, false, false);
        $('.medication_allergies-selection').append(newOption).trigger('change');
    }


   

    $('.medication_search-selection').select2({
        width: '100%',
        minimumInputLength: 2,		 
		language: {			
			inputTooShort: function () {			  
				return 'Please search medication';			
				}		
		},		 
        ajax: {
            url: `${SITE_URL}/search-medication`,
            dataType: 'json',
            type: "GET",
            quietMillis: 100,
            data: function (params) {
                return {
                keyword: params.term // search term
                };
            },
            processResults: function (response) {
                console.log( response.data );
                return {
                    results: $.map(response.data, function (item) {
                        return {
                            text: item.text,
                            ndc: `${item.ndc}`,
                            foreign: `${item.data}`,
                            id: item.id,
                        }
                    })
                };
            },
            tags: true,
        }
    }).on('select2:select', function (e) {
        var data = e.params.data;
        $('input[name="medicationForeignId"]').val(data.foreign);
        $('input[name="medicationNDC"]').val(data.ndc);
        $('input[name="medicationName"]').val(data.text);
    }).val(0).trigger('change');

    let medicationNameValue = $('input[name="medicationName"]').val();

    if( medicationNameValue != '' ){
        var newOptionMedication = new Option($('input[name="medicationName"]').val(), 12, false, false);
        $('.medication_search-selection').append(newOptionMedication).trigger('change');
    }


});

</script>


