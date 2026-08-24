<div class="modal fade" id="addRoleModal" tabindex="-1" role="dialog" aria-labelledby="addRoleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addRoleModalLabel">Role</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ route('admin.roles.store') }}" id="roles" enctype='multipart/form-data'>
        <div class="modal-body">
            @csrf
            <div class="row mb-4">
                <input type="hidden" name="id" class="roleIdUpdate" />
                <div class="form-group col-sm-12">
                    <label for="select-inc-type">Name</label>
                    <input type="text" class="form-control roleNameUpdate" id="name"  name="name"
                        placeholder="Role name" autocomplete="off">
                </div>    
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>