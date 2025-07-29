/**
 * Create_by_yp.
 */
$("#Name").on("keyup", function (event) {
    if (event.keyCode == 13) {
        $("#save_data").get(0).click();
    }
});
$(document).ready(function () {
    $(".alert").delay(5000).slideUp(500);
});



function readAudioURL(input) {
    //console.log($(this.id));
    var id = $(input).attr('id');
    console.log(id);
    // var audio_player_id = $('#'+id+'').next('.player').attr('id'); 
    // var audio_player_id = $('#'+id+'').next('div').attr('id'); 
    var audio_player_id = $('#' + id + '').siblings('.player').attr('id');
    var audio_id = $('#' + audio_player_id + '').children('audio').attr('id');
    console.log(audio_player_id);
    console.log(audio_id);
    $('#' + audio_id + '').attr('src', '');

    var filesSelected = input.files;
    if (filesSelected.length > 0) {
        var fileToLoad = filesSelected[0];
        var fileName = fileToLoad.name;
        var size = fileToLoad.size;
        var type = fileToLoad.type;
        var fileReader = new FileReader();
        fileReader.onload = function (e) {
            $("#" + audio_player_id + "").show();
            var sound = document.getElementById(audio_id);
            sound.src = this.result;
            sound.controls = true;
        }
        fileReader.readAsDataURL(fileToLoad);
    }
}

function summernote_editor() {
    console.log('summernote_edior called');
    var summernote_element = $('.summernote_editor');
    summernote_element.summernote({
        // placeholder: "Enter Text Here...",
        minHeight: 110,
        foreColor: 'red',
        theme: 'cosmo',
        toolbar: [
            // ['style', ['style']],
            ['style', ['bold', 'italic', 'underline', 'clear']],
            // ['fontsize', ['fontsize']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['view', ['codeview']],
        ],
        callbacks: {
            onPaste: function (e) {
                console.log('Called event paste callbacks');
                var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
                e.preventDefault();
                document.execCommand('insertText', false, bufferText);
            }
        },
        onPaste: function (e) {
            console.log('Called event paste');
            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
            e.preventDefault();
            document.execCommand('insertText', false, bufferText);
        }
        // callbacks: { onInit: function () { var editor = elem.next(), placeholder = editor.find(".note-placeholder"); function isEditorEmpty() { var code = elem.summernote("code"); return code === "<p><br></p>" || code === ""; } editor.on("focusin focusout", ".note-editable", function (e) { if (isEditorEmpty()) { placeholder[e.type === "focusout" ? "show" : "hide"](); } }); } }
    });
    $('.note-list.btn-group').css('display', 'none');
    $('.note-editor .note-toolbar .note-para .dropdown-menu').css('min-width', '151px');
    // summernote_element.on("summernote.paste",function(e,ne) {
    //     var bufferText = ((ne.originalEvent || ne).clipboardData || window.clipboardData).getData('Text');
    //     ne.preventDefault();
    //     document.execCommand('insertText', false, bufferText);
    // });
}

function activeDeactive(id, elem_id, url, is_active) {
    var query_string = { 'id': id, 'is_active': is_active };
    console.log('query_string', query_string);

    swal({
        title: "Confirm Update!",
        text: 'Are you sure you want to update the status of user?',
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, I want!",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true
    },
        function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: query_string,
                    success: function (data) {
                        if (data.ResponseCode == 1) {
                            if (is_active == 0) {
                                $(elem_id).addClass('inactive').removeClass('active');
                                $(elem_id).attr("title", "Inactive");
                                $(elem_id).html("<i class='fa fa-power-off'></i>");
                                $('table tr#' + id + ' td:nth-child(8)').html('<span class="label label-danger">Inactive</span>');

                            } else {
                                $(elem_id).addClass('active').removeClass('inactive');
                                $(elem_id).attr("title", "Active");
                                $(elem_id).html("<i class='fa fa-check'></i>");
                                $('table tr#' + id + ' td:nth-child(8)').html('<span class="label label-primary">Active</span>');
                            }
                            swal("Updated!", "Updated Successfully!", "success");
                            // $('body').removeClass('stop-scrolling');
                            // $("body").css("overflow:auto");
                        } else {
                            swal("Something went wrong");
                        }
                    }
                });
            }
        });
}

