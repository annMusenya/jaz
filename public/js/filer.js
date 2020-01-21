$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#filer_input").filer({
        limit: null,
        maxSize: null,
        extensions: null,
        changeInput:
            '<div class="jFiler-input-dragDrop"><div class="jFiler-input-inner"><div class="jFiler-input-text"><span class="text-muted"><strong>Drop files here</strong></span><span class="ml-2"><a class="btn btn-small btn-primary text-white">Browse</a></span></div></div></div>',
        showThumbs: true,
        theme: "dragdropbox",
        templates: {
            box: '<ul class="jFiler-items-list jFiler-items-grid"></ul>',
            item:
                '<li class="jFiler-item">\
                        <div class="row">\
                            <div class="col-md-9">\
                            <p class="text-primary" title="{{fi-name}}">{{fi-name}}</p>\
                            </div>\
							<div class="col-md-3 text-right">\
								<a class="icon-jfi-trash jFiler-item-trash-action"></a>\
                            </div>\
                            <div class="col-md-12">{{fi-progressBar}}</div>\
                        </div>\
					</li>',
            itemAppend:
                '<li class="jFiler-item">\
							<div class="jFiler-item-container">\
								<div class="jFiler-item-inner">\
									<div class="jFiler-item-thumb">\
										<div class="jFiler-item-status"></div>\
										<div class="jFiler-item-thumb-overlay">\
											<div class="jFiler-item-info">\
												<div style="display:table-cell;vertical-align: middle;">\
													<span class="jFiler-item-title"><b title="{{fi-name}}">{{fi-name}}</b></span>\
													<span class="jFiler-item-others">{{fi-size2}}</span>\
												</div>\
											</div>\
										</div>\
										{{fi-image}}\
									</div>\
								</div>\
							</div>\
						</li>',
            progressBar: '<div class="bar"></div>',
            itemAppendToEnd: false,
            canvasImage: false,
            removeConfirmation: true,
            _selectors: {
                list: ".jFiler-items-list",
                item: ".jFiler-item",
                progressBar: ".bar",
                remove: ".jFiler-item-trash-action"
            }
        },
        addMore: true,
        dragDrop: {
            dragEnter: null,
            dragLeave: null,
            drop: null,
            dragContainer: null
        },
        files: null,
        allowDuplicates: true,
        clipBoardPaste: true,
        excludeName: null,
        beforeRender: null,
        afterRender: null,
        beforeShow: null,
        beforeSelect: null,
        onSelect: null,
        afterShow: null,
        onRemove: function(itemEl,file,id,listEl,boxEl,newInputEl,inputEl) 
        {
            var filerKit = inputEl.prop("jFiler"),
                file_name = filerKit.files_list[id].name;
            $.post("/remove-file/{filename}", { file: file_name });
        },
        onEmpty: null,
        options: null,
        captions: {
            button: "Choose Files",
            feedback: "Choose files To Upload",
            feedback2: "files were chosen",
            drop: "Drop file here to Upload",
            errors: {
                filesLimit:
                    "Only {{fi-limit}} files are allowed to be uploaded.",
                filesType: "Only Images are allowed to be uploaded.",
                filesSize:
                    "{{fi-name}} is too large! Please upload file up to {{fi-maxSize}} MB.",
                filesSizeAll:
                    "Files you've choosed are too large! Please upload files up to {{fi-maxSize}} MB."
            }
        }
    });
});
