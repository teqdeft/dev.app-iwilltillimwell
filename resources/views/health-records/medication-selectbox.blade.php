<select class="form-control medication-option" name="medicationName">
   @if ($response)
      <option value="">Please select medication</option>
      @foreach($response as $result)
         <option data-ndc="{{ $result['ndc'] }}" data-foreign="{{ $result['data'] }}"> {{ $result['value'] }}</option>
      @endforeach
   @else
      <option value="">No result found</option>
   @endif
</select>