function activeDeactiveLanguagePairFun(id, elem_id, url, is_active) {
    var query_string = { 'id': id, 'is_active': is_active };
    console.log('query_string', query_string);

    swal({
        title: "Confirm Update!",
        text: 'Are you sure you want to update the status of language pair?',
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, I want!",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true
    },
        function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: query_string,
                    success: function (data) {
                        if (data.ResponseCode == 1) {
                            if (is_active == 0) {
                                $(elem_id).attr("title", "Inactive");
                                $(elem_id).addClass('inactive').removeClass('active');
                                $(elem_id).html("<i class='fa fa-power-off'></i>");
                                $('table tr#' + id + ' td:nth-child(6)').html('<span class="label label-danger">Inactive</span>');

                            } else {
                                $(elem_id).attr("title", "Active");
                                $(elem_id).addClass('active').removeClass('inactive');
                                $(elem_id).html("<i class='fa fa-check'></i>");
                                $('table tr#' + id + ' td:nth-child(6)').html('<span class="label label-primary">Active</span>');
                            }
                            swal("Updated!", "Updated Successfully!", "success");
                            // $('body').removeClass('stop-scrolling');
                            // $("body").css("overflow:auto");
                        } else {
                            swal("Something went wrong");
                        }
                    }
                });
            }
        });
}
function updateStatusToUnderReviewFun(id, elem_id, url, review_status) {
    var query_string = { 'id': id, 'review_status': review_status };
    // var swal_text = $('<div />').html('<p style="padding-bottom:20px;">Where do you want to copy the file(s) to?</p>').append(folder_select);
    var folder_select = ' <select class="sweet_alert_select" id="review_status" name="review_status" ><option value="0" >Under review</option><option value="1" >Reviewed</option></select>';
    var swal_text = $('<div />').html('<p style="padding-bottom:20px;">Are you sure you want to update the status?</p>').append(folder_select);
    console.log('query_string', query_string);
    swal({
        title: "Confirm Update!",
        text: swal_text.html(),
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, I want!",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        html: true,
    },
        function (isConfirm) {
            if (isConfirm) {
                var new_status = $('#review_status').val();
                var query_string = { 'id': id, 'review_status': new_status };
                console.log(query_string);
                $.ajax({
                    url: url,
                    type: "POST",
                    data: query_string,
                    success: function (data) {
                        if (data.ResponseCode == 1) {
                            if (new_status == 1) {
                                $(elem_id).addClass('reviewed').removeClass('under_review');
                                $(elem_id).attr('onClick', 'updateStatusToReverce(\'' + id + '\');');
                                $(elem_id).attr("title", "Reviewed");
                                $(elem_id).html("<i class='fa fa-check'></i>");
                                $('table tr#' + id + ' td:nth-child(10)').html('<span class="label label-primary">Reviewd</span>');
                                // $('table tr#' + id + ' td:nth-child(10)').html('<span class="label label-primary">Reviewd</span>');
                            } else if (new_status == 0) {
                                $(elem_id).addClass('under_review').removeClass('waiting_for_review');
                                $(elem_id).attr('onClick', 'updateStatusToReviewd(\'' + id + '\');');
                                $(elem_id).attr("title", "Under review");
                                $(elem_id).html("<i class='fa fa-paper-plane'></i>");
                                $('table tr#' + id + ' td:nth-child(10)').html('<span class="label label-danger">Under Review</span>');
                            }

                            swal("Updated!", "Updated Successfully!", "success");
                        } else {
                            swal("Something went wrong");
                        }
                    }
                });
            }
        });
}

