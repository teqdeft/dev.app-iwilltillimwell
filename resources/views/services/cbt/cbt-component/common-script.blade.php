@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.4/moment.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
function renderChart(data, totalCount) {
    const chart = document.getElementById("chart");
    chart.innerHTML = "";
    const maxValue = totalCount > 0 ? totalCount : 1;
    const grid = document.createElement("div");
    grid.className = "grid";

    for (let i = 0; i <= maxValue; i++) {
        grid.appendChild(document.createElement("div"));
    }
    chart.appendChild(grid);
    
    data.forEach((item, index) => {
        const group = document.createElement("div");
        group.className = `bar-group bar-group-${index + 1}`;

        group.innerHTML = `
            <div class="label">${item.label}</div>
            <div class="bar-wrap">
                <div class="bar ${item.class}" style="width:${(item.value / maxValue * 100)}%">
                    <div class="value">${item.value}</div>
                </div>
                <div class="percent">${item.percent}%</div>
            </div>
        `;

        chart.appendChild(group);
    });


    const axis = document.createElement("div");
    axis.className = "axis";

    const steps = 5;

    for (let i = 0; i <= steps; i++) {
        const value = Math.round((i * maxValue) / steps);

        const tick = document.createElement("span");
        tick.innerText = value;
        tick.style.left = (i / steps * 100) + "%";

        axis.appendChild(tick);
    }

    chart.appendChild(axis);
}
function clearFilter() {

    $("#cbt_feel").val(null);
    $("#daterange").val(null);
    LoadCbtContent();

}
function LoadCbtContent(action_type){

    console.log(" Click Here ");


    if(action_type!="onload") {
        showLoaderPageLoad("show"); 
    }

    let cbt_feel = $("#cbt_feel").val();
    let cbt_date_filter = $("#daterange").val();

    $.ajax({
        url: "/cbt/cbt-content-load",
        type: "POST",
        data: {
            id: 0,
            cbt_feel:cbt_feel,
            cbt_date_filter:cbt_date_filter
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {

            console.log(response);
           
            $('.cbt-content-list').html(response.html);
            renderChart(response.chart_data, response.total);
            if(action_type!="onload") {
                showLoaderPageLoad("hide"); 
            }
        },
        error: function (xhr) {
             $('#cbt-content-list').html("Please Try again.");
        }
    });
}
LoadCbtContent('onload');



$(function() {

    let picker = $('#daterange').daterangepicker({
        autoUpdateInput: false,
        showDropdowns: true,

        maxDate: moment(),
        minDate: moment().subtract(5, 'years'),

        locale: {
            cancelLabel: 'Clear',
            format: 'YYYY-MM-DD'
        }
    });

    $('#daterange').on('apply.daterangepicker', function(ev, picker) {

        // 🔥 Convert to FULL MONTH RANGE
        let start = picker.startDate.clone().startOf('month');
        let end   = picker.endDate.clone().endOf('month');

        // restrict future
        if (end.isAfter(moment())) {
            end = moment();
        }

        $(this).val(
            start.format('YYYY-MM-DD') + ' to ' +
            end.format('YYYY-MM-DD')
        );

        // sync picker
        let drp = $(this).data('daterangepicker');
        drp.setStartDate(start);
        drp.setEndDate(end);

        LoadCbtContent();
    });

    $('#daterange').on('cancel.daterangepicker', function() {
        $(this).val('');
        LoadCbtContent();
    });

});

</script>
@endpush