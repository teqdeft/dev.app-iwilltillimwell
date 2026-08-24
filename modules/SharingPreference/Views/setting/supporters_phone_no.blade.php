<div class="to-phone_content">

        <!-- <div class="deleteContainer">
            {{-- <button type="button" class="btn btn-outline-danger trashShareContact" checkType="selected_phone_number[]" ><i class="fa fa-trash"
                                aria-hidden="true"></i></button> --}}
        </div> -->
        <div class="phone-list_area">
            <div class="table-responsive">
            <table class="table table-striped table-data-theme" id="supporterTableData">
                <thead>
                    <tr>
                    <th scope="col">Relation</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $emailAdded = false; @endphp
                    @if ( $friendContact )
                        @foreach ($friendContact as $key => $value )
                            @php $emailAdded = true; @endphp
                            <tr>
                                <td>{{ ucfirst($value['relation']) }}</td>
                                <td>{{ ucfirst($value['name']) }}</td>
                                <td>{{ $value['email']??'' }}</td>
                                <td>{{ ucfirst($value['content']) }}</td>
                                <td>
                                    <a class="deleteByAjax" data-resource="" href="#!" number="{{ $value['id'] }}" data-url="{{ url('share/deleteFriendContact') }}" data-toggle="tooltip" title="Delete">
                                        <label class="badge badge-danger-cus"><i class="fas fa-trash"></i></label>
                                    </a>
                                    <a href="#!" data-toggle="tooltip" title="Edit" sf-id="{{ $value['id'] }}" class="editFrienContacts">
                                        <label class="badge badge-danger-cus"><i class="fas fa-edit"></i></label>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif

                </tbody>
            </table>
            </div>
        </div>
    </div>



