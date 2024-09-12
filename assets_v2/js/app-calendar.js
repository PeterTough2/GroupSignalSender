$(function(){
  'use strict'

  // Datepicker found in left sidebar of the page
  var highlightedDays = ['2018-5-10','2018-5-11','2018-5-12','2018-5-13','2018-5-14','2018-5-15','2018-5-16'];
  var date = new Date();

  $('.fc-datepicker').datepicker({
    showOtherMonths: true,
    selectOtherMonths: true,
    dateFormat: 'yy-mm-dd',
    beforeShowDay: function(date) {
      var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
      for (var i = 0; i < highlightedDays.length; i++) {
        if($.inArray(y + '-' + (m+1) + '-' + d,highlightedDays) != -1) {
          return [true, 'ui-date-highlighted', ''];
        }
      }
      return [true];
    }
  });

  var generateTime = function(element) {
    var n = 0,
    min = 30,
    periods = [' AM', ' PM'],
    times = [],
    hours = [12, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11];

    for (var i = 0; i < hours.length; i++) {
      times.push(hours[i] + ':' + n + n + periods[0]);
      while (n < 60 - min) {
        times.push(hours[i] + ':' + ((n += min) < 10 ? 'O' + n : n) + periods[0])
      }
      n = 0;
    }

    times = times.concat(times.slice(0).map(function(time) {
      return time.replace(periods[0], periods[1])
    }));

    //console.log(times);
    $.each(times, function(index, val){
      $(element).append('<option value="'+val+'">'+val+'</option>');
    });
  }

  generateTime('.az-event-time');

  // Initialize fullCalendar
  $('#calendar').fullCalendar({
    header: {
      left: 'prev,next today',
      center: 'title',
      right: 'month,agendaWeek,agendaDay,listWeek'
    },
    navLinks: true,
    selectable: true,
    selectLongPressDelay: 100,
    editable: true,
    nowIndicator: true,
    eventDurationEditable: true,
    durationEditable: true,
    defaultView: 'listMonth',
    views: {
      agenda: {
        columnHeaderHtml: function(mom) {
          return '<span>' + mom.format('ddd') + '</span>' +
                 '<span>' + mom.format('DD') + '</span>';
        }
      },
      day: { columnHeader: false },
      listMonth: {
        listDayFormat: 'ddd DD',
        listDayAltFormat: false
      },
      listWeek: {
        listDayFormat: 'ddd DD',
        listDayAltFormat: false
      },
      agendaThreeDay: {
        type: 'agenda',
        duration: { days: 3 },
        titleFormat: 'MMMM YYYY'
      }
    },
    eventDrop: function(info) {
      //alert(info.title + " was dropped on " + info.start.toISOString());
      var id_x = info.id;
      var start_x = info.start;
      var end_x = info.end;

      console.log("ID:"+id_x+" START: "+start_x+" END: "+end_x);

      if (!confirm("Are you sure about this change?")) {
        revertFunc();
        //info.revertFunc();
      }else {
        //send ajax request...

        //var xstart_x = moment(info.start).format("dddd (d) DDD - D/MM/YY");
        //var xend_x = moment(info.end).format("dddd (d) DDD - D/MM/YY");

        var xstart_x = moment(info.start).unix();
        var xend_x = moment(info.end).unix();

        var request_data_xvs = {
          url: 'update_planboard.php',
          method: 'POST',
          data: {
          plan_id: id_x,
          action: 'update',
          start_date: xstart_x,
          end_date: xend_x
          }
        };

        $.ajax({
        url: request_data_xvs.url,
        type: request_data_xvs.method,
        data: request_data_xvs.data,
        dataType: "json"
        }).done(function (msg) {
          if (msg == 'SESSIONEXPIRED') {
            window.location.href = 'logout.php';
          }
          var status = msg.status;
          var response = msg.data;
          if (status == 'OK') {
            alert(response);
            window.location.href = window.location.href;
          }
          if (status == 'ERROR') {
            alert(response);
            revertFunc();
          }
        }).fail(function(jqXHR, textStatus, errorThrown) {
          alert('<?php echo $lang["Sorry, but an error occurred:"]; ?> '+textStatus+' ('+errorThrown+')');
          revertFunc();
        });

        //send ajax request...
      }
    },
    eventResize: function (event, dayDelta, minuteDelta, revertFunc) {
        /*
        //alert("The end date of " + event.title + "has been moved " + dayDelta + " days and " + minuteDelta + " minutes.");

        if (!confirm("is this okay?")) {
            revertFunc();
        }
        */
    },
    //eventSources: [azCalendarEvents, azBirthdayEvents, azHolidayEvents, azOtherEvents],//data source
    eventSources: [azCalendarEvents],
    eventAfterAllRender: function(view) {
      if(view.name === 'listMonth' || view.name === 'listWeek') {
        var dates = view.el.find('.fc-list-heading-main');
        dates.each(function(){
          var text = $(this).text().split(' ');
          var now = moment().format('DD');

          $(this).html(text[0]+'<span>'+text[1]+'</span>');
          if(now === text[1]) { $(this).addClass('now'); }
        });
      }

      console.log(view.el);
    },
    eventRender: function(event, element) {

      if(event.description) {
        element.find('.fc-list-item-title').append('<span class="fc-desc">' + event.description + '</span>');
        element.find('.fc-content').append('<span class="fc-desc">' + event.description + '</span>');
      }

      var eBorderColor = (event.source.borderColor)? event.source.borderColor : event.borderColor;
      element.find('.fc-list-item-time').css({
        color: eBorderColor,
        borderColor: eBorderColor
      });

      element.find('.fc-list-item-title').css({
        borderColor: eBorderColor
      });

      element.css('borderLeftColor', eBorderColor);
    },
  });

  var azCalendar = $('#calendar').fullCalendar('getCalendar');

  // change view to week when in tablet
  if(window.matchMedia('(min-width: 576px)').matches) {
    azCalendar.changeView('agendaWeek');
  }

  // change view to month when in desktop
  if(window.matchMedia('(min-width: 992px)').matches) {
    azCalendar.changeView('month');
  }

  // change view based in viewport width when resize is detected
  azCalendar.option('windowResize', function(view) {
    if(view.name === 'listWeek') {
      if(window.matchMedia('(min-width: 992px)').matches) {
        azCalendar.changeView('month');
      } else {
        azCalendar.changeView('listWeek');
      }
    }
  });

  // display current date
  var azDateNow = azCalendar.getDate();

  azCalendar.option('select', function(startDate, endDate){
    $('#modalSetSchedule').modal('show');
    $('#azEventStartDate').val(startDate.format('LL'));
    $('#azEventEndDate').val(endDate.format('LL'));

    $('#azEventStartTime').val(startDate.format('LT')).trigger('change');
    $('#azEventEndTime').val(endDate.format('LT')).trigger('change');
  });


  // Display calendar event modal
  azCalendar.on('eventClick', function(calEvent, jsEvent, view){

    var modal = $('#modalCalendarEvent');

    modal.modal('show');
    modal.find('.event-title').text(calEvent.title);
    modal.find('.del_event').attr('plan_id', calEvent.id);//delete btn link
    modal.find('.edit_event').attr('plan_id', calEvent.id);//edit btn link

    //populate data
    $('div.last_view_event_data').attr('plan_id', calEvent.id);
    $('div.last_view_event_data').attr('task_title', calEvent.title);
    $('div.last_view_event_data').attr('detail', calEvent.description);
    $('div.last_view_event_data').attr('priority', calEvent.priority);
    $('div.last_view_event_data').attr('dept', calEvent.dept);
    $('div.last_view_event_data').attr('start_date', calEvent.start);
    $('div.last_view_event_data').attr('end_date', calEvent.end);
    $('div.last_view_event_data').attr('fstart', calEvent.fstart);
    $('div.last_view_event_data').attr('fend', calEvent.fend);
    $('div.last_view_event_data').attr('created_on', calEvent.created_on);
    $('div.last_view_event_data').attr('updated_on', calEvent.updated_on);
    //populate data

    if(calEvent.description) {
      modal.find('.event-desc').text(calEvent.description);
      modal.find('.event-desc').prev().removeClass('d-none');
    } else {
      modal.find('.event-desc').text('');
      modal.find('.event-desc').prev().addClass('d-none');
    }

    modal.find('.event-start-date').text(moment(calEvent.start).format('LLL'));
    modal.find('.event-end-date').text(moment(calEvent.end).format('LLL'));

    //styling
    modal.find('.modal-header').css('backgroundColor', (calEvent.source.borderColor)? calEvent.source.borderColor : calEvent.borderColor);
  });


  // Enable/disable calendar events from displaying in calendar

  $('.az-nav-calendar-event a').on('click', function(e){
    e.preventDefault();
    if($(this).hasClass('exclude')) {
      $(this).removeClass('exclude');

      $(this).is(':first-child')? azCalendar.addEventSource(azCalendarEvents) : '';
      $(this).is(':nth-child(2)')? azCalendar.addEventSource(azBirthdayEvents) : '';
      $(this).is(':nth-child(3)')? azCalendar.addEventSource(azHolidayEvents) : '';
      $(this).is(':nth-child(4)')? azCalendar.addEventSource(azOtherEvents) : '';

    } else {
      $(this).addClass('exclude');

      $(this).is(':first-child')? azCalendar.removeEventSource(1) : '';
      $(this).is(':nth-child(2)')? azCalendar.removeEventSource(2) : '';
      $(this).is(':nth-child(3)')? azCalendar.removeEventSource(3) : '';
      $(this).is(':nth-child(4)')? azCalendar.removeEventSource(4) : '';
    }

    azCalendar.render();

    if(window.matchMedia('(max-width: 575px)').matches) {
      $('body').removeClass('az-content-left-show');
    }
  });


})
