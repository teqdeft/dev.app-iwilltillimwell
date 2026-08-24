<select class="form-control allergy-option" name="medicationAllergyName">
   @if ($response)
   <option value="">Please select medication allergy</option>
   @foreach($response as $result)
   <option data-medicationAllergyForeignId="{{ round($result['medicationAllergyForeignId']) }}" data-damConceptId="{{ round($result['damConceptId']) }}" data-damConceptIdType="{{ round($result['damConceptIdType']) }}" value="{{ $result['medicationAllergyName'] }}"> {{ $result['medicationAllergyName'] }}</option>
   @endforeach
   @else
   <option value="">No result found</option>
   @endif
</select>