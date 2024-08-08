(function ($) {
  //module menu adding control
  $("#add-custom-menu").click(function (e) {
    const customMenu = $("#custom-menu-name");
    const menuName = customMenu.val();
    const url = $("#custom-menu-url");
    const menuUrl = url.val();
    if (menuName.length <= 0) {
      alert("Menu field must not empty!");
      customMenu.focus();
    }
    const makeMenu = $(".make_menu");
    makeMenu.find(".showName").html(menuName);
    makeMenu.find(".menu-item").attr("menu-name", menuName).attr("menu-title", menuName).attr("menu-type", "external").val(menuUrl);
    makeMenu.find(".menu-name").attr("value", menuName);
    makeMenu.find(".menu-url").attr("value", menuUrl);
    makeMenu.find(".menu-title").attr("value", menuName);

    const item = makeMenu.html();
    $("#menu").append(item);
    customMenu.val("").focus();
    url.val("");
    makeMenu.find(".menu-item").attr("menu-type", "internal");
  });

  $(document).on("click", "span.delete", function (e) {
    $(this).closest("li").empty().hide();
  });
  $(document).on("click", "span.edit", function (e) {
    $(this).closest("li").find(".menu-edit-form").delay(500).toggleClass("hide");
  });

  $(document).on("click", "#menu .btnUpdate", function (e) {
    const menuName = $(this).closest(".menu-edit-form").find(".menu-name").val();
    const MenuUrl = $(this).closest(".menu-edit-form").find(".menu-url").val();
    const menuClass = $(this).closest(".menu-edit-form").find(".menu-class").val();
    const menuTitle = $(this).closest(".menu-edit-form").find(".menu-title").val();
    const menuIcon = $(this).closest(".menu-edit-form").find(".menu-icon").val();
    const menuCheck = $(this).closest(".menu-edit-form").find(".new-tab").is(':checked');
    $(this).closest("li.item").find(".showName").html(menuName);
    $(this).closest("li.item").find(".menu-item").attr("menu-name", menuName).attr("menu-class", menuClass).attr("menu-title", menuTitle).attr("menu-icon", menuIcon).val(MenuUrl);
    if (menuCheck) {
      $(this).closest("li.item").find(".menu-item", 1);
    }
    $("#menu").find(".menu-edit-form").addClass("hide");
  });


  $("#save-menu").click(function () {
    const dataValue = [];
    $("#menu .menu-item").each(function () {
      const menu_name = $(this).attr("menu-name");
      const menu_class = $(this).attr("menu-class");
      const menu_title = $(this).attr("menu-title");
      const menu_window = $(this).siblings(".menu-edit-form").find(".new-tab").val();
      const menu_icon = $(this).attr("menu-icon");
      const menu_type = $(this).attr("menu-type");
      const menu_id = $(this).attr("menu-id");
      const menu_url = $(this).val();
      const arrData = {
        menu_id: menu_id,
        name: menu_name,
        url: menu_url,
        menu_class: menu_class,
        menu_title: menu_title,
        menu_window: menu_window,
        menu_icon: menu_icon,
        menu_type: menu_type,
      };
      dataValue.push(arrData);
    });

    const group = $("#group").val();
    const parent = $("#parent").val();

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: 'post',
      url: '/add-to-front-menu',
      data: {dataKey: dataValue, parent_id: parent, group_id: group},
      success: function (data) {
        console.log(data);
        location.reload(true);
      }
    });

  });


// default load menus
  const group = $("#group");
  const parent = $("#parent");
  get_active_menus(group.val(), parent.val());

  $("#find").click(function (e) {
    get_active_menus(group.val(), parent.val());
  });

  // group change action
  // group.change(function (e) {
  //   get_active_menus($(this).val(), parent.val());
  // });


})(jQuery);


function get_active_menus(group_id, parent_id, refresh = false) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  $.ajax({
    type: 'post',
    url: '/get-active-menus',
    data: {group_id: group_id, parent_id: parent_id},
    success: function (data) {
      if (refresh) {
        location.reload(true);
      }
      $("#menu").html(data);
    }
  });
}
