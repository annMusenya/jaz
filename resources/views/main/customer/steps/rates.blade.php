@php
    $rates = array('levels'=>$academicLevels, 'documents'=>$documents, 'subjects'=>$subjects, 'deadlines'=>$deadlines);
    $result = json_encode($rates);
@endphp
{{$result}}
