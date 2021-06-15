
function modify(id){
  var building = id.parent().parent();
  var name = building.attr('id').replace('building_','');
  var building_l = building.children(":first");
  var building_r = building.children(":last");
  var addrs = [];
  building_r.children(".address_div").find('.address').each(function(){
    addrs.push($(this).text());
  });
  building.hide();
  $.ajax({
    url: "agent.php",
    type: "POST",
    data: {
      action: 'modify',
      building_data: [{"building_id": name,
              "name":  building_l.children('.build_name').text(),
              "open":  building_l.children().find('.open').text(),
              "close": building_l.children().find('.close').text(),
              "job_length": building_l.children('.length').text().slice(12,-6),
              "techs": building_l.children('.techs').text().slice(14),
              "aon": building_l.children('.badge_div').children('.aon').attr('data-aon'),
              "switch": building_l.children('.switch').text(),
              "bulk": building_l.children('.badge_div').children('.bulk').attr('data-bulk'),
              "panel": building_l.children('.badge_div').children('.panel').attr('data-panel'),
              "panel_loc": building_l.children('.panel_loc').text(),
              "unit_type": building_l.children('.badge_div').children().attr('data-type'),
              "notes": building_l.children('.notes').text(),
            }],
      addr_data: addrs,
    },
    success: function(data){
      $('#show').html(data);
      $('.type').click(function(){
        if ($(this).attr('data-type') == 'MDU'){
          $(this).text("MDU-SA");
          $(this).attr('data-type', 'MDU-SA');
        }
        else if ($(this).attr('data-type') == 'MDU-SA'){
          $(this).text("SFU");
          $(this).attr('data-type', 'SFU');
        }
        else if ($(this).attr('data-type') == 'SFU'){
          $(this).text("MDU");
          $(this).attr('data-type', 'MDU');
        }
      });
      $(".aon").click(function(){
        if ($(this).attr('data-aon') == 0) {
          $(this).attr("data-aon", "1");
          $(this).parent().parent().find('[name="switch"]').show();
          $(this).parent().parent().find('[name="switch_label"]').show();
        }
        else{
          $(this).attr("data-aon", 0);
          $(this).parent().parent().find('[name="switch"]').hide();
          $(this).parent().parent().find('[name="switch_label"]').hide();
        }
      });
      $(".bulk").click(function(){
        if ($(this).attr('data-bulk') == 0) {
          $(this).attr("data-bulk", "1");
        }
        else{
          $(this).attr("data-bulk", 0);
        }
      });
      $(".panel").click(function(){
        if ($(this).attr('data-panel') == 0) {
          $(this).attr("data-panel", "1");
          $(this).parent().parent().find('[name="panel_label"]').show();
          $(this).parent().parent().find('[name="panel_loc"]').show();
        }
        else{
          $(this).attr("data-panel", 0);
          $(this).parent().parent().find('[name="panel_loc"]').hide();
          $(this).parent().parent().find('[name="panel_label"]').hide();
        }
      });
      $(".update_btn").click(function(){
        update($(this).parent());
        });
      $(".delete_btn").click(function(){
        del($(this).parent());
        });
      }
  });
}

function pull(){
  var search = $("#search").val();
  $.ajax({
    url: "agent.php",
    type: "GET",
    data: {
      search: search,
    },
    success: function(data){
      $("#show").html(data);
      $(".modify_btn").click(function(){
        modify($(this));
      });
    }
  });
}

function update(id){
  var building = id.parent().parent();
  var name = building.attr('id').replace('edit_','');
  var building_l = building.children(':first');
  var building_r = building.children(':last');
  var addrs = [];
  building_r.children(".address_div").children('.streets_div').each(function(){
    $(this).children(".address").each(function(){
      addrs.push($(this).val());
    });
  });
  building_r.children(".address_div").children('.address').each(function(){
      addrs.push($(this).val());
  });
  $.ajax({
    url: "agent.php",
    type: "POST",
    data: {
      action: 'update',
      building_data: [{"building_id": name,
              "name":  building_l.children('[name="build_name"]').val(),
              "open":  building_l.children('[name="open"]').val(),
              "close": building_l.children('[name="close"]').val(),
              "job_length": building_l.children('[name="length"]').val(),
              "techs": building_l.children('[name="techs"]').val(),
              "aon": building_l.children('.badge_div').children('.aon').attr('data-aon'),
              "switch": building_l.children('[name="switch"]').val(),
              "bulk": building_l.children('.badge_div').children('.bulk').attr('data-bulk'),
              "panel": building_l.children('.badge_div').children('.panel').attr('data-panel'),
              "unit_type": building_l.children('.badge_div').find('.type').attr('data-type'),
              "panel_loc": building_l.children('[name="panel_loc"]').val(),
              "notes": building_l.children('[name="notes"]').val()
            }],
      addr_data: addrs,
    },
    success: function(){
      var search = $("#search").val();
      $.ajax({
        url: "agent.php",
        type: "GET",
        data: {
          search: search,
        },
        success: function(data){
          $("#show").html(data);
          $(".modify_btn").click(function(){
            modify($(this));
          });
        }
      });
    }
  });
}

