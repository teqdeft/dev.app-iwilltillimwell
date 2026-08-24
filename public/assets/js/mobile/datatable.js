const createActionsColumn = (resource, data, includeViewOption = true, includeDeleteOption = true, includeVoidOption = false, includeEditOption = false, includeBanOption = true, includeViewOptionPromo = false, includePayOption = false, includeTransactionHistoryOption = false, changeEditUrl = '', changeShowUrl = '',addSiteAccess = false) => {
    actionTd = '<ul>';
    if (includeViewOption) {

        actionTd += '<li><a href="' + SITE_URL + '/' + resource + `${changeShowUrl}` + '/' + data.id + '" data-toggle="tooltip" title="View">' + '<label class="badge badge-danger-cus"><i class="fas fa-eye"></i></label>' + '</a></li>';
    }
    if (includeEditOption) {
        actionTd += '<li><a href="' + SITE_URL + '/' + resource + `${changeEditUrl}` + '/' + data.id + '" data-toggle="tooltip" title="Edit">' + '<label class="badge badge-danger-cus"><i class="fas fa-edit"></i></label>' + '</a></li>';
    }
    if (includeBanOption) {
        if (data.status == "Inactive") {
            var icon = '<i class="fas fa-user-check"></i>';
            var tooltipText = "Unblock";
            var statusVal = 1;
            var confirm_box_class = "unblock_resource";
        } else {
            var icon = '<i class="fas fa-user-times"></i>';
            var tooltipText = "Block";
            var statusVal = 0;
            var confirm_box_class = "block_resource";
        }
        let confTitle = resource.replace('-', ' ');
        confTitle = confTitle.replace('admin/', '');

        let lastChar = confTitle.charAt(confTitle.length - 1);

        if (lastChar == 's') {
            confTitle = confTitle.slice(0, -1)
        }
        actionTd += '<li><a class="' + confirm_box_class + '" data-resource="block-' + resource + '-form-' + data.id + '" href="' + SITE_URL + '/' + resource + '/block/' + data.id + '" data-confirm-title="' + confTitle + '" data-toggle="tooltip" title=' + tooltipText + '><label class="badge badge-danger-cus">' + icon + '</label></a><form method="POST" action="' + SITE_URL + '/' + resource + '/block/' + data.id + '/' + statusVal + '" accept-charset="UTF-8" id="block-' + resource + '-form-' + data.id + '" style="display: none"><input name="_token" type="hidden" value="' + $('meta[name="csrf-token"]').attr('content') + '"></form></li>';
    }
    if (includeDeleteOption) {
        actionTd += '<li><a class="delete_resource" data-resource="destroy-' + resource + '-form-' + data.id + '" href="' + SITE_URL + '/' + resource + '/' + data.id + '" data-toggle="tooltip" title="Delete">' + '<label class="badge badge-danger-cus"><i class="fas fa-trash"></i></label>' + '</a><form method="POST" action="' + SITE_URL + '/' + resource + '/delete/' + data.id + '" accept-charset="UTF-8" id="destroy-' + resource + '-form-' + data.id + '" style="display: none"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="' + $('meta[name="csrf-token"]').attr('content') + '"></form></li>';
    }
    if (includeVoidOption) {
        actionTd += '<li><a class="void_resource" data-resource="void-' + resource + '-form-' + data.id + '" href="' + SITE_URL + '/' + resource + '/' + data.id + '/void">' + 'void' + '</a><form method="POST" action="' + SITE_URL + '/' + resource + '/' + data.id + '/void" accept-charset="UTF-8" id="void-' + resource + '-form-' + data.id + '" style="display: none"><input name="_token" type="hidden" value="' + $('meta[name="csrf-token"]').attr('content') + '"></form></li>';
    }
    if (includeViewOptionPromo) {
        actionTd += '<li><a href="' + SITE_URL + '/' + resource + '/' + data.id + '" data-toggle="tooltip" title="View">' + '<label class="badge badge-danger-cus"><i class="fas fa-eye"></i></label>' + '</a></li>';
    }
    if (includePayOption && data.influencer_payable_amount != "N/A") {
        var icon = '<i class="fab fa-amazon-pay"></i>';
        var tooltipText = "Payment";
        var statusVal = 1;
        var confirm_box_class = "influencer_pay";
        actionTd += '<li><a class="' + confirm_box_class + '" data-amount="' + data.influencer_payable_amount + '" data-resource="block-' + resource + '-form-' + data.id + '" href="' + SITE_URL + '/' + resource + '/' + data.id + '" data-toggle="tooltip" title=' + tooltipText + '><label class="badge badge-danger-cus">' + icon + '</label></a><form method="POST" action="' + SITE_URL + '/' + resource + '/payment/' + data.id + '/' + statusVal + '" accept-charset="UTF-8" id="block-' + resource + '-form-' + data.id + '" style="display: none"><input name="_token" type="hidden" value="' + $('meta[name="csrf-token"]').attr('content') + '"></form></li>';
    }
    if (includeTransactionHistoryOption) {
        actionTd += '<li><a href="' + SITE_URL + '/' + resource + '/' + data.id + '" data-toggle="tooltip" title="Transaction History">' + '<label class="badge badge-danger-cus"><i class="fas fa-history"></i></label>' + '</a></li>';
    }

    if( addSiteAccess ){
        actionTd += `<li><a href="javascript:;" uid="${data.id}" class="accessPermissionUsers" data-toggle="tooltip" title="Access Permission"><label class="badge badge-danger-cus"><i class='fa fa-universal-access'></i></label></a></li>`;
    }

    actionTd += '</ul>';
    return actionTd;
}

