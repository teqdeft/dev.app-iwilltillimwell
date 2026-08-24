@extends('layouts.default')
@section('content')
<div>
  <p id="linkStatus" style="margin: auto;text-align: center;padding: 5em;"></p>
</div>
<script>
    @if( $expireMsg['status'] == 'before' )
      var countDownDate = new Date("{{$expireMsg['timer']}}").getTime();
      var x =  setInterval(async function() {
        var now = new Date().getTime();
        var distance = countDownDate - now;
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        var msg = "";

        if( days > 0 ){
          msg += `${days} `;
          msg += (days > 1)?'Days ':'Day ';
        }
        if( hours > 0 ){
          msg += `${hours} `;
          msg += (hours > 1)?'Hours ':'Hour ';
        }
        if( minutes > 0 ){
          msg += `${minutes} Min `;
        }
        if( seconds > 0 ){
          msg += ` ${seconds} second `;
        }
        document.getElementById("linkStatus").innerHTML = msg;

        if( (distance >= (-1999) && distance <= (-1001) ) ){
          clearInterval(x);
          window.location.reload();
        }else if( distance < (-1001)  ){
          clearInterval(x);
          document.getElementById("linkStatus").innerHTML = "EXPIRED";
        }
      }, 1000);
    @else
      document.getElementById("linkStatus").innerHTML = "EXPIRED";
    @endif
  </script>
@endsection
