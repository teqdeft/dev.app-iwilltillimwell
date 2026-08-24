
<table class="table table-bordered user-table-box" >
                                        <thead>
                                            <tr>
                                                <th>
                                                <a href="{{ route('admin.customers.index', ['status'=>$status,'search'=>$search,'sort_by' => 'id', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">
                                                    #
                                                    @if ($sortBy == 'id')
                                                        @if ($sortOrder == 'asc')
                                                            <i class="fa fa-arrow-up"></i>
                                                        @else
                                                            <i class="fa fa-arrow-down"></i>
                                                        @endif
                                                    @endif 
                                                </a>
                                                </th>
                                                <th>
                                                    
                                                    <a href="{{ route('admin.customers.index', ['status'=>$status,'search'=>$search,'sort_by' => 'fname', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">
                                                        Name
                                                        @if ($sortBy == 'fname')
                                                            @if ($sortOrder == 'asc')
                                                                <i class="fa fa-arrow-up"></i>
                                                            @else
                                                                <i class="fa fa-arrow-down"></i>
                                                            @endif
                                                        @endif
                                                    </a>

                                                </th>
                                                <th>
                                                    <a href="{{ route('admin.customers.index', ['status'=>$status,'search'=>$search,'sort_by' => 'email', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">
                                                        Email
                                                        @if ($sortBy == 'email')
                                                            @if ($sortOrder == 'asc')
                                                                <i class="fa fa-arrow-up"></i>
                                                            @else
                                                                <i class="fa fa-arrow-down"></i>
                                                            @endif
                                                        @endif
                                                    </a>
                                                </th>
                                                <th>
                                                    <a href="{{ route('admin.customers.index', ['status'=>$status,'search'=>$search,'sort_by' => 'primaryPhone', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">
                                                        Phone
                                                        @if ($sortBy == 'primaryPhone')
                                                            @if ($sortOrder == 'asc')
                                                                <i class="fa fa-arrow-up"></i>
                                                            @else
                                                                <i class="fa fa-arrow-down"></i>
                                                            @endif
                                                        @endif
                                                    </a>
                                                </th>
                                                <th>Organizations</th>
                                                <th>Status</th>

                                                
                                                <th>

                                                <a href="{{ route('admin.customers.index', ['status'=>$status,'search'=>$search,'sort_by' => 'created_at', 'sort_order' => $sortOrder == 'asc' ? 'desc' : 'asc']) }}">
                                                    Join Date & Time
                                                    @if ($sortBy == 'created_at')
                                                        @if ($sortOrder == 'asc')
                                                            <i class="fa fa-arrow-up"></i>
                                                        @else
                                                            <i class="fa fa-arrow-down"></i>
                                                        @endif
                                                    @endif
                                                </a>

                                                </th>

                                                  <td>Expiry Date</td>  
                                                <th><input type="checkbox" id="select-all" onclick="toggleCheckboxes(this)"> </th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        @if($customer_list->isNotEmpty())
                                         
                                            @foreach ($customer_list as $customer)
                                                <tr id="tabl-list-{{$customer->id}}">
                                                    <td>{{ $customer_list->firstItem() + $loop->index }}</td>
                                                    <td>{{ $customer->fname }} {{ $customer->lname }}</td>
                                                    <td>{{ $customer->email }}</td>
                                                    <td>{{ $customer->primaryPhone }}</td>
                                                    <td>{{ $customer->organizations_name }}</td>
                                                    <td class="table-status">
                                                        @if($customer->payment_status==1)
                                                            <span class="badge badge-success">Active</span>
                                                        @else 
                                                        <span class="badge badge-warning">InActive</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $customer->created_at }}</td>   
                                                    <td>{{ $customer->expiry_date }}</td> 
                                                    
                                                    <td><input type="checkbox" value="{{ $customer->id }}" name="user_ids[]" class="checkbox-item"></td>
                                                </tr>
                                            @endforeach
                                        @else 
                                        <tr>
                                            <td colspan="5">Sorry No Record</td>
                                        </tr>
                                        @endif
                                    </tbody>
                                  </table>
 <div class="mt-3">{{ $customer_list->appends(request()->query())->links() }}</div>