// Trash Inbox JS
function mouseover(id, st) {
  $(".trash-icon_" + id).removeClass("d-none");
  $(".trash-date_" + id).addClass("d-none");
  $(".trash-checkbox_" + id).attr(
    "style",
    "box-shadow: 2px 2px 2px rgba(99, 99, 99, 0.8);border: #969696 solid 1px;"
  );
  st == 1
    ? $(".unread_" + id).removeClass("d-none")
    : $(".reader_" + id).removeClass("d-none");
}

function mouseout(id, st) {
  $(".trash-icon_" + id).addClass("d-none");
  $(".trash-date_" + id).removeClass("d-none");
  $(".trash-checkbox_" + id).removeAttr(
    "style",
    "box-shadow: 2px 2px 2px rgba(99, 99, 99, 0.8);border: #969696 solid 1px;"
  );
}
$(".checkbox_all").change(function () {
  $(".checkbox_trash").prop("checked", $(this).prop("checked"));
  $(".list-listan").attr("style", "cursor:pointer;");
  let vals = $(".checkbox_trash");
  if ($(this).prop("checked")) {
    for (var i = 0; i < vals.length; i++) {
      if (vals[i].value == 2) {
        $(".read-list").addClass("bg-background");
      }
    }
    $(".btn-trash").removeClass("d-none");
    $(".list-listan").attr(
      "style",
      "border: #969696 solid 1px; box-shadow: 2px 2px 2px rgba(99, 99, 99, 0.8); z-index: 200;cursor:pointer;background-color: #C2DBFF !important;border-left:#000 1px solid"
    );
  } else {
    for (var i = 0; i < vals.length; i++) {
      if (vals[i].value == 2) {
        $(".read-list").addClass("bg-background");
      }
    }
    $(".btn-trash").addClass("d-none");
    $(".list-listan").removeAttr(
      "style",
      "border: #969696 solid 1px; box-shadow: 2px 2px 2px rgba(99, 99, 99, 0.8); z-index: 200;background-color: #C2DBFF !important;"
    );
    $(".list-listan").attr(
      "style",
      "cursor:pointer;border-left:#000 1px solid"
    );
    $(".read-l").attr(
      "style",
      "background: #F4F7F6 !important; color: #403e3e !important;"
    );
  }
});

function checklistItem(e) {
  if ($(".trash-checkbox_" + e).is(":checked")) {
    $(".btn-trash").removeClass("d-none");
    $(".list-listan_" + e).attr(
      "style",
      "border: #969696 solid 1px; box-shadow: 2px 2px 2px rgba(99, 99, 99, 0.8); z-index: 200;cursor:pointer;background-color: #C2DBFF !important;border-left:#000 1px solid"
    );
    $(".read-list_" + e).attr(
      "style",
      "border: #969696 solid 1px; box-shadow: 2px 2px 2px rgba(99, 99, 99, 0.8); z-index: 200;cursor:pointer;background-color: #C2DBFF !important;border-left:#000 1px solid"
    );
  } else {
    $(".btn-trash").addClass("d-none");
    $(".list-listan_" + e).removeAttr(
      "style",
      "border: #969696 solid 1px; box-shadow: 2px 2px 2px rgba(99, 99, 99, 0.8); z-index: 200;background-color: #C2DBFF !important;"
    );
    $(".list-listan_" + e).attr(
      "style",
      "cursor:pointer;border-left:#000 1px solid"
    );
    $(".read-list_" + e).attr(
      "style",
      "background: #F4F7F6 !important; color: #403e3e !important;"
    );
  }
}
$(".checkbox_trash").on("change", function () {
  let valtot = $(".checkbox_trash").length;
  let val = $(".checkbox_trash").filter(":checked").length;
  if (val == valtot) {
    $(".checkbox_all").prop("checked", $(this).prop("checked"));
  } else {
    $(".checkbox_all").prop("checked", false);
  }
});

// DELETE ALL TRASH ITEM JS
function DeleteAll() {
  swal(
    {
      title: "Confirm deleting messages",
      text: "This action will affect the one conversation in Trash. Are you sure you want to continue?",
      type: "info",
      showCancelButton: true,
      closeOnConfirm: false,
      showLoaderOnConfirm: true,
    },
    function () {
      $.ajax({
        url: "./helper/_inbox.php?type=trash&query=delete",
        type: "post",
        data: {
          data: "all",
        },
        success: function (d) {
          setTimeout(function () {
            swal(
              {
                title: "Deleted!",
                text: "Trash has been successfully removed!",
                type: "success",
                showCancelButton: false,
              },
              function () {
                location.reload();
              }
            );
          }, 2000);
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
          setTimeout(function () {
            swal(
              {
                title: "Error!",
                text: "Request Error!",
                type: "error",
                showCancelButton: false,
              },
              function () {
                location.reload();
              }
            );
          }, 2000);
        },
      });
    }
  );
}
function deleteItem() {
  var id = $(".checkbox_trash:checked")
    .map(function () {
      return $(this).val();
    })
    .get()
    .join(" ");
  if (id) {
    $.ajax({
      url: "./helper/_inbox.php?type=trash&query=delete",
      type: "post",
      data: {
        data: id,
      },
      success: function (d) {
        setTimeout(function () {
          swal(
            {
              title: "Deleted!",
              text: "Conversation deleted forever!",
              type: "success",
              showCancelButton: false,
            },
            function () {
              location.reload();
            }
          );
        }, 2000);
      },
      error: function (XMLHttpRequest, textStatus, errorThrown) {
        setTimeout(function () {
          swal(
            {
              title: "Error!",
              text: "Request Error!",
              type: "error",
              showCancelButton: false,
            },
            function () {
              location.reload();
            }
          );
        }, 2000);
      },
    });
  } else {
    swal(
      {
        title: "Error!",
        text: "Please select at least one item to delete!",
        type: "error",
        showCancelButton: false,
      },
      function () {
        location.reload();
      }
    );
  }
}

function changeReadUnread(id, stat) {
  $.ajax({
    url: "./helper/_inbox.php?type=trash&query=update",
    type: "post",
    data: {
      data: id,
      status: stat,
    },
    success: function (d) {
      if (stat == "1") {
        $text = "Unread";
      } else {
        $text = "Read";
      }

      swal(
        {
          title: "Success!",
          text: "Conversation update to " + $text + "!",
          type: "success",
          showCancelButton: false,
        },
        function () {
          location.reload();
        }
      );
    },
    error: function (XMLHttpRequest, textStatus, errorThrown) {
      swal(
        {
          title: "Error!",
          text: "Request Error!",
          type: "error",
          showCancelButton: false,
        },
        function () {
          location.reload();
        }
      );
    },
  });
}