function getUsersPermission($moduleName) {
    var userType = localStorage.getItem('user-type');
    if (userType == 'admin' ) {
        return true;
    } else {
        if (localStorage.getItem('users-permissions') != ''  ) {
            var permission = JSON.parse(localStorage.getItem('users-permissions'));
            if (permission != '' && permission.includes($moduleName)) {
                return true
            }
        }
    }
}

/*console.log( getUsersPermission() );*/
/* , */


var relations = ['Not Selected Relationship', 'Spouse', 'Child','Other']
function format(d) {
    
    console.log(d, 'All Data');
    // `d` is the original data object for the row
    if(d.dependents.length > 0){
         
        var myTable = '<table style="padding-left: 0 !important;  padding-top: 0 !important;  padding-bottom: 0px !important; width: 46%;"> <th>Dependent Name</th><th>Email</th><th>Phone</th><th>Relation</th>';
        for(let i = 0; i < d.dependents.length; i++){
        myTable+='<tr>';
        myTable+='<td>'+d.dependents[i]['name']+'</td>';
        myTable+='<td>'+d.dependents[i]['email']+'</td>';
        myTable+='<td>'+d.dependents[i]['primaryPhone']+'</td>';
        myTable+='<td>'+relations[d.dependents[i]['relationship']]+'</td>';
        myTable+='</tr>';
        }
        myTable+='</table>';
        return myTable;
        
    }else{
         return (
        '<dl>' +
        'No Dependents'+
        '</dl>'
    );
        
    }
   
}

function getDateRange() {
    var currentDate = new Date();

    // Get the current date
    var endMonth = currentDate.getMonth() + 1; // Months are zero-based
    var endDay = currentDate.getDate();
    var endYear = currentDate.getFullYear();

    // Calculate the start date by subtracting seven days
    var startDate = new Date(currentDate);
    startDate.setDate(startDate.getDate() - 7);

    // Get the components of the start date
    var startMonth = startDate.getMonth() + 1; // Months are zero-based
    var startDay = startDate.getDate();
    var startYear = startDate.getFullYear();

    // Pad single-digit months and days with a leading zero
    startMonth = (startMonth < 10) ? '0' + startMonth : startMonth;
    startDay = (startDay < 10) ? '0' + startDay : startDay;
    endMonth = (endMonth < 10) ? '0' + endMonth : endMonth;
    endDay = (endDay < 10) ? '0' + endDay : endDay;

    // Assemble the formatted date range string
    var startDateFormatted = startMonth + '/' + startDay + '/' + startYear;
    var endDateFormatted = endMonth + '/' + endDay + '/' + endYear;

    return {
        startDate: startDateFormatted,
        endDate: endDateFormatted
    };
}

