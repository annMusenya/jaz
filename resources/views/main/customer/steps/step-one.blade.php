<div class="card">

  <div class="card-header">

    <h5 class="h6 text-uppercase mb-0 text-gray-500">Step 1:Paper Details</h5>

  </div>

  <div class="card-body">
  
	<div class="form-group">

      <label class="form-control-label text-base">Type of paper</label>

      <i class="fa fa-question-circle text-muted mr-0"></i>

      <select name="paper_type" class="form-control paper-type ks-control">
        <optgroup label="MOST POPULAR">
          @foreach($popularDocs as $document)
                <option value="{{$document->id}}">{{$document->name}}</option>
           @endforeach
        </optgroup>
        <optgroup label="OTHERS">
          @foreach($otherDocs as $document)
                <option value="{{$document->id}}">{{$document->name}}</option>
           @endforeach
        </optgroup>
      </select>

    </div>
	
	<div class="form-group">

    <label class="form-control-label">Discipline</label>

    <i class="fa fa-question-circle text-muted"></i>

    <select name="subject" class="form-control">
        <optgroup label="Most Popular">
            @foreach ($popular as $subject)
                <option category="normal" value="{{$subject -> name}}">{{ $subject->name }}</option>
            @endforeach
        </optgroup>
        <optgroup label="Humanities">
            @foreach ($humanities as $subject)
                <option category="normal" value="{{$subject -> name}}">{{ $subject->name }}</option>
            @endforeach
        </optgroup>
        <optgroup label="Social Sciences">
            @foreach ($socialSciences as $subject)
                <option category="normal" value="{{$subject -> name}}">{{ $subject->name }}</option>
            @endforeach
        </optgroup>
        <optgroup label="Business and Management">
            @foreach ($businessManagement as $subject)
                <option category="normal" value="{{$subject -> name}}">{{ $subject->name }}</option>
            @endforeach
        </optgroup>
        <optgroup label="Natural Sciences">
            @foreach ($naturalSciences as $subject)
                <option category="normal" value="{{$subject -> name}}">{{ $subject->name }}</option>
            @endforeach
        </optgroup>
        <optgroup label="Formal Sciences">
            @foreach ($formalSciences as $subject)
                <option category="complex" value="{{$subject -> name}}">{{ $subject->name }}</option>
            @endforeach
        </optgroup>
        <optgroup label="Applied Sciences">
            @foreach ($appliedSciences as $subject)
                <option category="complex" value="{{$subject -> name}}">{{ $subject->name }}</option>
            @endforeach
        </optgroup>
        <optgroup label="Others">
            @foreach ($others as $subject)
                <option category="normal" value="{{$subject -> name}}">{{ $subject->name }}</option>
            @endforeach
        </optgroup>
    </select>

  </div>

    <div class="form-group">

      <label class="form-control-label">Academic Level</label>

      <i class="fa fa-question-circle text-muted"></i>

      <select name="academic_level" class="form-control academic-level ks-control">
           @foreach($academicLevels as $level)
                <option value="{{$level->label}}">{{$level->name}}</option>
           @endforeach
      </select>

    </div>
	
	<div class="form-group">

    <label class="form-control-label">Title</label>

    <i class="fa fa-question-circle text-muted"></i>

    <input type="text" class="form-control" name="topic" value="Writer's Choice" placeholder="Enter the title for your paper">

  </div>
  
    <div class="form-group">
      <label class="form-control-label">Instructions</label>
      <i class="fa fa-question-circle text-muted"></i>
      <textarea class="form-control text-sm" name="instructions" max-length="500" placeholder="Write what you feel is important for the writer to consider. Like an outline or grading scale." rows="3"
      ></textarea>
    </div>

  </div>

</div>
