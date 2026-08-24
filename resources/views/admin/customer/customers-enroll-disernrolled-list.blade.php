
<table class="table table-bordered user-table-box" >
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Current Status</th>
                                                <th>Status</th>
                                                <th>Remark</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                       
                                            <?php $counter = 1; ?>
                                            @foreach ($customer_list as $customer)
                                                <tr id="customer_<?php echo $customer->id?>">
                                                    <td><?php echo $counter++;?></td>
                                                    <td>{{$customer->fname}}-{{$customer->lname}}</td>
                                                    <td>{{$customer->email}}</td>
                                                    <td class="current-status">
                                                        @if($customer->payment_status==1)
                                                            <span class="badge badge-success">Active</span>
                                                        @else 
                                                        <span class="badge badge-warning">InActive</span>
                                                        @endif
                                                    </td>
                                                    <td class="status_api"><span class="badge badge-warning">Pending</span></td>   
                                                    
                                                    <td class="remark_api"></td>
                                                </tr>
                                            @endforeach
                
                                    </tbody>
                                  </table>