function modifynew(){
  $.ajax({
    url: "agent.php",
    type: "POST",
    data: {
      action: 'modify',
      building_data: [{"building_id": "new",
              "name":  "",
              "open":  "8am",
              "close": "8pm",
              "job_length": "",
              "techs": "",
              "aon": 0,
              "switch": "",
              "bulk": 0,
              "panel": 0,
              "panel_loc": "",
              "unit_type": 'MDU',
              "notes": "",
            }],
      addr_data: [' '],
    },
    success: function(data){
      $('#show').html(data);
      $('.type').click(function(){
        if ($(this).attr('data-type') == 'MDU'){
          $(this).text("MDU-SA");
          $(this).attr('data-type', 'MDU-SA');
        }
        else if ($(this).attr('data-type') == 'MDU-SA'){
          $(this).text("SFU");
          $(this).attr('data-type', 'SFU');
        }
        else if ($(this).attr('data-type') == 'SFU'){
          $(this).text("MDU");
          $(this).attr('data-type', 'MDU');
        }
      });
      $(".aon").click(function(){
        if ($(this).attr('data-aon') == 0) {
          $(this).attr("data-aon", "1");
          $(this).parent().parent().find('[name="switch"]').show();
          $(this).parent().parent().find('[name="switch_label"]').show();
        }
        else{
          $(this).attr("data-aon", 0);
          $(this).parent().parent().find('[name="switch"]').hide();
          $(this).parent().parent().find('[name="switch_label"]').hide();
        }
      });
      $(".bulk").click(function(){
        if ($(this).attr('data-bulk') == 0) {
          $(this).attr("data-bulk", "1");
        }
        else{
          $(this).attr("data-bulk", 0);
        }
      });
      $(".panel").click(function(){
        if ($(this).attr('data-panel') == 0) {
          $(this).attr("data-panel", "1");
          $(this).parent().parent().find('[name="panel_label"]').show();
          $(this).parent().parent().find('[name="panel_loc"]').show();
        }
        else{
          $(this).attr("data-panel", 0);
          $(this).parent().parent().find('[name="panel_loc"]').hide();
          $(this).parent().parent().find('[name="panel_label"]').hide();
        }
      });
      $(".update_btn").click(function(){
        update($(this).parent());
        });
      $(".delete_btn").click(function(){
        del($(this).parent());
        });
      }
  });
}

function del(id){
  var building = id.parent().parent();
  var name = building.attr('id').replace('edit_','');
  $.ajax({
    url: "agent.php",
    type: "POST",
    data: {
      action: 'delete',
      building_id: name,
    },
    success: function(){
      var search = $("#search").val();
      $.ajax({
        url: "agent.php",
        type: "GET",
        data: {
          search: search,
        },
        success: function(data){
          $("#show").html(data);
          $(".modify_btn").click(function(){
            modify($(this));
          });
        }
      });
    }
  });
}

function add_addr(){
  $(".address_div").append('<input class="address" type="text" maxlength="64"><br>');
}

$(document).on('change', '#search', function(){
  pull();
});

$(document).on('click', '#create', function(){
  modifynew();
});

$(document).on("click", "#insert", function(){
  var building = $(this).parent().parent().parent();
  var building_l = building.children(':first');
  var building_r = building.children(':last');
  console.log(building_l.children('[name="build_name"]').val());
  var addrs = [];
  building_r.children(".address_div").children('.streets_div').each(function(){
    $(this).children(".address").each(function(){
      addrs.push($(this).val());
    });
  });
  building_r.children(".address_div").children('.address').each(function(){
      addrs.push($(this).val());
  });
  $.ajax({
    url: "agent.php",
    type: "POST",
    data: {
      action: "create",
      building_data: [{"name":  building_l.children('[name="build_name"]').val(),
              "open":  building_l.children('[name="open"]').val(),
              "close": building_l.children('[name="close"]').val(),
              "job_length": building_l.children('[name="length"]').val(),
              "techs": building_l.children('[name="techs"]').val(),
              "aon": building_l.children('.badge_div').children('.aon').attr('data-aon'),
              "switch": building_l.children('[name="switch"]').val(),
              "bulk": building_l.children('.badge_div').children('.bulk').attr('data-bulk'),
              "panel": building_l.children('.badge_div').children('.panel').attr('data-panel'),
              "unit_type": building_l.children('.badge_div').find('.type').attr('data-type'),
              "panel_loc": building_l.children('[name="panel_loc"]').val(),
              "notes": building_l.children('[name="notes"]').val()
            }],
      addr_data: addrs,
    },
    success: function(){
      var search = $("#search").val();
      $.ajax({
        url: "agent.php",
        type: "GET",
        data: {
          search: search,
        },
        success: function(data){
          $("#show").html(data);
          $(".modify_btn").click(function(){
            modify($(this));
          });
        }
      });
    }
  });
});
