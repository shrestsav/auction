function showNotify(type,message){
    if(type=='success')
      var icon = 'glyphicon glyphicon-ok';
    else if(type=='danger')
      var icon = 'glyphicon glyphicon-warning-sign';

    $.notify({
      // options
      icon: icon,
      message: message 
    },{
      // settings
      type: type,
      placement: {
        from: "bottom",
        align: "right"
      },
      z_index: 1300,
      template: '<div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">' +
                '<button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>' +
                '<span data-notify="icon"></span> ' +
                '<span data-notify="title">{1}</span> ' +
                '<span data-notify="message">&nbsp;&nbsp;&nbsp;{2}</span>' +
                '<div class="progress" data-notify="progressbar">' +
                  '<div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                '</div>' +
                '<a href="{3}" target="{4}" data-notify="url"></a>' +
                '</div>' 
    });
}