function updateStatusToReviewdFun(id, elem_id, url, review_status) {
    var query_string = { 'id': id, 'review_status': review_status };
    // var swal_text = $('<div />').html('<p style="padding-bottom:20px;">Where do you want to copy the file(s) to?</p>').append(folder_select);
    var folder_select = ' <select class="sweet_alert_select" id="review_status" name="review_status" ><option value="1" >Reviewed</option> <option value="2" >Waiting for review</option></select>';
    var swal_text = $('<div />').html('<p style="padding-bottom:20px;">Are you sure you want to update the status?</p>').append(folder_select);
    console.log('query_string', query_string);
    swal({
        title: "Confirm Update!",
        text: swal_text.html(),
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, I want!",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        html: true,
    },
        function (isConfirm) {
            if (isConfirm) {
                var new_status = $('#review_status').val();
                var query_string = { 'id': id, 'review_status': new_status };
                console.log(query_string);
                $.ajax({
                    url: url,
                    type: "POST",
                    data: query_string,
                    success: function (data) {
                        if (data.ResponseCode == 1) {
                            if (new_status == 1) {
                                // $(elem_id).html("");
                                $(elem_id).addClass('reviewed').removeClass('under_review');
                                $(elem_id).attr('onClick', 'updateStatusToReverce(\'' + id + '\');');
                                $(elem_id).attr("title", "Reviewed");
                                $(elem_id).html("<i class='fa fa-check'></i>");
                                $('table tr#' + id + ' td:nth-child(10)').html('<span class="label label-primary">Reviewd</span>');

                                // $('table tr#' + id + ' td:nth-child(10)').html('<span class="label label-primary">Reviewd</span>');
                            } else if (new_status == 2) {
                                $(elem_id).addClass('waiting_for_review').removeClass('under_review');
                                $(elem_id).attr('onClick', 'updateStatusToUnderReview(\'' + id + '\');');
                                $(elem_id).attr("title", "Waiting for Review");
                                $(elem_id).html("<i class='fa fa-clock-o'></i>");
                                $('table tr#' + id + ' td:nth-child(10)').html('<span class="label label-warning">Waiting for Review</span>');
                            }

                            swal("Updated!", "Updated Successfully!", "success");
                        } else {
                            swal("Something went wrong");
                        }
                    }
                });
            }
        });
    /*var query_string = {'id': id, 'review_status': review_status};
   
    console.log('query_string',query_string); 
    swal({
        title: "Confirm Update!",
        text: 'Are you sure you want to update the status and set is as Reviewed?',
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, I want!",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,        
    },
    function (isConfirm) {
        if(isConfirm) {
            $.ajax({
                url: url,
                type: "POST",
                data: query_string,
                success: function (data) {
                    if (data.ResponseCode == 1) {
                        $(elem_id).html("");
                        // $(elem_id).prop("onclick", null).off("click");
                        $(elem_id).addClass('reviewed').removeClass('under_review');
                        $(elem_id).attr('onClick', 'updateStatusToReverce(\''+id+'\');');
                        $(elem_id).attr("title", "Reviewed");
                        $(elem_id).html("<i class='fa fa-check'></i>");
                        $('table tr#' + id + ' td:nth-child(10)').html('<span class="label label-primary">Reviewd</span>');
                        swal("Updated!", "Updated Successfully!", "success");
                    } else {
                        swal("Something went wrong");
                    }
                }
            });
        }
    }); */
}

function updateStatusToReverceFun(id, elem_id, url, review_status) {
    var query_string = { 'id': id, 'review_status': review_status };
    // var swal_text = $('<div />').html('<p style="padding-bottom:20px;">Where do you want to copy the file(s) to?</p>').append(folder_select);
    var folder_select = ' <select class="sweet_alert_select" id="review_status" name="review_status" ><option value="2" >Waiting for review</option><option value="0" >Under review</option></select>';
    var swal_text = $('<div />').html('<p style="padding-bottom:20px;">Are you sure you want to update the status?</p>').append(folder_select);
    console.log('query_string', query_string);
    swal({
        title: "Confirm Update!",
        text: swal_text.html(),
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, I want!",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,
        html: true,
    },
        function (isConfirm) {
            if (isConfirm) {
                var new_status = $('#review_status').val();
                var query_string = { 'id': id, 'review_status': new_status };
                console.log(query_string);
                $.ajax({
                    url: url,
                    type: "POST",
                    data: query_string,
                    success: function (data) {
                        if (data.ResponseCode == 1) {
                            if (new_status == 0) {
                                $(elem_id).addClass('under_review').removeClass('waiting_for_review');
                                $(elem_id).attr('onClick', 'updateStatusToReviewd(\'' + id + '\');');
                                $(elem_id).attr("title", "Under review");
                                $(elem_id).html("<i class='fa fa-paper-plane'></i>");
                                $('table tr#' + id + ' td:nth-child(10)').html('<span class="label label-danger">Under Review</span>');
                            } else if (new_status == 2) {
                                $(elem_id).addClass('waiting_for_review').removeClass('under_review');
                                $(elem_id).attr('onClick', 'updateStatusToUnderReview(\'' + id + '\');');
                                $(elem_id).attr("title", "Waiting for Review");
                                $(elem_id).html("<i class='fa fa-clock-o'></i>");
                                $('table tr#' + id + ' td:nth-child(10)').html('<span class="label label-warning">Waiting for Review</span>');
                            }

                            swal("Updated!", "Updated Successfully!", "success");
                        } else {
                            swal("Something went wrong");
                        }
                    }
                });
            }
        });
    /*
    var query_string = {'id': id, 'review_status': review_status};
   
    console.log('query_string',query_string); 
    swal({
        title: "Confirm Update!",
        text: 'Are you sure you want to update the status and set is as Under review?',
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, I want!",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true,        
    },
    function (isConfirm) {
        if(isConfirm) {
            $.ajax({
                url: url,
                type: "POST",
                data: query_string,
                success: function (data) {
                    if (data.ResponseCode == 1) {
                        $(elem_id).html("");
                        // $(elem_id).prop("onclick", null).off("click");
                        // $(elem_id).attr("title", "Reviewed");

                        $(elem_id).addClass('under_review').removeClass('reviewed');
                        $(elem_id).attr('onClick', 'updateStatusToReviewd(\''+id+'\');');
                        $(elem_id).attr("title", "Under review");
                        $(elem_id).html("<i class='fa fa-paper-plane'></i>");
                        $('table tr#' + id + ' td:nth-child(10)').html('<span class="label label-danger">Under Review</span>');
                        swal("Updated!", "Updated Successfully!", "success");
                    } else {
                        swal("Something went wrong");
                    }
                }
            });
        }
    }); */
}


