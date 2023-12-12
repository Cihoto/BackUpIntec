async function FormatEventsForCalendar(status){
    const events = await (GetCalendarProjects(EMPRESA_ID,status));
    let calendarEventObj = [];

    events.forEach(element => {
      
      // console.log(element.id);
      let color = "white";
      let textColor = "black";
      if (element.estado === 'creado') {
        color = "yellow";
        let textColor = "black";

      }
      if (element.estado === 'confirmado') {
        color = "green";
        let textColor = "white";

      }
      if (element.estado === 'finalizado') {
        color = "blue";
        let textColor = "white";

      }

      calendarEventObj.push({
        id: element.id,
        title: element.nombre_proyecto,
        start: element.fecha_inicio,
        end: element.fecha_termino,
        color: color,
        textColor: textColor
      })

    });
    return calendarEventObj;
  }
  
  async function RenderCalendar(status){
    const events = await FormatEventsForCalendar(status);
      calendar = new FullCalendar.Calendar(calendarEl, {
      height: 590,
      eventClick: function(info) {
        // ViewResume(projectId)
        console.log(`ID ${info.event.id}`);
        ViewResume(info.event.id);
        // alert('Event: ' + info.event.title);
        // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
        // alert('View: ' + info.view.type);
        // change the border color just for fun
        // info.el.style.borderColor = 'red';
      },
      events: events
      })
      
      calendar.render();
  }

  async function FillCalendar(status){
    if(!calendarEl.children.length > 0){
      RenderCalendar(status);
    }else{
      calendar.destroy();
      RenderCalendar(status);
    }
  }