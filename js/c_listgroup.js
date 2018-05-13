/**
 * Created by imesh on 2017-05-06.
 */
$(function () {
    $('.list-group.checked-list-box .list-group-item').each(function () {

        // Settings
        var $widget = $(this),
            $checkbox = $('<input type="checkbox" class="hidden" />'),
            color = ($widget.data('color') ? $widget.data('color') : "primary"),
            style = ($widget.data('style') == "button" ? "btn-" : "list-group-item-"),
            settings = {
                on: {
                    icon: 'glyphicon glyphicon-check'
                },
                off: {
                    icon: 'glyphicon glyphicon-unchecked'
                }
            };

        $widget.css('cursor', 'pointer')
        $widget.append($checkbox);

        // Event Handlers
        $widget.on('click', function () {
            $checkbox.prop('checked', !$checkbox.is(':checked'));
            $checkbox.triggerHandler('change');
            updateDisplay();
        });
        $checkbox.on('change', function () {
            updateDisplay();
        });


        // Actions
        function updateDisplay() {
            var isChecked = $checkbox.is(':checked');

            // Set the button's state
            $widget.data('state', (isChecked) ? "on" : "off");

            // Set the button's icon
            $widget.find('.state-icon')
                .removeClass()
                .addClass('state-icon ' + settings[$widget.data('state')].icon);

            // Update the button's color
            if (isChecked) {
                $widget.addClass(style + color + ' activex');
            } else {
                $widget.removeClass(style + color + ' activex');
            }
        }

        // Initialization
        function init() {

            if ($widget.data('checked') == true) {
                $checkbox.prop('checked', !$checkbox.is(':checked'));
            }

            updateDisplay();

            // Inject the icon if applicable
            if ($widget.find('.state-icon').length == 0) {
                $widget.prepend('<span class="state-icon ' + settings[$widget.data('state')].icon + '"></span>');
            }
        }

        init();
    });

    $(document).ready(function () {
        $('#btn-sub').on('click', function (event) {
            event.preventDefault();
            var checkedItems = {}, counter = 0;
            $("#check-list-box li.activex").each(function (idx, li) {
                checkedItems[counter] = $(li).val();
                counter++;
            });
            var vChkBrd = JSON.stringify(checkedItems, null, '\t');

            $.ajax({
                type: 'post',
                url: 'BackEnd/processLocSug.php',
                data: {
                    lChkBirds: vChkBrd
                },
                success: function (response) {
                    var locArray = $.parseJSON(response);
                    $('path').removeClass('lSelected');

                    locArray.forEach(function (locID) {
                        //alert(locID);
                        var sugLoc = "#ls" +locID;
                        $(sugLoc).addClass('lSelected');
                    });
                }
            });

        });
    });

});