<div class="row mb-4">
						
						
    <div class="col-md-12"> 
        <div class="card shadow-sm border-0">
            <div class="card-header bg-light d-flex align-items-center">
                <i class="fas fa-plus-circle text-primary mr-2"></i>
                <strong>Add Group Organization Reward</strong>
            </div>

            <div class="card-body">
                <form action="{{ url('admin/group-organization-reward-store') }}" method="POST" id="groupRewardForm">
                    @csrf
                    <div class="row">

                        <!-- Min -->
                        <div class="col-md-3">
                            <label class="font-weight-semibold">
                                <i class="fas fa-arrow-down text-success"></i> Range From
                            </label>
                            <input type="number" name="min" class="form-control" placeholder="Enter min value" required>
                        </div>

                        <!-- Max -->
                        <div class="col-md-3">
                            <label class="font-weight-semibold">
                                <i class="fas fa-arrow-up text-danger"></i> Range Till
                            </label>
                            <input type="number" name="max" class="form-control" placeholder="Enter max value" required>
                        </div>

                        <!-- Commission -->
                        
						
						
						<div class="col-md-3">
							<label class="font-weight-semibold">
								<i class="fas fa-calendar-alt text-info"></i> Year
							</label>
							<input type="number" name="year" class="form-control" placeholder="Enter year" required>
						</div>
						
						<div class="col-md-3">
                            <label class="font-weight-semibold">
                                <i class="fas fa-percentage text-warning"></i> Commission
                            </label>
                            <input type="number" step="0.01" name="commission" class="form-control" placeholder="Commission %" required>
                        </div>
						
						

                        <!-- Button -->
                        <div class="col-md-3 d-flex align-items-end" style="padding-top: 16px;">
                            <button type="button" class="btn btn-primary w-100" onclick="saveReward()">
                                <i class="fas fa-save"></i> Save Reward
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>