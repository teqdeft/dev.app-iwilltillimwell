<div class="messageTool">
@if (!empty($getMessageHeaders['viewData']['eDocMobileServicesMessageHeader']) && $inbox )
    <input type="checkbox" class="checkAllBoxArc">
    <a class="messageArchiveButton" title="Archive" count="multipal">Archive</a>
@endif
</div>
<table class="table table-striped table-hover">
  <tbody>
    @if (!empty($getMessageHeaders['viewData']['eDocMobileServicesMessageHeader']))
        @foreach ($getMessageHeaders['viewData']['eDocMobileServicesMessageHeader'] as $value )
            <tr>
                <td>
                    <div class="messageList">
                        @if ($inbox)
                            <input type="checkbox" class="checkBoxSingle">
                        @endif
                        <div class="messageDetails singleMessage" messageId="{{ $value['ID'] }}" >
                            <strong>{{ $value['FromName'] }}</strong>
                            <p>{{ $value['Subject'] }}</p>
                        </div>
                        <div class="messageTime">
                            <p>{{ date('d M',strtotime($value['Rcvd'])) }}</p>
                            @if ( date('Y',strtotime($value['ReadDate'])) == 1900 )
                                <i class="fas fa-envelope" aria-hidden="true"></i>
                            @else
                                <i class="fas fa-envelope-open"></i>
                            @endif
                            <p></p>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    @else
        <tr>
            <td class="textAlign">								@if($inbox) 										Your inbox is empty.								@else 									Your archive is empty.								@endif						</td>
        </tr>
    @endif
  </tbody>
</table>