@extends('_main_layout')

@section('content')
<style>
        /*basic reset*/
        * {margin: 0; padding: 0;}

        html {
            height: 100%;
            /*Image only BG fallback*/
            background: #e9e9e9;
        }

        body {
            font-family: montserrat, arial, verdana;
            width: 100%;
            overflow-x: hidden;
        }
        /*form styles*/
        .steps {
            width: 675px;
            margin: 50px auto;
            position: relative;
        }

        .steps fieldset {
            background: white;
            border: 0 none;
            border-radius: 3px;
            box-shadow: 0 17px 41px -21px rgb(0, 0, 0);
            padding: 20px 30px;
            border-top: 9px solid #7B1FA2;
            box-sizing: border-box;
            width: 80%;
            margin: 0 10%;

            /*stacking fieldsets above each other*/
            position: absolute;
        }
        /*Hide all except first fieldset*/
        .steps fieldset:not(:first-of-type) {
            display: none;
        }
        /*inputs*/
        .steps label{
            color: #333333;
            text-align: left !important;
            font-size: 15px;
            font-weight: 200;
            padding-bottom: 7px;
            padding-top: 12px;
            display: inline-block;
        }


        .steps input, .steps textarea {
            outline: none;
            display: block;
            width: 100%;
            margin: 0 0 20px;
            padding: 10px 15px;
            border: 1px solid #d9d9d9;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            color: #837E7E;
            font-family: "Roboto";
            -webkti-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            font-size: 14px;
            font-wieght: 400;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            -webkit-transition: all 0.3s linear 0s;
            -moz-transition: all 0.3s linear 0s;
            -ms-transition: all 0.3s linear 0s;
            -o-transition: all 0.3s linear 0s;
            transition: all 0.3s linear 0s;
        }

        .steps input:focus, .steps textarea:focus{
            color: #333333;
            border: 1px solid #7B1FA2;
        }

        .error1{
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px;
            -moz-box-shadow: 0 0 0 transparent;
            -webkit-box-shadow: 0 0 0 transparent;
            box-shadow: 0 0 0 transparent;
            position: absolute;
            left: 525px;
            margin-top: -58px;
            padding: 0 10px;
            height: 39px;
            display: block;
            color: #ffffff;
            background: #e62163;
            border: 0;
            font: 14px Corbel, "Lucida Grande", "Lucida Sans Unicode", "Lucida Sans", "DejaVu Sans", "Bitstream Vera Sans", "Liberation Sans", Verdana, "Verdana Ref", sans-serif;
            line-height: 39px;
            white-space: nowrap;

        }

        .error1:before{
            width: 0;
            height: 0;
            left: -8px;
            top: 14px;
            content: '';
            position: absolute;
            border-top: 6px solid transparent;
            border-right: 8px solid #e62163;
            border-bottom: 6px solid transparent;
        }

        .error-log{
            margin: 5px 5px 5px 0;
            font-size: 19px;
            position: relative;
            bottom: -2px;
        }

        .question-log {
            margin: 5px 1px 5px 0;
            font-size: 15px;
            position: relative;
            bottom: -2px;
        }

        /*buttons*/
        .steps .action-button, .action-button {
            width: 100px !important;
            background: #7B1FA2;
            font-weight: bold;
            color: white;
            border: 0 none;
            border-radius: 1px;
            cursor: pointer;
            padding: 10px 5px;
            margin: 10px auto;
            -webkit-transition: all 0.3s linear 0s;
            -moz-transition: all 0.3s linear 0s;
            -ms-transition: all 0.3s linear 0s;
            -o-transition: all 0.3s linear 0s;
            transition: all 0.3s linear 0s;
            display: block;
        }

        .steps .next, .steps .submit{
            float: right;
        }

        .steps .previous{
            float:left;
        }

        .steps .action-button:hover, .steps .action-button:focus, .action-button:hover, .action-button:focus {
            background:#9F2AD0;;
        }

        .steps .explanation{
            display: block;
            clear: both;
            width: 540px;
            background: #f2f2f2;
            position: relative;
            margin-left: -30px;
            padding: 22px 0px;
            margin-bottom: -10px;
            border-bottom-left-radius: 3px;
            border-bottom-right-radius: 3px;
            top: 10px;
            text-align: center;
            color: #333333;
            font-size: 12px;
            font-weight: 200;
            cursor:pointer;
        }


        /*headings*/
        .fs-title {
            text-transform: uppercase;
            margin: 0 0 5px;
            line-height: 1;
            color: #7B1FA2;
            font-size: 18px;
            font-weight: 400;
            text-align:center;
        }
        .fs-subtitle {
            font-weight: normal;
            font-size: 13px;
            color: #837E7E;
            margin-bottom: 20px;
            text-align: center;
        }
        /*progressbar*/
        #progressbar {
            margin-bottom: 30px;
            overflow: hidden;
            /*CSS counters to number the steps*/
            counter-reset: step;
            width:100%;
            text-align: center;
        }
        #progressbar li {
            list-style-type: none;
            color: rgb(51, 51, 51);
            text-transform: uppercase;
            font-size: 9px;
            width: 20%;
            float: left;
            position: relative;
        }
        #progressbar li:before {
            content: counter(step);
            counter-increment: step;
            width: 20px;
            line-height: 20px;
            display: block;
            font-size: 10px;
            color: #333;
            background: white;
            border-radius: 3px;
            margin: 0 auto 5px auto;
        }
        /*progressbar connectors*/
        #progressbar li:after {
            content: '';
            width: 100%;
            height: 2px;
            background: white;
            position: absolute;
            left: -50%;
            top: 9px;
            z-index: -1; /*put it behind the numbers*/
        }
        #progressbar li:first-child:after {
            /*connector not needed before the first step*/
            content: none;
        }
        /*marking active/completed steps green*/
        /*The number of the step and the connector before it = green*/
        #progressbar li.active:before,  #progressbar li.active:after{
            background: #7B1FA2;
            color: white;
        }


        /* my modal */

        .modal p{
            font-size: 15px;
            font-weight: 100;
            font-family: sans-serif;
            color: #3C3B3B;
            line-height: 21px;
        }

        .modal {
            position: fixed;
            top: 50%;
            left: 50%;
            width: 50%;
            max-width: 630px;
            min-width: 320px;
            height: auto;
            z-index: 2000;
            visibility: hidden;
            -moz-backface-visibility: hidden;
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            -moz-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }
        .modal.modal-show {
            visibility: visible;
        }
        .lt-ie9 .modal {
            top: 0;
            margin-left: -315px;
        }

        .modal-content {
            background: #ffffff;
            position: relative;
            margin: 0 auto;
            padding: 40px;
            border-radius: 3px;
        }

        .modal-overlay {
            background: #000000;
            position: fixed;
            visibility: hidden;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1000;
            filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
            opacity: 0;
            -moz-transition-property: visibility, opacity;
            -o-transition-property: visibility, opacity;
            -webkit-transition-property: visibility, opacity;
            transition-property: visibility, opacity;
            -moz-transition-delay: 0.5s, 0.1s;
            -o-transition-delay: 0.5s, 0.1s;
            -webkit-transition-delay: 0.5s, 0.1s;
            transition-delay: 0.5s, 0.1s;
            -moz-transition-duration: 0, 0.5s;
            -o-transition-duration: 0, 0.5s;
            -webkit-transition-duration: 0, 0.5s;
            transition-duration: 0, 0.5s;
        }
        .modal-show .modal-overlay {
            visibility: visible;
            filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=60);
            opacity: 0.6;
            -moz-transition: opacity 0.5s;
            -o-transition: opacity 0.5s;
            -webkit-transition: opacity 0.5s;
            transition: opacity 0.5s;
        }

        /*slide*/
        .modal[data-modal-effect|=slide] .modal-content {
            filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
            opacity: 0;
            -moz-transition: all 0.5s 0;
            -o-transition: all 0.5s 0;
            -webkit-transition: all 0.5s 0;
            transition: all 0.5s 0;
        }
        .modal[data-modal-effect|=slide].modal-show .modal-content {
            filter: progid:DXImageTransform.Microsoft.Alpha(enabled=false);
            opacity: 1;
            -moz-transition: all 0.5s 0.1s;
            -o-transition: all 0.5s 0.1s;
            -webkit-transition: all 0.5s;
            -webkit-transition-delay: 0.1s;
            transition: all 0.5s 0.1s;
        }
        .modal[data-modal-effect=slide-top] .modal-content {
            -moz-transform: translateY(-300%);
            -ms-transform: translateY(-300%);
            -webkit-transform: translateY(-300%);
            transform: translateY(-300%);
        }
        .modal[data-modal-effect=slide-top].modal-show .modal-content {
            -moz-transform: translateY(0);
            -ms-transform: translateY(0);
            -webkit-transform: translateY(0);
            transform: translateY(0);
        }


        /* RESPONSIVE */

        /* moves error logs in tablet/smaller screens */

        @media (max-width:1000px){

            /*brings inputs down in size */
            .steps input, .steps textarea {
                outline: none;
                display: block;
                width: 100% !important;
            }

            /*brings errors in */
            .error1 {
                left: 345px;
                margin-top: -58px;
            }




        }


        @media (max-width:675px){
            /*mobile phone: uncollapse all fields: remove progress bar*/

            .steps {
                width: 100%;
                margin: 50px auto;
                position: relative;
            }

            #progressbar{
                display:none;
            }

            /*move error logs */
            .error1 {
                position: relative;
                left: 0 !important;
                margin-top: 24px;
                top: -11px;
            }

            .error1:before {
                width: 0;
                height: 0;
                left: 14px;
                top: -14px;
                content: '';
                position: absolute;
                border-left: 6px solid transparent;
                border-bottom: 8px solid #e62163;
                border-right: 6px solid transparent;
            }

            /*show hidden fieldsets */
            .steps fieldset:not(:first-of-type) {
                display: block;
            }

            .steps fieldset{
                position:relative;
                width: 100%;
                margin:0 auto;
                margin-top: 45px;
            }

            .steps .next, .steps .previous{
                display:none;
            }

            .steps .explanation{
                display:none;
            }

            .steps .submit {
                float: right;
                margin: 28px auto 10px;
                width: 100% !important;
            }

        }



        /* Info */
        .info {
            width: 300px;
            margin: 35px auto;
            text-align: center;
            font-family: 'roboto', sans-serif;
        }

        .info h1 {
            margin: 0;
            padding: 0;
            font-size: 28px;
            font-weight: 400;
            color: #333333;
            padding-bottom: 5px;

        }
        .info span {
            color:#666666;
            font-size: 13px;
            margin-top:20px;
        }
        .info span a {
            color: #666666;
            text-decoration: none;
        }
        .info span .fa {
            color: rgb(226, 168, 16);
            font-size: 19px;
            position: relative;
            left: -2px;
        }

        .info span .spoilers {
            color: #999999;
            margin-top: 5px;
            font-size: 10px;
        }
    </style>
