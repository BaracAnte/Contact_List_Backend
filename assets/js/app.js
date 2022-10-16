// when the page is loaded and ready
$(document).ready(function () {
  $(".custom-file-input").on("change", function (event) {
    var inputFile = event.currentTarget;
    $(inputFile)
      .parent()
      .find(".custom-file-label")
      .html(inputFile.files[0].name);
  });

  $("#keyupSearch").on("keyup", function () {
    var input = $(this).val();
    var favorite = $(this).attr("data-favorite");
    var data = { input: input, favorite: favorite };
    delay(function () {
      $.ajax({
        type: "POST",
        url: "find",
        data: data,
        dataType: "json",
        success: function (response) {
          $("#contactTable tbody").empty();
          response.forEach((element) => {
            if (element.favorite == 1) {
              var favImg = "Favorite.png";
            } else {
              var favImg = "NotFavorite.png";
            }
            var row_data =
              "<tr>" +
              '<td class="small_td"><img src="/assets/images/' +
              element.image +
              '" style="width: 40px;height: 40px;border-radius: 30px;"></td>' +
              "<td>" +
              element.fullname +
              "<br>" +
              element.email +
              "</td>" +
              "<td>" +
              '<img src="/assets/images/' +
              favImg +
              '" class="img">' +
              "</td>" +
              "<td>" +
              '<a href="/contacts/add_edit/' +
              element.id +
              '">Edit</a>' +
              "</td>" +
              "<td>" +
              '<a onclick="return confirm("Are you sure to delete?")" href="/contacts/delete/' +
              element.id +
              '">Delete</a>' +
              "</td>" +
              "</tr>";
            $("#contactTable tbody").append(row_data);
          });
        },
      });
    }, 1000);
  });

  var delay = (function () {
    var timer = 0;
    return function (callback, ms) {
      clearTimeout(timer);
      timer = setTimeout(callback, ms);
    };
  })();

  $('#add_new').click(function () {
    var index_number = parseFloat($('#index_number').val()) +1;

    var new_number = '<div class="panel border pt-2 pb-3 col-md-12">'+
                      '<input type="text" class="form-control col-5 d-inline" name="phone_label['+index_number+'][phone]" placeholder="phone number">  '+
                      '<input type="text" class="form-control col-5 d-inline" name="phone_label['+index_number+'][label]" placeholder="details">'+
                      '<a href="#" class="btn text-success float-right remove_btn d-inline">Delete</a>'+
                    '</div>';
        $('#phoneNumber_list').append(new_number);
        $('#index_number').val(index_number);
    });

    $(document).on('click', '.remove_btn', function (e) {
      $(e.target)
      .parents(".panel")
      .slideUp(1000, function () {
          $(this).remove();
      });
    })
});