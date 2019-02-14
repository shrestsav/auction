jQuery.fn.extend({
  sumTable : function (settings) {
    var skipFirstCol = (settings["skipFirstColumn"] == true || settings["skipFirstColumn"] == false) ? settings["skipFirstColumn"] : false;
    var totalText = (typeof settings["totalText"] != "undefined") ? settings["totalText"] : "Total";
    var totalClass = (typeof settings["totalClass"] != "") ? settings["totalClass"] : "";
    var tableSize = $.parseHTML($("tbody", this).html().replace(/\s+/g, ''))[0].childElementCount;
    var len = (skipFirstCol == true) ? tableSize - 1 : tableSize;
    var data = new Array(len).fill(0);
    var indexIndent = (skipFirstCol == true) ? 1 : 0;
    var html = "";
    $.each($.parseHTML($("tbody", this).html().replace(/\s+/g, '')), function (index) {
      $.each($.parseHTML($(this).html()), function (index) {
        if (skipFirstCol == true) {
          if (index != 0) {
            data[index - indexIndent] += parseFloat($(this).html());
          }
        } else {
          data[index - indexIndent] += parseFloat($(this).html());
        }
      });
    });
    $.each(data, function (index) {
      html += "<td>" + data[index] + "</td>";
    });
    $(this).append(
      (skipFirstCol == true) ? "<tr class='" + totalClass + "'><td>" + totalText + "</td>" + html + "</tr>" : "<tr>" + html + "</tr>"
    );
  }
});
