$(document).ready(function() {

    $('#datepicker').Zebra_DatePicker();
    $('#datepicker2').Zebra_DatePicker();
    $('#datepicker3').Zebra_DatePicker();
    $('#datepicker4').Zebra_DatePicker();
    $('#datepicker5').Zebra_DatePicker({
        pair: $('#datepicker-range-end')
    });
    $('#datepicker6').Zebra_DatePicker();

    $('#datepicker-future-tomorrow').Zebra_DatePicker({
        direction: 1
    });

    $('#datepicker-dynamic-interval').Zebra_DatePicker({
        direction: [1, 10]  
    });

    $('#datepicker-dates-interval').Zebra_DatePicker({
        direction: ['2012-08-01', '2012-08-12']
    });

    $('#datepicker-after-date').Zebra_DatePicker({
        direction: ['2018-06-01', false]
    });

    $('#datepicker-disabled-dates').Zebra_DatePicker({
        direction: true,
        disabled_dates: ['* * * 5,6']
    });

    $('#datepicker-range-start').Zebra_DatePicker({
        direction: false,
        pair: $('#datepicker-range-end')
    });

    $('#datepicker-range-end').Zebra_DatePicker({
        direction: 1
    });

    $('#datepicker-formats').Zebra_DatePicker({
        format: 'M d, Y'
    });

    $('#datepicker-time').Zebra_DatePicker({
        format: 'Y-m-d H:i'
    });
    $('#datepicker-time2').Zebra_DatePicker({
        format: 'Y-m-d H:i'
    });
    $('#datepicker-time3').Zebra_DatePicker({
        format: 'Y-m-d H:i'
    });
    $('#datepicker-time4').Zebra_DatePicker({
        format: 'Y-m-d H:i'
    });

    $('#datepicker-week-number').Zebra_DatePicker({
        show_week_number: 'Wk'
    });

    $('#datepicker-starting-view').Zebra_DatePicker({
        view: 'years'
    });

    $('#datepicker-partial-date-formats').Zebra_DatePicker({
        format: 'm Y'
    });

    $('#datepicker-custom-classes').Zebra_DatePicker({
        disabled_dates: ['* * * 0,6'],
        custom_classes: {
            'myclass':  ['* * * 0,6']
        }
    });

    $('#datepicker-on-change').Zebra_DatePicker({
        onChange: function(view, elements) {
            if (view === '') {
                elements.each(function() {
                    if ($(this).data('date').match(/\-24$/))
                        $(this).css({
                            background: '#C40000',
                            color:      '#FFF'
                        });
                });
            }
        }
    });

    $('#datepicker-always-visible').Zebra_DatePicker({
        always_visible: $('#container')
    });

    $('#datepicker-data-attributes').Zebra_DatePicker();


    setTimeout(function() {
        $.Zebra_Pin($('blockquote.bg-warning'));
    }, 500);

});