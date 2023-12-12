let _all_my_selected_schedules = [];
let total_incomplete_schedules = 0;
let total_schedules = 0;
let schedule_id = 1;

$('#createNewSchedule').on('click',function(){
    schedule_id ++
    let scheduleContainer = `<div class="schedule-item incomplete" schedule_id="${schedule_id}" >
        <div class="schedule-data">
            <img src="../assets/svg/editPencil.svg" alt="">
            <input type="text" class="detail" placeholder="desc">
            <input type="time" class="hour" name="appt"/>
        </div>
    </div>`;
    $('#schedule-container').append(scheduleContainer);
    checkAllIfScheduleDataIsComplete();
}) 

$(document).on('blur','.detail',function(){
    checkOneGivenScheduleOfDataIsComplete($(this).closest('.schedule-item'))
})
$(document).on('blur','.hour',function(){
    checkOneGivenScheduleOfDataIsComplete($(this).closest('.schedule-item'))
});

function checkAllIfScheduleDataIsComplete(){
    total_incomplete_schedules = 0;
    $('.schedule-item').each((key,element)=>{

        let schedule_desc = $(element).find('.detail').val(); 
        let schedule_hour_input = $(element).find('.hour')[0];
        const HOUR = schedule_hour_input.value;

        if(schedule_desc === "" || HOUR === ""){
            $(element).addClass('incomplete');
            total_incomplete_schedules++
        }
        if(schedule_desc !== "" && HOUR !== ""){
            $(element).removeClass('incomplete');
        }
    })
}

function checkOneGivenScheduleOfDataIsComplete(element){
    let schedule_desc = $(element).find('.detail').val(); 
    let schedule_hour_input = $(element).find('.hour')[0];
    const HOUR = schedule_hour_input.value;
    
    if(schedule_desc === "" || HOUR === ""){
        $(element).addClass('incomplete');
    }
    if(schedule_desc !== "" && HOUR !== ""){
        $(element).removeClass('incomplete');
        total_incomplete_schedules--
        _all_my_selected_schedules.push({
            'schedule_id' : $(element).attr('schedule_id'),
            'schedule_detail' : schedule_desc,
            'schedule_hour' : HOUR
        });
    }  
}


function printAllMyEventSchedules(){
    let ALL_MY_DOM_SCHEDULES = $('.schedule-item');

    const postAllmydom = ALL_MY_DOM_SCHEDULES.sort((a,b)=>{
        let schedule_hour_input_1 = $(a).find('.hour')[0];
        const HOUR = schedule_hour_input_1.value
        console.log()
        let schedule_hour_input_2 = $(b).find('.hour')[0];
        const HOUR2 = schedule_hour_input_2.value
        return HOUR < HOUR2 
    });
}