window.defaultErrorMessage = () => {

    swal({
        type: "error",
        title: "An error occurred. Please try again later",
        confirmButtonText: 'Ok'
    });

};

window.showMessage = (title, type = 'success', text = '', is_html = false) => {

    let data = {
        type: type,
        title: title
    };

    if(text.length) {

        data[is_html ? 'html' : 'text'] = text;

    }

    swal(data);

};

window.closureQuestion = (closure, type = 'warning', title, text = '', return_result = false) => {

    if(typeof text != 'string' || !text.length) {

        text = "Are you sure?";

    }

    swal({
        type: type,
        title: title,
        text: text,
        confirmButtonText: "Yes",
        showCancelButton: true,
        cancelButtonText: "No"
    }).then((result) => {

        if(return_result) {

            closure(result);

        } else if(result.value) {

            closure();

        }

    });

};

window.showValidationErrors = (error) => {

  if('data' in error['response']) {

    if('errors' in error['response']['data'] && typeof error['response']['data']['errors'] === 'object') {

      showMessage(
        "Validation error",
        "error",
        Object.values(
          error.response.data["errors"]
        ).join(
          '<br />'
        ),
        true
      );

    } else defaultErrorMessage();

  } else defaultErrorMessage();

};
