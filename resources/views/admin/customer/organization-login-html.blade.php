<div class="row">
				<div class="form-group col-sm-12">
					<label for="type">First Name*</label>
					<input type="text" class="form-control" id="fname" name="fname" value="{{$user->fname ?? ''}}">	
				</div>	
				
				<div class="form-group col-sm-12">
					<label for="type">Last Name*</label>
					<input type="text" class="form-control" id="lname" name="lname" value="{{$user->lname ?? ''}}">	
				</div>
				
				<div class="form-group col-sm-12">
					<label for="type">Email*</label>
					<input type="text" class="form-control" id="user_email" name="user_email" value="{{$user->email ?? $group_email}}" readonly>	
				</div>	
				
				<div class="form-group col-sm-12">
					<label for="type">Password*</label>
					<input type="text" class="form-control" id="password" name="password" value="">	
				</div>	
</div>