$(document).ready(function() {
    $('.input-daterange input').each(function() {
        $(this).datepicker('clearDates');
    });
    var usertype = $('#users-table').attr('usertype');
    var otherData = [{
        "orderable": false,
        "data": null,
        "defaultContent": "",
        "sClass": "to-show",
        "dom": 'lrtip',
        "mRender": function(data, type, row) {
            
            var permissionEdit = {
                'edit': false,
                'delete': false
            };
            if (getUsersPermission('users_edit')) {
                permissionEdit.edit = true;
            }
            if (getUsersPermission('users_delete')) {
                permissionEdit.delete = true;
            }
            return createActionsColumn('admin/users', data, true, 1, 0, permissionEdit.edit, permissionEdit.delete, 0, 0, 0, '/edit', '/show',1);
        },
         
    }];

    if (usertype == 'subscriber') {
        var allColumn = [
             {
            "className": 'dt-control',
            "orderable": false,
            "data": null,
            "defaultContent": ''
        },
        {
            "data": "sr_no"
        }, {
            "data": "name"
        }, {
            "data": "email"
        }, {
            "data": "primaryPhone"
        }, {
            "data": "promocode"
        }, {
            "data": "promotype"
        }, {
            "data": "created_at"
        }, {
            "data": "status",
            "createdCell": function (td, cellData, rowData, row, col) {
                if (cellData == 'Active') {
                    $(td).html("<span class='badge badge-success'>"+cellData+"</span>");
                }else{
                    $(td).html("<span class='badge badge-danger'>"+cellData+"</span>");
                }
            }
        }];
        Array.prototype.push.apply(allColumn, otherData);
    } else {
        var allColumn = [
        {
            "data": "sr_no"
        }, {
            "data": "name"
        }, {
            "data": "email"
        }, {
            "data": "primaryPhone"
        }, {
            "data": "created_at"
        }, {
            "data": "status",
             "createdCell": function (td, cellData, rowData, row, col) {
                if (cellData == 'Active') {
                    $(td).html("<span class='badge badge-success'>"+cellData+"</span>");
                }else{
                    $(td).html("<span class='badge badge-danger'>"+cellData+"</span>");
                }
            }
        }, ];
        Array.prototype.push.apply(allColumn, otherData);
        $("#all").show();
    }

    var firstDraw = true;
    var userDataTable = $('#users-table').on( 'draw.dt', function () {
            if (firstDraw) {
                $('#show-loader').show();
                firstDraw = false;
            }
        })
        .on( 'init.dt', function () {
            $('#show-loader').hide();
        }).DataTable({
        "ajax": {
            "url": SITE_URL + "/admin/users/" + usertype,
            "contentType": "application/json",
            "type": "GET",
            "data": {
                usertype: usertype
            },
        },
        "columns": allColumn,
        success: function(response) {
            $('#something').html("data is found");
            $('#show-loader').hide();
        }
    });
    
    
    userDataTable.on('click', 'td.dt-control', function (e) {
        $(this).toggleClass('minus');
         $($(this).next('tr')).addClass('sd');
    let tr = e.target.closest('tr');
    let row = userDataTable.row(tr);
    // let td = row.closest('td');
    // td.addClass('bijay');
    // console.log(row.child().addClass('321'), 'row');
      
 
    if (row.child.isShown()) {
        // This row is already open - close it
        row.child.hide();
    }
    else {
        // Open this row
        row.child(format(row.data())).show();
    }
});

     var studentDataTable = $("#student-table").DataTable({
         ajax: {
             url: SITE_URL + "/affiliate/student/",
             contentType: "application/json",
             type: "GET"
         },
         columns: [
             {
                 data: "sr_no"
             },
             {
                 data: "name"
             },
             {
                 data: "email"
             },
             {
                 data: "primaryPhone"
             },
             {
                 data: "status"
             },
             {
                 orderable: false,
                 searchable: false,
                 data: null,
                 defaultContent: "",
                 sClass: "to-show",
                 mRender: function(data, type, row) {

                     return createActionsColumn('affiliate/student', data, true, false, false, true, 0, 0, 0, 0, '/edit', '/show');
                 }
             }
         ],
         success: function(response) {
             $("#something").html("data is found");
         }
     });

    $('#organization-filter').on('change', function() {
        $('#removeSelectedOrg').show();
        userDataTable.columns(6).search(this.value).draw();
        $('#show-loader').hide();
    });
    
    if (usertype == 'subscriber') {
    // Start of date range filters for data table
        var dateRange = getDateRange();
        
        $('#max-date-range').datepicker({
            dateFormat: 'm-d-Y',
            minDate: dateRange.startDate,
        });
        $('#min-date-range, #max-date-range').on('change', function() {
            var startDate = Date.parse($('#min-date-range').val());
            var endDate = Date.parse($('#max-date-range').val());
            filterByDate(startDate, endDate)
        });
        
        $('#min-date-range').val(dateRange.startDate);
        $('#max-date-range').val(dateRange.endDate);
        setTimeout(function() {
            $("#max-date-range").trigger('change');
        }, 800);

        function filterByDate(startDate, endDate) {
            // Get the data from the 7th column
            var columnData = userDataTable.column(7).data();
        
            // Filter the data based on the date range
            var filteredData = columnData.filter(function (value) {
                var columnDate = Date.parse(value);
                if (!isNaN(columnDate)) {
                    return columnDate >= startDate && columnDate <= endDate;
                } else {
                    return false;
                }
            });

            if(filteredData.length > 0) {
                userDataTable.column(7).search(filteredData.join('|'), true, false).draw();
            } else {
                userDataTable.column(7).search('#@://d+5', false, true).draw();
            }
            
            $('#show-loader').hide();
            $('#all').show();
            $('#removeSelectedOrg').show();
        }

    // End of date range filters for data table
    }
    $('#removeSelectedOrg').on('click', function() {
        $('#organization-filter').val('');
        $('#min-date-range').val('');
        $('#max-date-range').val('');
        $('#removeSelectedOrg').hide();
        userDataTable.columns('').search('').draw();
        $('#show-loader').hide();
    });

    $('#promo-table').dataTable({
        "ajax": {
            "url": SITE_URL + "/admin/promo-codes",
            "contentType": "application/json",
            "type": "GET"
        },
    
        "columns": [{
                "data": "sr_no"
            }, {
                "data": "code"
            }, {
                "data": "members_discount_amount"
            }, {
                "data": "allowed_members"
            }, {
                "data": "inc_name"
            }, {
                "data": "influencer_discount_amount"
            }, {
                "data": "influencer_payable_amount"
            }, {
                "orderable": false,
                "searchable": false,
                "data": null,
                "defaultContent": "",
                "sClass": "to-show",
                
                "mRender": function(data, type, row) {
    
                    var status = data.status == 0 ? true : false;
                    var permissionEdit = {
                        'edit': false,
                        'delete': false
                    };
                    if (getUsersPermission('promo_codes_edit')) {
                        permissionEdit.edit = true;
                    }
                    if (getUsersPermission('promo_codes_edit')) {
                        permissionEdit.delete = true;
                    }
                    return createActionsColumn('admin/promo-codes', data, true, permissionEdit.delete, false, permissionEdit.edit, false, false, status, false, '/edit');
                }
            }

        ],
        success: function(response) {
            $('#something').html("data is found");
        }

    });




    $('#influencers-table').dataTable({
        "ajax": {
            "url": SITE_URL + "/admin/influencers",
            "contentType": "application/json",
            "type": "GET"
        },
        "columns": [{
            "data": "sr_no"
        }, {
            "data": "name"
        }, {
            "data": "email"
        }, {
            "data": "primaryPhone"
        }, {
            "data": "organization"
        }, {
            "orderable": false,
            "searchable": false,
            "data": null,
            "defaultContent": "",
            "sClass": "to-show",
            "mRender": function(data, type, row) {
                var permissionEdit = {
                    'edit': false,
                    'delete': false
                };
                if (getUsersPermission('affiliates_counselors_edit')) {
                    permissionEdit.edit = true;
                }
                if (getUsersPermission('affiliates_counselors_delete')) {
                    permissionEdit.delete = true;
                }
                return createActionsColumn('admin/influencers', data, false, permissionEdit.delete, false, false, false, false, true, true);
            }
        }],
        success: function(response) {
            $('#something').html("data is found");
        }
    });

    $('#counsellor-table').dataTable({
        "ajax": {
            "url": SITE_URL + "/admin/influencers/counsellor",
            "contentType": "application/json",
            "type": "GET"
        },
        "columns": [{
            "data": "sr_no"
        }, {
            "data": "name"
        }, {
            "data": "email"
        }, {
            "data": "primaryPhone"
        }, {
            "data": "organization"
        }, {
            "orderable": false,
            "searchable": false,
            "data": null,
            "defaultContent": "",
            "sClass": "to-show",
            "mRender": function(data, type, row) {
                var permissionEdit = {
                    'edit': false,
                    'delete': false
                };
                if (getUsersPermission('affiliates_counselors_edit')) {
                    permissionEdit.edit = true;
                }
                if (getUsersPermission('affiliates_counselors_delete')) {
                    permissionEdit.delete = true;
                }
                return createActionsColumn('admin/influencers/counsellor', data, false, permissionEdit.delete, false, false, false, false, true, false);
            }
        }],
        success: function(response) {
            $('#something').html("data is found");
        }
    });


    $('#group-counseling-table').dataTable({
        "ajax": {
            "url": SITE_URL + "/admin/get-all-counseling",
            "contentType": "application/json",
            "type": "GET"
        },
        "columns": [{
            "data": "title"
        }, {
            "data": "description"
        }, {
            "data": "counseler_name"
        }, {
            "data": "last_registration_date"
        }, {
            "data": "maximum_number_of_users"
        }, {
            "data": "minimum_number_of_users"
        }, {
            "data": "registration_fee"
        }, {
            "orderable": false,
            "searchable": false,
            "data": null,
            "defaultContent": "",
            "sClass": "to-show",
            "mRender": function(data, type, row) {
                var permissionEdit = {
                    'edit': false,
                    'delete': false
                };
                if (getUsersPermission('group_counseling_edit')) {
                    permissionEdit.edit = true;
                }
                if (getUsersPermission('group_counseling_delete')) {
                    permissionEdit.delete = true;
                }
                return createActionsColumn('admin/group-counseling/edit-form', data, false, false, false, true, false, false, status);
            }
        }],
        success: function(response) {
            $('#something').html("data is found");
        }
    });

    $('#pets-table').dataTable({
        "ajax": {
            "url": SITE_URL + "/pets",
            "contentType": "application/json",
            "type": "GET"
        },
        "columns": [
            { "data": "sr_no" },
            { "data": "name" },
            { "data": "species" },
            { "data": "breed" },
            {
                "orderable": false,
                "searchable": false,
                "data": null,
                "defaultContent": "",
                "sClass": "to-show",
                "mRender": function(data, type, row) {
                    return createActionsColumn('pets', data, true,false,false,true,false,false,false,false,'/edit','/show');
                }
            }

        ],
        success: function(response) {
            $('#something').html("data is found");
        }

    });

    $('#plans-table').dataTable({
        "ajax": {
            "url": SITE_URL + "/admin/plans",
            "contentType": "application/json",
            "type": "GET"
        },
        "columns": [{
                "data": "sr_no"
            }, {
                "data": "name"
            }, {
                "data": "type"
            }, {
                "data": "amount"
            }, {
                "data": "interval"
            }, {
                "orderable": false,
                "searchable": false,
                "data": null,
                "defaultContent": "",
                "sClass": "to-show",
                "mRender": function(data, type, row) {
                    var permissionEdit = {
                        'edit': false,
                        'delete': false
                    };
                    if (getUsersPermission('plans_edit')) {
                        permissionEdit.edit = true;
                    }
                    if (getUsersPermission('plans_delete')) {
                        permissionEdit.delete = true;
                    }
                    return createActionsColumn('admin/plans', data, false, permissionEdit.delete, false, permissionEdit.edit, false);
                }
            }

        ],
        success: function(response) {
            $('#something').html("data is found");
        }

    });

    //transaction table


    $('#affiliate-transactions').dataTable({
        "ajax": {
            "url": SITE_URL + "/affiliate/transaction",
            //"url": `${SITE_URL}/admin/influencers/${transId}`,
            "contentType": "application/json",
            "type": "GET",
            //"data":{user_id:transId}
        },
        "columns": [{
            "data": "sr_no"
        }, {
            "data": "code"
        }, {
            "data": "name"
        }, {
            "data": "members_discount_amount"
        }, {
            "data": "status"
        }, ],
        success: function(response) {
            $('#something').html("data is found");
        }

    });

    //admin affilate transaction
    var transId = $('#admin-affiliate-transactions').attr('transId');
    $('#admin-affiliate-transactions').dataTable({
        "ajax": {
            //"url": SITE_URL+"/affiliate/transaction",
            "url": `${SITE_URL}/admin/influencers/${transId}`,
            "contentType": "application/json",
            "type": "GET",
            "data": {
                user_id: transId
            }
        },
        "columns": [{
            "data": "sr_no"
        }, {
            "data": "code"
        }, {
            "data": "name"
        }, {
            "data": "members_discount_amount"
        }, {
            "data": "status"
        }, ],
        success: function(response) {
            $('#something').html("data is found");
        }

    });

    //admin transaction table
    $('#admin-transaction-table').dataTable({
        "ajax": {
            "url": SITE_URL + "/admin/influencers",
            "contentType": "application/json",
            "type": "GET"
        },
        "columns": [{
            "data": "sr_no"
        }, {
            "data": "code"
        }, {
            "data": "name"
        }, {
            "data": "members_discount_amount"
        }, {
            "data": "status"
        }, ],
        success: function(response) {
            $('#something').html("data is found");
        }

    });

    /* blog datatable */
    const blogTable = $('#blog-table').DataTable({
        "ajax": {
            "url": SITE_URL + "/admin/blog",
            "contentType": "application/json",
            "type": "GET"
        },
        "columnDefs": [{
            "width": "20%",
            "targets": 2
        }],
        "columns": [{
            "data": "sr_no"
        }, {
            "data": "category"
        }, {
            "data": "title"
        }, {
            "data": "image"
        }, {
            "data": null,
            "defaultContent": "",
            "sClass": "to-show",
            "mRender": function(data, type, row) {
                var permissionEdit = {
                    'edit': false,
                    'delete': false
                };
                if (getUsersPermission('blogs_edit')) {
                    permissionEdit.edit = true;
                }
                if (getUsersPermission('blogs_delete')) {
                    permissionEdit.delete = true;
                }
                return createActionsColumn('admin/blog', data, false, permissionEdit.delete, false, permissionEdit.edit, false);
            }
        }],
        success: function(response) {
            $('#something').html("data is found");
        }
    });

    $('#cat-filter').on('change', function() {
        $('#removeSelectedCat').show();
        blogTable.columns(1).search(this.value).draw();
    });

    $('#removeSelectedCat').on('click', function() {
        $('#removeSelectedCat').hide();
        $('#cat-filter').val('');
        blogTable.columns('').search('').draw();
    });



    $('#cousellor-sessions-table').dataTable({
        "ajax": {
            "url": SITE_URL + "/counsellor/sessions",
            "contentType": "application/json",
            "type": "GET"
        },
        "columns": [{
            "data": "sr_no"
        }, {
            "data": "title"
        }, {
            "data": "description"
        }, {
            "data": "last_registration_date"
        }, {
            "data": "maximum_number_of_users"
        }, {
            "data": "minimum_number_of_users"
        }, {
            "data": "registration_fee"
        }, {
            "data": "status"
        }, {
            "orderable": false,
            "searchable": false,
            "data": null,
            "defaultContent": "",
            "sClass": "to-show",
            "mRender": function(data, type, row) {
                return createActionsColumn('counsellor/sessions', data, true, false, false, false, false, false, status);
            }
        }],
        success: function(response) {
            $('#something').html("data is found");
        }
    });

    $('#role-table').dataTable({
        "ajax": {
            "url": SITE_URL + "/admin/roles",
            "contentType": "application/json",
            "type": "GET"
        },
        "columns": [{
            "data": "sr_no"
        }, {
            "data": "name"
        }, {
            "data": "status"
        }, {
            "orderable": false,
            "searchable": false,
            "data": null,
            "defaultContent": "",
            "sClass": "to-show",
            "mRender": function(data, type, row) {
                var permissionEdit = {
                    'edit': false,
                    'delete': false
                };
                if (getUsersPermission('roles_edit')) {
                    permissionEdit.edit = true;
                }
                if (getUsersPermission('roles_delete')) {
                    permissionEdit.delete = true;
                }
                return createActionsColumn('admin/roles', data, false, false, false, permissionEdit.edit, permissionEdit.delete, false, status);
            }
        }],
        success: function(response) {
            $('#something').html("data is found");
        }
    });

    $('#permission-table').dataTable({
        "ajax": {
            "url": SITE_URL + "/admin/permission",
            "contentType": "application/json",
            "type": "GET"
        },
        "columns": [{
            "data": "sr_no"
        }, {
            "data": "role"
        }, {
            "data": "permissions"
        }, {
            "orderable": false,
            "searchable": false,
            "data": null,
            "defaultContent": "",
            "sClass": "to-show",
            "mRender": function(data, type, row) {
                var permissionEdit = {
                    'edit': false,
                    'delete': false
                };
                if (getUsersPermission('permission_edit')) {
                    permissionEdit.edit = true;
                }
                if (getUsersPermission('permission_delete')) {
                    permissionEdit.delete = true;
                }
                return createActionsColumn('admin/permission', data, false, permissionEdit.delete, false, permissionEdit.edit, false, false, status);
            }
        }],
        success: function(response) {
            $('#something').html("data is found");
        }
    });

    $('#categories-table').dataTable({
        "ajax": {
            "url": SITE_URL + "/admin/categories",
            "contentType": "application/json",
            "type": "GET"
        },
        "columns": [{
            "data": "sr_no"
        }, {
            "data": "name"
        }, {
            "orderable": false,
            "searchable": false,
            "data": null,
            "defaultContent": "",
            "sClass": "to-show",
            "mRender": function(data, type, row) {
                return createActionsColumn('admin/categories', data, false, true, false, true, false);
            }
        }],
        success: function(response) {
            $('#something').html("data is found");
        }
    });

    $('#affirmation-table').dataTable({
        "ajax": {
            "url": SITE_URL + "/admin/affirmation",
            "contentType": "application/json",
            "type": "GET"
        },
        "columns": [{
            "data": "sr_no"
            }, {
            "data": "message",
        },{
            "data": "type",
        }, {
            "orderable": false,
            "searchable": false,
            "data": null,
            "defaultContent": "",
            "sClass": "to-show",
            "mRender": function(data, type, row) {
                /* if (getUsersPermission('affirmation_edit')) {
                        permissionEdit.edit = true;
                }
                if (getUsersPermission('affirmation_delete')) {
                    permissionEdit.delete = true;
                } */
                return createActionsColumn('admin/affirmation', data, false, 1, 0, 1, 0, 0, 0, 0, '/edit');
            }

        }],
        success: function(response) {
            $('#something').html("data is found");
        }
    });

    $('#affirmation-type-table').dataTable({
        "ajax": {
            "url": SITE_URL + "/admin/affirmation/type",
            "contentType": "application/json",
            "type": "GET"
        },
        "columns": [{
            "data": "sr_no"
            }, {
            "data": "name",
        }, {
            "orderable": false,
            "searchable": false,
            "data": null,
            "defaultContent": "",
            "sClass": "to-show",
            "mRender": function(data, type, row) {
                /* if (getUsersPermission('affirmation_edit')) {
                        permissionEdit.edit = true;
                }
                if (getUsersPermission('affirmation_delete')) {
                    permissionEdit.delete = true;
                } */
                return createActionsColumn('admin/affirmation', data, false, 1, 0, 1, 0, 0, 0, 0, '/type-edit');
            }

        }],
        success: function(response) {
            $('#something').html("data is found");
        }
    });



    $('#planType-table').dataTable({
        "ajax": {
            "url": SITE_URL + "/admin/plan-type",
            "contentType": "application/json",
            "type": "GET"
        },
        "columns": [{
            "data": "sr_no"
        }, {
            "data": "name"
        }, {
            "data": "status"
        }, {
            "orderable": false,
            "searchable": false,
            "data": null,
            "defaultContent": "",
            "sClass": "to-show",
            "mRender": function(data, type, row) {
                var permissionEdit = {
                    'edit': false,
                    'delete': false
                };
                if (getUsersPermission('plan_type_edit')) {
                    permissionEdit.edit = true;
                }
                if (getUsersPermission('plan_type_delete')) {
                    permissionEdit.delete = true;
                }
                return createActionsColumn('admin/plan-type', data, false, 0, 0, permissionEdit.edit, permissionEdit.delete, 0, 0, 0, '/edit');
            }
        }],
        success: function(response) {
            $('#something').html("data is found");
        }
    });


    $("#services-table").dataTable({
        ajax: {
            url: SITE_URL + "/admin/corporate",
            contentType: "application/json",
            type: "GET",
        },
        columns: [
            {
                data: "sr_no",
            },
            {
                data: "name",
            },
            {
                data: "link",
            },
            {
                data: "status",
            },
            {
                data: "logo",
            },
            {
                data: "services",
            },
            {
                orderable: false,
                searchable: false,
                data: null,
                defaultContent: "",
                sClass: "to-show",
                mRender: function (data, type, row) {
                    var permissionEdit = {
                        edit: false,
                        delete: false,
                    };
                    if (getUsersPermission("services_edit")) {
                        permissionEdit.edit = true;
                    }
                    if (getUsersPermission("services_delete")) {
                        permissionEdit.delete = true;
                    }
                    return createActionsColumn(
                        "admin/corporate",
                        data,
                        false,
                        0,
                        0,
                        permissionEdit.edit,
                        permissionEdit.delete,
                        0,
                        0,
                        0,
                        "/edit"
                    );
                },
            },
        ],
        success: function (response) {
            $("#something").html("data is found");
        },
    });

    var sessionid = $('#users-sessions-table').attr('sessionid');
    $('#users-sessions-table').dataTable({
        "ajax": {
            "url": SITE_URL + `/counsellor/sessions/${sessionid}`,
            "contentType": "application/json",
            "type": "GET"
        },
        "columns": [{
            "data": "sr_no"
        }, {
            "data": "name"
        }, {
            "data": "register"
        }, {
            "data": "status"
        }, ],
        success: function(response) {
            $('#something').html("data is found");
        }
    });


        $("#journal-table").DataTable({
            ajax: {
                url: SITE_URL + "/admin/journal",
                contentType: "application/json",
                type: "GET"
            },
            columnDefs: [
                {
                    width: "20%",
                    targets: 2
                }
            ],
            columns: [
                {
                    data: "sr_no"
                },
                {
                    data: "title"
                },
                {
                    data: null,
                    defaultContent: "",
                    sClass: "to-show",
                    mRender: function(data, type, row) {
                        var permissionEdit = {
                            edit: false,
                            delete: false
                        };
                        if (getUsersPermission("journal_edit")) {
                            permissionEdit.edit = true;
                        }
                        if (getUsersPermission("jorunal_delete")) {
                            permissionEdit.delete = true;
                        }
                        return createActionsColumn(
                            "admin/journal",
                            data,
                            false,
                            permissionEdit.delete,
                            false,
                            permissionEdit.edit,
                            false
                        );
                    }
                }
            ],
            success: function(response) {
                $("#something").html("data is found");
            }
        });

        $("#mood-logs-table").DataTable({
            "ordering": false,
            "lengthChange": false,
            "bInfo" : false,
            "order": [[ 0, "desc" ]],
            "responsive": true,
            ajax: {
                url: SITE_URL + "/feels/mood-logs",
                contentType: "application/json",
                type: "GET"
            },
            columns: [
                { data: "title" },
                { data: "date" },
                {data :"delete"},
            ],
            success: function(response) {
                $("#something").html("data is found");
            }
        });

        $("#safety-plans-table").DataTable({
            ordering: false,
            lengthChange: false,
            bInfo: false,
            order: [[0, "desc"]],
            responsive: true,
            ajax: {
                url: SITE_URL + "/admin/safety",
                contentType: "application/json",
                type: "GET"
            },
            columns: [
                { data: "sr_no" },
                { data: "title" },
               /*  { data: "description" },
                { data: "number" }, */
                { data: "type" },
                { data: "icon" },
                {
                    data: null,
                    defaultContent: "",
                    sClass: "to-show",
                    mRender: function(data, type, row) {
                        var permissionEdit = {
                            edit: false,
                            delete: false
                        };
                        if (getUsersPermission("safety_edit")) {
                            permissionEdit.edit = true;
                        }
                        if (getUsersPermission("safety_delete")) {
                            permissionEdit.delete = true;
                        }
                        return createActionsColumn('admin/safety', data, 0, permissionEdit.delete, false, permissionEdit.edit, 0, 0, 0, 0, '/edit', '/show')
                    }
                }
            ],
            success: function(response) {
                $("#something").html("data is found");
            }
        });



});