<script type="text/javascript">
    $(document).ready(function() {
        var current_fs, next_fs, previous_fs;
        var left, opacity, scale;
        var animating;
        $(".steps").validate({
            errorClass: 'invalid',
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.insertAfter(element.next('span').children());
            },
            highlight: function(element) {
                $(element).next('span').show();
            },
            unhighlight: function(element) {
                $(element).next('span').hide();
            }
        });
        $(".next").click(function() {
            $(".steps").validate({
                errorClass: 'invalid',
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.insertAfter(element.next('span').children());
                },
                highlight: function(element) {
                    $(element).next('span').show();
                },
                unhighlight: function(element) {
                    $(element).next('span').hide();
                }
            });
            if ((!$('.steps').valid())) {
                return true;
            }
            if (animating) return false;
            animating = true;
            current_fs = $(this).parent();
            next_fs = $(this).parent().next();
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
            next_fs.show();
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now, mx) {
                    scale = 1 - (1 - now) * 0.2;
                    left = (now * 50) + "%";
                    opacity = 1 - now;
                    current_fs.css({
                        'transform': 'scale(' + scale + ')'
                    });
                    next_fs.css({
                        'left': left,
                        'opacity': opacity
                    });
                },
                duration: 800,
                complete: function() {
                    current_fs.hide();
                    animating = false;
                },
                easing: 'easeInOutExpo'
            });
        });
        $(".submit").click(function() {
            $(".steps").validate({
                errorClass: 'invalid',
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.insertAfter(element.next('span').children());
                },
                highlight: function(element) {
                    $(element).next('span').show();
                },
                unhighlight: function(element) {
                    $(element).next('span').hide();
                }
            });
            if ((!$('.steps').valid())) {
                return false;
            }
            if (animating) return false;
            animating = true;
            current_fs = $(this).parent();
            next_fs = $(this).parent().next();
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");
            next_fs.show();
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now, mx) {
                    scale = 1 - (1 - now) * 0.2;
                    left = (now * 50) + "%";
                    opacity = 1 - now;
                    current_fs.css({
                        'transform': 'scale(' + scale + ')'
                    });
                    next_fs.css({
                        'left': left,
                        'opacity': opacity
                    });
                },
                duration: 800,
                complete: function() {
                    current_fs.hide();
                    animating = false;
                },
                easing: 'easeInOutExpo'
            });
        });
        $(".previous").click(function() {
            if (animating) return false;
            animating = true;
            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");
            previous_fs.show();
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now, mx) {
                    scale = 0.8 + (1 - now) * 0.2;
                    left = ((1 - now) * 50) + "%";
                    opacity = 1 - now;
                    current_fs.css({
                        'left': left
                    });
                    previous_fs.css({
                        'transform': 'scale(' + scale + ')',
                        'opacity': opacity
                    });
                },
                duration: 800,
                complete: function() {
                    current_fs.hide();
                    animating = false;
                },
                easing: 'easeInOutExpo'
            });
        });
    });
    jQuery(document).ready(function() {
        jQuery("#edit-submitted-acquisition-amount-1,#edit-submitted-acquisition-amount-2,#edit-submitted-cultivation-amount-1,#edit-submitted-cultivation-amount-2,#edit-submitted-cultivation-amount-3,#edit-submitted-cultivation-amount-4,#edit-submitted-retention-amount-1,#edit-submitted-retention-amount-2,#edit-submitted-constituent-base-total-constituents").keyup(function() {
            calcTotal();
        });
    });

    function calcTotal() {
        var grade = 0;
        var donorTotal = Number(jQuery("#edit-submitted-constituent-base-total-constituents").val().replace(/,/g, ""));
        if (donorTotal) {
            donorTotal = parseFloat(donorTotal);
        } else {
            donorTotal = 0;
        }
        grade += getBonusDonorPoints(donorTotal);
        var acqAmount1 = Number(jQuery("#edit-submitted-acquisition-amount-1").val().replace(/,/g, ""));
        var acqAmount2 = Number(jQuery("#edit-submitted-acquisition-amount-2").val().replace(/,/g, ""));
        var acqTotal = 0;
        if (acqAmount1) {
            acqAmount1 = parseFloat(acqAmount1);
        } else {
            acqAmount1 = 0;
        }
        if (acqAmount2) {
            acqAmount2 = parseFloat(acqAmount2);
        } else {
            acqAmount2 = 0;
        }
        if (acqAmount1 > 0 && acqAmount2 > 0) {
            acqTotal = ((acqAmount2 - acqAmount1) / acqAmount1 * 100).toFixed(2);
        } else {
            acqTotal = 0;
        }
        jQuery("#edit-submitted-acquisition-percent-change").val(acqTotal + '%');
        grade += getAcquisitionPoints(acqTotal);
        console.log(grade);
        var cultAmount1 = Number(jQuery("#edit-submitted-cultivation-amount-1").val().replace(/,/g, ""));
        var cultAmount2 = Number(jQuery("#edit-submitted-cultivation-amount-2").val().replace(/,/g, ""));
        var cultTotal = 0;
        if (cultAmount1) {
            cultAmount1 = parseFloat(cultAmount1);
        } else {
            cultAmount1 = 0;
        }
        if (cultAmount2) {
            cultAmount2 = parseFloat(cultAmount2);
        } else {
            cultAmount2 = 0;
        }
        if (cultAmount1 > 0 && cultAmount2 > 0) {
            cultTotal = ((cultAmount2 - cultAmount1) / cultAmount1 * 100).toFixed(2);
        } else {
            cultTotal = 0;
        }
        jQuery("#edit-submitted-cultivation-percent-change1").val(cultTotal + '%');
        grade += getAcquisitionPoints(cultTotal);
        var cultAmount3 = Number(jQuery("#edit-submitted-cultivation-amount-3").val().replace(/,/g, ""));
        var cultAmount4 = Number(jQuery("#edit-submitted-cultivation-amount-4").val().replace(/,/g, ""));
        if (cultAmount3) {
            cultAmount3 = parseFloat(cultAmount3);
        } else {
            cultAmount3 = 0;
        }
        if (cultAmount4) {
            cultAmount4 = parseFloat(cultAmount4);
        } else {
            cultAmount4 = 0;
        }
        if (cultAmount3 > 0 && cultAmount4 > 0) {
            cultTotal2 = ((cultAmount4 - cultAmount3) / cultAmount3 * 100).toFixed(2);
        } else {
            cultTotal2 = 0;
        }
        jQuery("#edit-submitted-cultivation-percent-change2").val(cultTotal2 + '%');
        grade += getAcquisitionPoints(cultTotal2);
        var retAmount1 = Number(jQuery("#edit-submitted-retention-amount-1").val().replace(/,/g, ""));
        var retAmount2 = Number(jQuery("#edit-submitted-retention-amount-2").val().replace(/,/g, ""));
        var retTotal = 0;
        if (retAmount1) {
            retAmount1 = parseFloat(retAmount1);
        } else {
            retAmount1 = 0;
        }
        if (retAmount2) {
            retAmount2 = parseFloat(retAmount2);
        } else {
            retAmount2 = 0;
        }
        if (retAmount1 > 0 && retAmount2 > 0) {
            retTotal = (retAmount2 / retAmount1 * 100).toFixed(2);
        } else {
            retTotal = 0;
        }
        jQuery("#edit-submitted-retention-percent-change").val(retTotal + '%');
        grade += getAcquisitionPoints(retTotal);
        jQuery("#edit-submitted-final-grade-grade").val(grade + ' / 400');
    }

    function getAcquisitionPoints(val) {
        if (val < 1) {
            return 0;
        } else if (val >= 1 && val < 6) {
            return 50;
        } else if (val >= 6 && val < 11) {
            return 60;
        } else if (val >= 11 && val < 16) {
            return 70;
        } else if (val >= 16 && val < 21) {
            return 75;
        } else if (val >= 21 && val < 26) {
            return 80;
        } else if (val >= 26 && val < 31) {
            return 85;
        } else if (val >= 31 && val < 36) {
            return 90;
        } else if (val >= 36 && val < 41) {
            return 95;
        } else if (val >= 41) {
            return 100;
        }
    }

    function getCultivationGiftPoints(val) {
        if (val < 1) {
            return 0;
        } else if (val >= 1 && val < 4) {
            return 50;
        } else if (val >= 4 && val < 7) {
            return 60;
        } else if (val >= 7 && val < 10) {
            return 70;
        } else if (val >= 10 && val < 13) {
            return 75;
        } else if (val >= 13 && val < 16) {
            return 80;
        } else if (val >= 16 && val < 21) {
            return 85;
        } else if (val >= 21 && val < 26) {
            return 90;
        } else if (val >= 26 && val < 51) {
            return 95;
        } else if (val >= 51) {
            return 100;
        }
    }

    function getCultivationDonationPoints(val) {
        if (val < 1) {
            return 0;
        } else if (val >= 1 && val < 6) {
            return 50;
        } else if (val >= 6 && val < 11) {
            return 60;
        } else if (val >= 11 && val < 16) {
            return 70;
        } else if (val >= 16 && val < 21) {
            return 75;
        } else if (val >= 21 && val < 26) {
            return 80;
        } else if (val >= 26 && val < 31) {
            return 85;
        } else if (val >= 31 && val < 36) {
            return 90;
        } else if (val >= 36 && val < 41) {
            return 95;
        } else if (val >= 41) {
            return 100;
        }
    }

    function getRetentionPoints(val) {
        if (val < 1) {
            return 0;
        } else if (val >= 1 && val < 51) {
            return 50;
        } else if (val >= 51 && val < 56) {
            return 60;
        } else if (val >= 56 && val < 61) {
            return 70;
        } else if (val >= 61 && val < 66) {
            return 75;
        } else if (val >= 66 && val < 71) {
            return 80;
        } else if (val >= 71 && val < 76) {
            return 85;
        } else if (val >= 76 && val < 81) {
            return 90;
        } else if (val >= 81 && val < 91) {
            return 95;
        } else if (val >= 91) {
            return 100;
        }
    }

    function getBonusDonorPoints(val) {
        if (val < 10001) {
            return 0;
        } else if (val >= 10001 && val < 25001) {
            return 10;
        } else if (val >= 25001 && val < 50000) {
            return 15;
        } else if (val >= 50000) {
            return 20;
        }
    }
    var modules = {
        $window: $(window),
        $html: $('html'),
        $body: $('body'),
        $container: $('.container'),
        init: function() {
            $(function() {
                modules.modals.init();
            });
        },
        modals: {
            trigger: $('.explanation'),
            modal: $('.modal'),
            scrollTopPosition: null,
            init: function() {
                var self = this;
                if (self.trigger.length > 0 && self.modal.length > 0) {
                    modules.$body.append('<div class="modal-overlay"></div>');
                    self.triggers();
                }
            },
            triggers: function() {
                var self = this;
                self.trigger.on('click', function(e) {
                    e.preventDefault();
                    var $trigger = $(this);
                    self.openModal($trigger, $trigger.data('modalId'));
                });
                $('.modal-overlay').on('click', function(e) {
                    e.preventDefault();
                    self.closeModal();
                });
                modules.$body.on('keydown', function(e) {
                    if (e.keyCode === 27) {
                        self.closeModal();
                    }
                });
                $('.modal-close').on('click', function(e) {
                    e.preventDefault();
                    self.closeModal();
                });
            },
            openModal: function(_trigger, _modalId) {
                var self = this,
                    scrollTopPosition = modules.$window.scrollTop(),
                    $targetModal = $('#' + _modalId);
                self.scrollTopPosition = scrollTopPosition;
                modules.$html.addClass('modal-show').attr('data-modal-effect', $targetModal.data('modal-effect'));
                $targetModal.addClass('modal-show');
                modules.$container.scrollTop(scrollTopPosition);
            },
            closeModal: function() {
                var self = this;
                $('.modal-show').removeClass('modal-show');
                modules.$html.removeClass('modal-show').removeAttr('data-modal-effect');
                modules.$window.scrollTop(self.scrollTopPosition);
            }
        }
    }
    modules.init();
