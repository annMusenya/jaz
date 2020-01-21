<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-8 py-2">
                        <span class="h6 mb-0 text-uppercase text-muted">File Management</span>
                    </div>
                    <div class="col-lg-4 text-right">
                        <button class="btn btn-gray-500 text-center" data-toggle="modal" data-target="#upload-file">Upload Files<i class="fa fa-upload ml-2"></i></button>
                        @include('main.admin.modals.upload-file')
                    </div>
                </div>
            </div>
            <div class="card-body">
                    @if (empty($fileCount))
                        <div class="file-icon text-center"><i class="fa fa-warning text-gray-300"></i></div>
                        <div class="text-gray-400 text-center">No files have been uploaded to this order.</div>
					 @else 
                        @foreach ($files as $file)
                            <div for="{{$file->id}}" class="px-4 py-2 d-flex align-items-center justify-content-between mb-2 roundy bg-gray-100 file-container" data-toggle="collapse" href="#fileContent{{$file->id}}" role="button" aria-expanded="false" aria-controls="fileContent">
                                <div class="icon text-gray-400 col-sm-1">
									@if($file->filetype == "txt")
										<i class="fa fa-file-text-o file-icon"></i>
									@elseif ($file->filetype == "pdf")
										<i class="fa fa-file-pdf file-icon"></i>
									@elseif ($file->filetype == "xlsx")
										<i class="fa fa-file-excel-o file-icon"></i>
									@elseif ($file->filetype == "docx")
										<i class="fa fa-file-word-o file-icon"></i>
									@elseif ($file->filetype == "zip" || $file->filetype == "rar")
										<i class="fa fa-file-archive-o file-icon"></i>
									@elseif ($file->filetype == "ppt" || $file->filetype == "pptx")
										<i class="fa fa-file-powerpoint-o file-icon"></i>
									@else
										<i class="fa fa-file-o file-icon"></i>
									@endif
                                </div>
                                <div class="text col-sm-3">
                                    <p class="mb-0 text-muted text-capitalize text-sm">{{$file->display_name}}</p>   
                                </div>
                                <div class="text col-sm-4 text-left">
                                    <p class="mb-0 text-muted text-capitalize text-sm">Purpose: {{$file->description}}</p>   
                                </div>
                                <div class="text col-sm-2"> 
                                    <p class="mb-0 text-muted text-sm"><strong class="text-primary text-capitalize">{{($file->uploader)}}</strong></p>   
                                </div>
                                <div class="text col-sm-2">
                                    <p class="mb-0 text-muted text-sm">{{($file->filesize/1000).'KB'}}</p>
                                    <p class="mb-0 text-muted text-sm">{{$file->created_at->format("M d, Y, g:ia")}}</p>
                                </div> 
                                <div class="text col-sm-1 text-right">
                                    <div class="icon text-gray-400">
                                        <a class="no-anchor-style" href="{{route('downloadfile',$file->id)}}" target="blank">
                                            <i class="fas fa-download details-icon"></i>
                                        </a>
                                        <a class="no-anchor-style ml-2" target="blank">
                                            <i class="fas fa-trash details-icon"></i>
                                        </a>
                                        @if($file->restriction)
                                            <a class="no-anchor-style ml-2" target="blank">
                                                <i class="fas fa-thumbs-up text-success details-icon"></i>
                                            </a>
                                        @else
                                            <a id="{{$file->id}}" class="no-anchor-style ml-2 allow-access" onclick="allowAccess()" target="blank">
                                                <i class="fas fa-thumbs-up details-icon"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div> 
                            </div>
                        @endforeach
                    @endif
            </div>
        </div>
    </div>
</div>