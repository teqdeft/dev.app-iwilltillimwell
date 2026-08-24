<div class="crolll-bar cbt-log-v1">
    <div class="main-title">
        <h3>Automatic Thought:</h3> 
    </div>
    <div class="cbt-value">
        <p>{{ $data->automatic_thought }}</p>
    </div>
    <div class="main-heading-cbt">
        <h3>Thought Details</h3>
    @if( !empty( $data->thought_details) )
        @php 
            $thought = json_decode($data->thought_details);
            $automatic_thought = json_decode($data->automatic_thought);

        @endphp

        @foreach($thought as $key)
        <div class="cust-check bg-check">
            <label for="check-{{ $key }}">
                {{ Config('constants.CBT_DETAILS')[$key]['title'] }}
                <div class="check-para check-para-short">
                    {{ Config('constants.CBT_DETAILS')[$key]['short'] }}
                </div>
                <div class="check-para check-para-long check-para-{{ $key }}">
                    <?= Config('constants.CBT_DETAILS')[$key]['long'] ?>
                </div>

            </label>
        </div>
        @endforeach
    @endif
    </div>
    <div class="main-title">
        <h3>Challenge Thought</h3>
    </div>
    <div class="cbt-value">
        <p>{{ $data->challenge_thought }}</p>
    </div>
    <div class="main-title">
        <h3>Alternative Thought</h3>
    </div>
    <div class="cbt-value">
        <p>{{ $data->alternative_thought }}</p>
    </div>
</div>
<style>
    .crolll-bar.cbt-log-v1 {
        position: relative;
        text-align: left;
    }

    .crolll-bar.cbt-log-v1 .cbt-value {
        position: relative;
        background: #d3d3d3ad;
        padding: 5px 10px;
        border-radius: 7px;
        margin: 8px 0;
        font-size: 12px;
    }

    .crolll-bar.cbt-log-v1 .main-heading-cbt {
        position: relative;
        margin: 20px 0 10px;
        font-size: 16px;
    }

    .crolll-bar.cbt-log-v1 .main-title {
        font-size: 12px;
    }
</style>