</script>
<div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <form class="steps" accept-charset="UTF-8" enctype="multipart/form-data" novalidate="">
                <ul id="progressbar">
                    <li class="active">User Information</li>
                    <li>Aquisition</li>
                    <li>Cultivation</li>
                    <li>Cultivation2</li>
                    <li>Retention</li>
                </ul>
                <!-- USER INFORMATION FIELD SET -->
                <fieldset>
                    <h2 class="fs-title">Basic Information</h2>
                    <h3 class="fs-subtitle">We just need some basic information to begin your scoring</h3>
                    <!-- Begin What's Your First Name Field -->
                    <div class="hs_firstname field hs-form-field">
                        <label for="firstname-99a6d115-5e68-4355-a7d0-529207feb0b3_2983">What's your First Name? *</label>
                        <input id="firstname-99a6d115-5e68-4355-a7d0-529207feb0b3_2983" name="firstname" required="required" type="text" value="" placeholder="" data-rule-required="true" data-msg-required="Please include your first name" >
                        <span class="error1" style="display: none;">
                            <i class="error-log fa fa-exclamation-triangle"></i>
                        </span>
                    </div>
                    <!-- End What's Your First Name Field -->

                    <!-- Begin What's Your Email Field -->
                    <div class="hs_email field hs-form-field">
                        <label for="email-99a6d115-5e68-4355-a7d0-529207feb0b3_2983">What's your E-mail Address? *</label>
                        <input id="email-99a6d115-5e68-4355-a7d0-529207feb0b3_2983" name="email" required="required" type="email" value="" placeholder="" data-rule-required="true" data-msg-required="Please enter a valid email address." >
                        <span class="error1" style="display: none;">
                            <i class="error-log fa fa-exclamation-triangle"></i>
                        </span>
                    </div>
                    <!-- End What's Your Email Field -->

                    <!-- Begin Total Number of Constituents in Your Database Field -->
                    <div class="hs_email field hs-form-field hs_total_number_of_constituents_in_your_database">
                        <label for="edit-submitted-constituent-base-total-constituents total_number_of_constituents_in_your_database-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">What's the Total Number of Constituents in your Database? *</label>
                        <input id="edit-submitted-constituent-base-total-constituents" class="form-text hs-input" name="total_number_of_constituents_in_your_database" required="required" size="60" maxlength="128" type="number" value="" placeholder="" data-rule-required="true" data-msg-required="Please enter a valid number" >
                        <span class="error1" style="display: none;">
                            <i class="error-log fa fa-exclamation-triangle"></i>
                        </span>
                    </div>

                    <!-- End Total Number of Constituents in Your Database Field -->
                    <input type="button" data-page="1" name="next" class="next action-button" value="Next" />
                    <div class="explanation btn btn-small modal-trigger" data-modal-id="modal-3"><i class="question-log fa fa-question-circle"></i> What Is This?</div>
                </fieldset>

                <!-- ACQUISITION FIELD SET -->
                <fieldset>
                    <h2 class="fs-title">Acquisition of Donors</h2>
                    <h3 class="fs-subtitle">How have you been doing in acquiring donors?</h3>
                    <!-- Begin Total Number of Donors in Year 1 Field -->
                    <div class="form-item webform-component webform-component-textfield hs_total_number_of_donors_in_year_1 field hs-form-field" id="webform-component-acquisition--amount-1">
                        <label for="edit-submitted-acquisition-amount-1 total_number_of_donors_in_year_1-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">What was your number of total donors in year 1? *</label>
                        <input id="edit-submitted-acquisition-amount-1" class="form-text hs-input" name="total_number_of_donors_in_year_1" required="required" size="60" maxlength="128" type="number" value="" placeholder="" data-rule-required="true" data-msg-required="Please enter a valid number">
                        <span class="error1" style="display: none;">
                            <i class="error-log fa fa-exclamation-triangle"></i>
                        </span>
                    </div>
                    <!-- End Total Number of Donors in Year 1 Field -->

                    <!-- Begin Total Number of Donors in Year 2 Field -->
                    <div class="form-item webform-component webform-component-textfield hs_total_number_of_donors_in_year_2 field hs-form-field" id="webform-component-acquisition--amount-2">
                        <label for="edit-submitted-acquisition-amount-2 total_number_of_donors_in_year_2-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">What was your number of total donors in year 2? *</label>
                        <input id="edit-submitted-acquisition-amount-2" class="form-text hs-input" name="total_number_of_donors_in_year_2" required="required" size="60" maxlength="128" type="number" value="" placeholder="" data-rule-required="true" data-msg-required="Please enter a valid number">
                        <span class="error1" style="display: none;">
                            <i class="error-log fa fa-exclamation-triangle"></i>
                        </span>
                    </div>
                    <!-- End Total Number of Donors in Year 2 Field -->

                    <!-- Begin Calc of Total Number of Donors Fields -->
                    <!-- THIS FIELD IS NOT EDITABLE | GRAYED OUT -->
                    <div class="form-item webform-component webform-component-textfield webform-container-inline hs_total_donor_percent_change field hs-form-field">
                        <label for="edit-submitted-acquisition-percent-change total_donor_percent_change-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">Total Donors Percent Change</label>
                        <input id="edit-submitted-acquisition-percent-change" class="form-text hs-input" name="total_donor_percent_change" readonly="readonly" size="60" maxlength="128" type="text" value="" placeholder="0">
                    </div>
                    <!-- End Calc of Total Number of Donors Fields -->
                    <input type="button" data-page="2" name="previous" class="previous action-button" value="Previous" />
                    <input type="button" data-page="2" name="next" class="next action-button" value="Next" />
                    <div class="explanation btn btn-small modal-trigger" data-modal-id="modal-3">What Is This?</div>
                </fieldset>

                <!-- Cultivation FIELD SET -->
                <fieldset>
                    <h2 class="fs-title">Cultivation and Nurturing your Donors</h2>
                    <h3 class="fs-subtitle">How have you been nurturing donors to get better donations?</h3>
                    <!-- Begin Average Gift Size in Year 1 Field -->
                    <div class="form-item webform-component webform-component-textfield hs_average_gift_size_in_year_1 field hs-form-field" id="edit-submitted-cultivation-amount-1 average_gift_size_in_year_1-99a6d115-5e68-4355-a7d0-529207feb0b3_3256">
                        <label for="edit-submitted-cultivation-amount-1 average_gift_size_in_year_1-99a6d115-5e68-4355-a7d0-529207feb0b3_3256">What was your average gift size in year 1? *</label>
                        <input id="edit-submitted-cultivation-amount-1" class="form-text hs-input" name="average_gift_size_in_year_1" required="required" size="60" maxlength="128" type="number" value="" placeholder="" data-rule-required="true" data-msg-required="Please enter a valid number">
                        <span class="error1" style="display: none;">
                            <i class="error-log fa fa-exclamation-triangle"></i>
                        </span>
                    </div>
                    <!-- End Average Gift Size in Year 1 Field -->

                    <!-- Begin Average Gift Size in Year 2 Field -->
                    <div class="form-item webform-component webform-component-textfield hs_average_gift_size_in_year_2 field hs-form-field" id="webform-component-cultivation--amount-2">
                        <label for="edit-submitted-cultivation-amount-2 average_gift_size_in_year_2-99a6d115-5e68-4355-a7d0-529207feb0b3_3256">What was your average gift size in year 2? *</label>
                        <input id="edit-submitted-cultivation-amount-2" class="form-text hs-input" name="average_gift_size_in_year_2" required="required" size="60" maxlength="128" type="number" value="" placeholder="" data-rule-required="true" data-msg-required="Please enter a valid number">
                        <span class="error1" style="display: none;">
                            <i class="error-log fa fa-exclamation-triangle"></i>
                        </span>
                    </div>
                    <!-- End Average Gift Size in Year 2 Field -->

                    <!-- Begin Average Gift Size Perchent Change Field -->
                    <!-- THIS FIELD IS NOT EDITABLE | GRAYED OUT -->
                    <div class="form-item webform-component webform-component-textfield webform-container-inline hs_average_gift_size_percent_change field hs-form-field" id="webform-component-cultivation--percent-change1">
                        <label for="edit-submitted-cultivation-percent-change1 average_gift_size_percent_change-99a6d115-5e68-4355-a7d0-529207feb0b3_3256">Average Gift Size Percent Change</label>
                        <input id="edit-submitted-cultivation-percent-change1" class="form-text hs-input" name="average_gift_size_percent_change" readonly="readonly" size="60" maxlength="128" type="text" value="" placeholder="0">
                    </div>
                    <!-- End Average Gift Size Perchent Change Field -->
                    <input type="button" data-page="3" name="previous" class="previous action-button" value="Previous" />
                    <input type="button" data-page="3" name="next" class="next action-button" value="Next" />
                    <div class="explanation btn btn-small modal-trigger" data-modal-id="modal-3">What Is This?</div>
                </fieldset>

                <!-- Cultivation2 FIELD SET -->
                <fieldset>
                    <h2 class="fs-title">Total Cultivation in Donation</h2>
                    <h3 class="fs-subtitle">Let's talk about your donations as a whole</h3>
                    <!-- Begin Total Giving In Year 1 Field -->
                    <div class="form-item webform-component webform-component-textfield" id="webform-component-cultivation--amount-3 hs_total_giving_in_year_1 field hs-form-field">
                        <label for=" edit-submitted-cultivation-amount-3 total_giving_in_year_1-99a6d115-5e68-4355-a7d0-529207feb0b3_4902">What was your total giving in Year 1? *</label>
                        <input id="edit-submitted-cultivation-amount-3" class="form-text hs-input" name="total_giving_in_year_1" required="required" size="60" maxlength="128" type="number" value="" placeholder="" data-rule-required="true" data-msg-required="Please enter a valid number">
                        <span class="error1" style="display: none;">
                            <i class="error-log fa fa-exclamation-triangle"></i>
                        </span>
                    </div>
                    <!-- End Total Giving In Year 1 Field -->

                    <!-- Begin Total Giving In Year 2 Field -->
                    <div class="form-item webform-component webform-component-textfield hs_total_giving_in_year_2 field hs-form-field" id="webform-component-cultivation--amount-4">
                        <label for=" edit-submitted-cultivation-amount-4 total_giving_in_year_2-99a6d115-5e68-4355-a7d0-529207feb0b3_4902">What was your total giving in Year 2? *</label>
                        <input id="edit-submitted-cultivation-amount-4" class="form-text hs-input" name="total_giving_in_year_2" required="required" size="60" maxlength="128" type="number" value="" placeholder="" data-rule-required="true" data-msg-required="Please enter a valid number">
                        <span class="error1" style="display: none;">
                            <i class="error-log fa fa-exclamation-triangle"></i>
                        </span>
                    </div>

                    <!-- End Total Giving In Year 2 Field -->

                    <!-- Begin Average Gift Size Percent Change Field 2 -->
                    <!-- THIS FIELD IS NOT EDITABLE | GRAYED OUT -->
                    <div class="form-item webform-component webform-component-textfield webform-container-inline hs_total_giving_percent_change field hs-form-field" id="webform-component-cultivation--percent-change2">
                        <label for=" edit-submitted-cultivation-percent-change2 total_giving_percent_change-99a6d115-5e68-4355-a7d0-529207feb0b3_4902">Average Gift Size Percent Change</label>
                        <input id="edit-submitted-cultivation-percent-change2" class="form-text hs-input" name="total_giving_percent_change" readonly="readonly" size="60" maxlength="128" type="text" value="" placeholder="0">
                    </div>
                    <!-- End Average Gift Size Percent Change Field 2 -->
                    <input type="button" data-page="4" name="previous" class="previous action-button" value="Previous" />
                    <input type="button" data-page="4" name="next" class="next action-button" value="Next" />
                    <div class="explanation btn btn-small modal-trigger" data-modal-id="modal-3">What Is This?</div>
                </fieldset>

                <!-- RETENTION FIELD SET -->
                <fieldset>
                    <h2 class="fs-title">Retention of your donors</h2>
                    <h3 class="fs-subtitle">How long can you keep your donors and their donations?</h3>
                    <!-- Begin Total Number of Donors Who Gave in Year 1 Field -->
                    <div class="form-item webform-component webform-component-textfield hs_number_of_donors_in_year_1 field hs-form-field" id="webform-component-retention--amount-1">
                        <label for=" edit-submitted-retention-amount-1 number_of_donors_in_year_1-99a6d115-5e68-4355-a7d0-529207feb0b3_2983">What was your total number of donors who gave in year 1? *</label>
                        <input id="edit-submitted-retention-amount-1" class="form-text hs-input" name="number_of_donors_in_year_1" required="required" size="60" maxlength="128" type="number" value="" placeholder="" data-rule-required="true" data-msg-required="Please enter a valid number">
                        <span class="error1" style="display: none;">
                            <i class="error-log fa fa-exclamation-triangle"></i>
                        </span>
                    </div>
                    <!-- End Total Number of Donors Who Gave in Year 1 Field-->

                    <!-- Begin Total Number of Donors Who Gave in Year 1 and Year 2 Field -->
                    <div class="form-item webform-component webform-component-textfield" id="webform-component-retention--amount-2 hs_number_of_year_1_donors_who_also_gave_in_year_2 field hs-form-field">
                        <label for=" edit-submitted-retention-amount-2 number_of_year_1_donors_who_also_gave_in_year_2-99a6d115-5e68-4355-a7d0-529207feb0b3_2983">What was your total number of donors who gave in year 1 that also gave in year 2? *</label>
                        <input id="edit-submitted-retention-amount-2" class="form-text hs-input" name="number_of_year_1_donors_who_also_gave_in_year_2" required="required" size="60" maxlength="128" type="number" value="" placeholder="" data-rule-required="true" data-msg-required="Please enter a valid number">
                        <span class="error1" style="display: none;">
                            <i class="error-log fa fa-exclamation-triangle"></i>
                        </span>
                    </div>
                    <!-- End Total Number of Donors Who Gave in Year 1 and Year 2 Field -->

                    <!-- Begin Retention Rate Percent -->
                    <div class="form-item webform-component webform-component-textfield" id="webform-component-retention--percent-change field hs-form-field">
                        <label for="edit-submitted-retention-percent-change">Retention Rate</label>
                        <input id="edit-submitted-retention-percent-change" class="form-text hs-input" name="retention_rate_percent" readonly="readonly" size="60" maxlength="128" type="text" value="" placeholder="0">
                        <span class="error1" style="display: none;">
                            <i class="error-log fa fa-exclamation-triangle"></i>
                        </span>
                    </div>
                    <!-- End Retention Rate Percent -->

                    <!-- Begin Final Calc -->
                    <div class="form-item webform-component webform-component-textfield hs_fundraising_400_index field hs-form-field" id="webform-component-final-grade--grade">
                        <input id="edit-submitted-final-grade-grade" class="form-text hs-input" name="fundraising_400_index" readonly="readonly" size="60" maxlength="128" type="text" value="" placeholder="0">
                    </div>
                    <!-- End Final Calc -->
                    <input type="button" data-page="5" name="previous" class="previous action-button" value="Previous" />
                    <input id="submit" class="hs-button primary large action-button next" type="submit" value="Submit">
                    <div class="explanation btn btn-small modal-trigger" data-modal-id="modal-3">What Is This?</div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
@endsection