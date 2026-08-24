@push('scripts')
<?php /*
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.5.0"></script>
*/ ?>
<script>
    /*
const ctx = document.getElementById('chart').getContext('2d');
new Chart(ctx, {
                type: 'line',
                data: {
                    
                    labels: @json($labels),
                    datasets: [{
                            label: 'Better',
                            data: @json($better),
                            borderColor: '#008000',
                            backgroundColor: '#008000',
                            tension: 0.4,
                            pointRadius: 4,
                            fill: false
                        },
                        {
                            label: 'Same',
                            data: @json($same),
                            borderColor: '#9200d9',
                            backgroundColor: '#9200d9',
                            tension: 0.4,
                            pointRadius: 4,
                            fill: false
                        },
                        {
                            label: 'Worse',
                            data:  @json($worse),
                            borderColor: '#C49102',
                            backgroundColor: '#C49102',
                            tension: 0.4,
                            pointRadius: 4,
                            fill: false
                        }
                    ]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: value => value + '%'
                            },
                            grid: {
                                color: '#eee'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
});
*/ 
function fullReflection(id) {

    $('#FullReflection .modal-body').html("<p>Please wait....</p>");
    $.ajax({
        url: "/cbt/get-reflection",
        type: "POST",
        data: {
            id: id
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            $('#FullReflection .modal-body').html(response);
        },
        error: function (xhr) {
            console.log("Error:", xhr.responseText);
        }
    });
}
$(function() {
    $('#cbt_date_filter').datepicker({
        format: 'yyyy-mm-dd',
        autoclose: true,
        maxDate: 0    
    });
});
</script>
@endpush