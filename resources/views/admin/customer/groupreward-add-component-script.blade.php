<script>
function loadRewards() {
	
	let organization_id = $("#organization_id").val() || '0';
	
	
	$('#rewardTableBody').html('<tr><td colspan="6" class="text-center text-muted">Please Wait...</td></tr>');
    $.ajax({
        url: "{{ url('admin/grouporganization-reward-store-list') }}",
        type: "post",
		headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		},
		data: {
			organization_id: organization_id
		},
        success: function (response) {
            if (response.status) {

                let html = '';

            if(response.status && response.data.length > 0) {
                let i = 1;
                $.each(response.data, function(index, row) {
                    html += `
                        <tr id="rewardRow${row.id}">
                            <td>${i++}</td>
                            <td>${row.min}</td>
                            <td>${row.max}</td>
                            <td>${row.year} Year</td>
                            <td>${row.commission}%</td>
                            <td class="text-center">
                               
                                <button class="btn btn-sm btn-danger" onclick="deleteReward(${row.id})">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </td>
                        </tr>
                    `;
                });
            } else {
                html = `
                    <tr>
                        <td colspan="6" class="text-center text-muted">
                            No records found
                        </td>
                    </tr>
                `;
            }

            $('#rewardTableBody').html(html);

               
            }
        }
    });
}
function deleteReward(id) {
    if(!confirm('Are you sure you want to delete this reward?')) return;

    $.ajax({
        url: "{{ url('admin/group-organization-reward-delete') }}/" + id,
        type: "DELETE",
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if(response.status) {
                alert(response.message);
				loadRewards();
            
            } else {
                alert(response.message);
            }
        },
        error: function(xhr) {
            alert('Something went wrong!');
        }
    });
}
function saveReward() {
	
	let organization_id = $("#organization_id").val() || '0';
	let form = document.getElementById('groupRewardForm');
    let url  = "{{ url('admin/group-organization-reward-store') }}";
	let data = new FormData(form);
	data.append('organization_id', organization_id);

     $.ajax({
        url: url,
        type: "POST",
        data: data,
        processData: false,
        contentType: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
            $('#groupRewardForm button')
                .prop('disabled', true)
                .html('<i class="fas fa-spinner fa-spin"></i> Saving...');
        },
        success: function (response) {
            if (response.status) {
                alert(response.message);
				loadRewards();
                form.reset();
            }
        },
        error: function (xhr) {
            let msg = '';
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                $.each(xhr.responseJSON.errors, function (key, value) {
                    msg += value[0] + "\n";
                });
            } else {
                msg = 'Something went wrong!';
            }
            alert(msg);
        },
        complete: function () {
            $('#groupRewardForm button')
                .prop('disabled', false)
                .html('<i class="fas fa-save"></i> Save Reward');
        }
    });
}






setTimeout(function() {
    loadRewards();
},500);

</script>