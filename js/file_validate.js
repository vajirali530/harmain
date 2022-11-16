$(document).ready(function () {
    const pondInput = document.querySelector('input');

    FilePond.registerPlugin(FilePondPluginFileValidateType);
    FilePond.registerPlugin(FilePondPluginFileValidateSize);

    const myPond = FilePond.create(
        pondInput, {
            maxFiles: 5,
            maxParallelUploads: 5
        }
    );
    // myPond.addFile('./images/404.gif');
    // let fileList = myPond.getFiles();
    // console.log(fileList[0].fileExtension);
    // var reqExt = ['png', 'jpeg', 'jpg'];

    // Adding a basic base64 encoded DataURL

    myPond.on('addfile', (error, file) => {
        if (error) {
            console.log(file);
            console.log('Oh no');
            return;
        }
        console.log('File added', file);
        console.log(file.fileExtension);
        // if(!reqExt.includes(file.fileExtension)) {
        //     console.log('error');
        //     return false;
        // }
    });

    $("#upload-form").submit(function (e) {
        e.preventDefault();
        
        if(myPond.getFiles().length <= 0) {
            $('#file_size .error-message').text('File is required');
            console.log('asassa');
            console.log(myPond.getFiles());
            return;
        }
        
        $('#file_size .error-message').text('');
        $("button[name=submit_contact_form]").attr("disabled", true);
        $(".submit-loader").removeClass("d-none").addClass("d-inline-block");
        $(".error-message").html("");

        var fd = new FormData(this);
        pondFiles = myPond.getFiles();
        for (var i = 0; i < pondFiles.length; i++) {
            fd.append('file[]', pondFiles[i].file);
        }

        $.ajax({
                url: './formHandler.php',
                type: 'POST',
                data: fd,
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function (response) {
                    $("button[name=submit_contact_form]").attr("disabled", false);
                    $(".submit-loader").removeClass("d-inline-block").addClass("d-none");

                    var pond_ids = [];
                    if (myPond.getFiles().length != 0) {
                        myPond.getFiles().forEach(function(file) {
                            pond_ids.push(file.id);
                        });
                    }
                    myPond.removeFiles(pond_ids);
                    // console.log(response);
                    // response = JSON.parse(response);
                    if (response.success) {
                        mdtoast.success(response.success, {
                          duration: 5000,
                          position: "bottom center",
                        });
                        $("form")[0].reset();
                      } else {
                        mdtoast.error("Unwantederror while submiting form. Please try again", {
                          duration: 5000,
                          position: "bottom center",
                        });
                      }
                },
                error: function (data) {
                    $("button[name=submit_contact_form]").attr("disabled", false);
                    $(".submit-loader").removeClass("d-inline-block").addClass("d-none");
                    data = JSON.parse(data.responseText);
                    if (data.error) {
                        Object.keys(data.error).forEach(function (key) {
                            $("#" + key)
                            .closest(".form-group")
                            .find(".error-message")
                            .html(data.error[key]);
                        });
                    }
        
                    if (data.toast) {
                        mdtoast.error(data.toast, {
                            duration: 5000,
                            position: "bottom center",
                        });
                    }
                }
            }
        );
    });
  
    //   $('.upload-btn button').click(function(e) {
    //     e.preventDefault();
    //     console.log('asassa');
    //   });

});