function activeDeactiveExtra(id, elem_id, url, is_active) {
    var query_string = { 'id': id, 'is_active': is_active };
    $.ajax({
        url: url,
        type: "POST",
        data: query_string,
        success: function (data) {
            if (data.ResponseCode == 1) {
                if (is_active == 1) {
                    $(elem_id).addClass('btn-primary').removeClass('btn-danger');
                    $(elem_id).text("True");
                } else {
                    $(elem_id).addClass('btn-danger').removeClass('btn-primary');
                    $(elem_id).text("False");
                }
                swal("Updated!", "Updated Successfully!", "success");
            } else {
                swal("Something went wrong");
            }
        }
    });
}

/**
 * Delete single row in table
 */
function deleteRecord(id, path, table) {
    // console.log(path);
    var url = path + "/" + id;
    swal({
        title: "Confirm Delete!!",
        text: 'Are you sure you want to delete record?',
        type: "warning",
        showCancelButton: true,

        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No",
        closeOnConfirm: false,
        closeOnCancel: true
    },
        function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: url,
                    type: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        _method: 'DELETE' // Tell Laravel this is a DELETE request
                    },
                    success: function (data) {
                        if (data.ResponseCode == 1) {
                            $(table).DataTable().ajax.reload();
                            $('table tr#' + id + '').remove();
                            swal("Deleted!", "Deleted Successfully!", "success");
                            //$('body').removeClass('stop-scrolling');
                            //$("body").css("overflow:auto");
                        } else {
                            swal("Something went wrong");
                        }
                    }
                });
            }
        });
    return false;
}

/**
 * Check/uncheck all checkbox of table body rows depending on state of header checkbox in table header
 *  -- change background of selected checkbox rows in table
 */
$('.checkAllCheckbox').click(function () {
    if ($(this).prop('checked') == true) {
        $('.deleteCheckbox').prop('checked', true);
        $('.deleteCheckbox').closest('tr').addClass('danger');
        $('.DeleteSelected').prop('disabled', false);
    } else {
        $('.deleteCheckbox').prop('checked', false);
        $('.deleteCheckbox').closest('tr').removeClass('danger');
        $('.DeleteSelected').prop('disabled', true);
    }
});


/**
 * Check/uncheck checkbox of table body row and change background of selected checkbox row in table
 */
$('body').on('click', '.deleteCheckbox', function () {
    var total_checkbox = $('.deleteCheckbox').length;
    var selected_checkbox = $('.deleteCheckbox:checked').length;
    if (selected_checkbox == total_checkbox) {
        $('.checkAllCheckbox').prop('checked', true);
    } else {
        $('.checkAllCheckbox').prop('checked', false);
    }

    if ($(this).prop('checked') == true) {
        $(this).closest('tr').addClass('danger');
        $('.DeleteSelected').prop('disabled', false);
    } else {
        $(this).closest('tr').removeClass('danger');
        if (selected_checkbox == 0) {
            $('.DeleteSelected').prop('disabled', true);
        } else {
            $('.DeleteSelected').prop('disabled', false);
        }
    }
});

/**
 * Delete Multiple row in table
 */
function deleteAllRows(path, table) {

    var countSelected = 0;
    var ids = [];

    $('.deleteCheckbox').each(function () {
        if ($(this).prop('checked') == true) {
            countSelected++;
            ids.push(parseInt($(this).attr('itemid')));
        }
    });

    var query_string = { 'ids': ids };

    if (countSelected == 0) {
        swal("Delete Alert!", "Please check atleast one record!")
    } else {
        swal({
            title: "Delete Alert!",
            text: 'Delete Selected ' + ids.length + ' Record(s)?',
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes"
        }, function (isConfirm) {
            if (isConfirm) {
                var url = path;
                $.ajax({
                    url: url,
                    type: "POST",
                    data: query_string,
                    success: function (data) {
                        if (data.ResponseCode == 1) {
                            $(table).DataTable().ajax.reload();
                            swal("Deleted!", "Deleted Successfully!", "success");
                        } else {
                            swal("Something went wrong");
                        }
                    }
                });
                $('.checkAllCheckbox').prop('checked', false);
            }
        });
    }
}
