@extends('admin.layouts.dashboard')
@section('content')
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>
<div class="main-panel main-panel-for-modal-page promo-code-wrapper permission_wrapper">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-12 mb-4 mb-xl-0">
                        <div class="patient-details ">
                            <div class="media pc-media-box">
                                <div class="title-heading-icon-box-cus">
                                    <i class="fas fa-tag"></i>
                                </div>
                                <div class="media-body">
                                    <h3 class="font-weight-bold mb-0">{{ (!empty($role->id))?'Update Permission':'Create Permission' }}</h3>
                                    <a href="{{ url('admin/permission') }}" class="btn-custom"><i
                                            class="fas fa-chevron-left" aria-hidden="true"></i> Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card card-body">
                    <div class="all-consultations-box  p-3">
                        <form method="post" action="{{ route('admin.permission.store') }}" id="permission" enctype='multipart/form-data'>
                            @csrf
                            <input type="hidden" value="{{ $permission->id??'' }}" name="id" />
                            <div class="row mb-4">
                              <div class="form-group col-sm-6">
                                  <label for="select-inc-type">Assign To*</label>
                                  <div class="roleContainer">
                                      <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle roleDropDownSelect" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                @if($role)
                                                    @foreach($role as $key => $value)
                                                        @if( !empty($permission) )
                                                            @if($permission->role_id == $value->id)
                                                                {{ ucfirst($value->name) }}
                                                            @endif
                                                        @else
                                                            @if( $key == 0  )
                                                                Select Role    
                                                            @endif
                                                        @endif
                                                    @endforeach
                                                @else
                                                    Select Role
                                                @endif
                                            </button>
                                            <input type="hidden" name="role_id" value="{{ $permission->role_id??'' }}" >
                                            <div class="dropdown-menu optionRolesName" aria-labelledby="dropdownMenuButton">
                                                @if($role)
                                                @foreach($role as $value)
                                                <div class="roleName">
                                                    <a data-roleid="{{ $value->id }}" class="dropdown-item roleIdDrop" href="javascript:;">{{ ucfirst($value->name) }}</a>
                                                    <a href="javascript:;" class="editRoleName" data-toggle="tooltip" title="Edit"><i class="fas fa-edit"></i></a>
                                                    <a href="javascript:;" class="deletePermission" data-id="{{ $value->id }}" data-toggle="tooltip" title="Delete"><i class="fas fa-trash"></i></a>
                                                </div>
                                                @endforeach
                                                @endif
                                            </div>
                                      </div>
                                      <div class="roleButton">
                                          <button type="button" class="btn btn-primary addRoleButton" data-toggle="modal" data-target="#addRoleModal">
                                              Add Role
                                            </button>
                                      </div>
                                  </div>
                              </div>
                              <div class="form-group col-sm-12 selection_box_wrapper">
                                <div class="row">
                                  <div class="col-md-12" >
                                    <div class="form-group select_all_checkbox">
                                      <input type="checkbox" id="selectAllPermission" />
                                      <label for="selectAllPermission">Select All</label>
                                    </div>
                                  </div>
                                    @if($modules)
                                        @foreach($modules as $key => $value)
                                                @php $permissiondata = json_decode($permission->permissions??''); @endphp
                                                <div class="col-md-2" >
                                                  <div class="form-group p-2">
                                                  <div class="module-container">
                                                    <div class="module-title" >
                                                   
                                                        <input type="checkbox" id="{{ $key }}" class="moduleName" {{ permission_head_check($value['module_type'],$permissiondata); }} />
                                                        <label for="{{ $key }}">{{ $value['module_name'] }}</label>
                                                 
                                                    </div>
                                                    <div class="module-child-menus" >
                                                    <ul class="list-group">
                                                      @foreach($value['module_type'] as $childKey => $childValue)
                                                       
                                                              <li class="list-group-item">
                                                              <input type="checkbox" id="{{ $childValue }}" name="modules[{{ $childValue }}]" class="child-permission {{ $key }}"
                                                              <?php
                                                                    if( !empty($permission) ){
                                                                        if( in_array($childValue,$permissiondata) ){
                                                                          echo 'checked';
                                                                        }
                                                                    }
                                                              ?> />
                                                              <label for="{{ $childValue }}">{{ $childKey }}</label>
                                                                  </li>
                                                         
                                                      @endforeach
                                                      </ul>
                                                    </div>
                                                  </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>


                              </div>
                              <div class="col-sm-12 p-2">
                                  <div class="form-group">
                                      <button type="submit" class="btn btn-primary mr-3" id="submit">Submit</button>
                                  </div>
                              </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>  
@include('admin.permission.addRoleModal')
@endsection
