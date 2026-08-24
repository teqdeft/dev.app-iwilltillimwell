<div class="filter">
    <div class="filter_title">
        <p>Feelings</p>
    </div>
    
    <div class="type_filter">
                        <select id="cbt_feel" class="form-select form-select-sm" aria-label=".form-select-sm example" onchange="LoadCbtContent()">
                            <option selected value="">All Type</option>
                            <option value="better"  {{ request('cbt_feel') == 'better' ? 'selected' : '' }}>Better</option>
                            <option value="same" {{ request('cbt_feel') == 'same' ? 'selected' : '' }}>Same</option>
                            <option value="worse" {{ request('cbt_feel') == 'worse' ? 'selected' : '' }}>Worse</option>
                        </select>
    </div>

    <div class="date_filter">
                        <input type="text" id="daterange"  value="{{ request('cbt_date_filter') }}"  onchange="LoadCbtContent()" placeholder="Select date" >
    </div>
    <div class="clear_filter">
                        <button onclick="clearFilter()" class="remove_filter btn" type="button">Clear Filters</button>
    </div>
</div>