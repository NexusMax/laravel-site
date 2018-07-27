
$("#range-level").ionRangeSlider({
    type: "double",
    from: (rangevalue)? rangevalue: 1,
    hide_min_max: true,
    grid: false,
    values: [
        "плохое", "хорошее", "отличное"
    ]
});


$("#health-level").ionRangeSlider({
    type: "double",
    from: (healhvalue)? healhvalue: 1,
    hide_min_max: true,
    grid: false,
    values: [
        "плохое", "хорошее", "отличное"
    ]
});

$("#range-experience").ionRangeSlider({
    type: "double",
    from: (expvalue)? expvalue:1,
    hide_from_to: true,
    grid: false,
    values: [
        "0 лет", "3 года", "6 лет"
    ]
});

$("#training-levels-range1").ionRangeSlider({
    type: "double",
    from: 1,
    hide_from_to: true,
    grid: false,
    values: [
        "очень легко", "", "очень тяжело"
    ]
});

$("#training-levels-range2").ionRangeSlider({
    type: "double",
    from: 1,
    hide_from_to: true,
    grid: false,
    values: [
        "утомления нет", "умеренно устал", "устал до отказа"
    ]
});

$('.training-trigger').on('click', function (e) {
    e.preventDefault();
    var trainTrigger = $('.training-trigger');
    if (trainTrigger.hasClass('active')) {
        trainTrigger.removeClass('active');
        trainTrigger.closest('.training-wrapper-heading').find('span').removeClass('active');
        trainTrigger.closest('.training-holder').find('.training-wrapper-body').slideUp('active');
    } else {
        trainTrigger.addClass('active');
        trainTrigger.closest('.training-wrapper-heading').find('span').addClass('active');
        trainTrigger.closest('.training-holder').find('.training-wrapper-body').slideDown('active');
    }
});

$('.constructor-step-wrap').on('click', function () {
    $(this).find('.constructor-label').addClass('1sdf23')
});

$('.cattegory-item-click').on('click', function() {
    if ( $(this).hasClass('active') ) {
        $(this).removeClass('active');
    } else {
        $('.cattegory-item-click').removeClass('active');
        $(this).addClass('active');
    }
});
