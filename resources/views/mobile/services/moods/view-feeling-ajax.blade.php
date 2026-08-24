<div class="crolll-bar cbt-log-v1">
	<div class="main-title">
        <h3>Mood topic.</h3> 
    </div>
    <div class="cbt-value">
        <p>{{ $data->title??'No Topic' }}</p>
    </div>
    <div class="main-title">
        <h3>Your thoughts.</h3>
    </div>
    <div class="cbt-value">
        <p>{{ $data->description??'No Thoughts' }}</p>
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