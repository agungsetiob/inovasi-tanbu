<style type="text/css">
    #success-modal .page-body{
      max-width:355px;
      background-color:#FFFFFF;
      margin:10% auto;
    }
    #success-modal .page-body .head{
      text-align:center;
    }
    #success-modal .close{
      opacity: 1;
      position: absolute;
      right: 0px;
      font-size: 30px;
      padding: 3px 15px;
      margin-bottom: 10px;
    }
    #success-modal .checkmark-circle {
      width: 150px;
      height: 150px;
      position: relative;
      display: inline-block;
      vertical-align: top;
    }
    .checkmark-circle .background {
      width: 150px;
      height: 150px;
      border-radius: 50%;
      background: #1ab394;
      position: absolute;
    }
    #success-modal .checkmark-circle .checkmark {
      border-radius: 5px;
    }
    #success-modal .checkmark-circle .checkmark.draw:after {
      -webkit-animation-delay: 300ms;
      -moz-animation-delay: 300ms;
      animation-delay: 300ms;
      -webkit-animation-duration: 1s;
      -moz-animation-duration: 1s;
      animation-duration: 1s;
      -webkit-animation-timing-function: ease;
      -moz-animation-timing-function: ease;
      animation-timing-function: ease;
      -webkit-animation-name: checkmark;
      -moz-animation-name: checkmark;
      animation-name: checkmark;
      -webkit-transform: scaleX(-1) rotate(135deg);
      -moz-transform: scaleX(-1) rotate(135deg);
      -ms-transform: scaleX(-1) rotate(135deg);
      -o-transform: scaleX(-1) rotate(135deg);
      transform: scaleX(-1) rotate(135deg);
      -webkit-animation-fill-mode: forwards;
      -moz-animation-fill-mode: forwards;
      animation-fill-mode: forwards;
    }
    #success-modal .checkmark-circle .checkmark:after {
      opacity: 1;
      height: 75px;
      width: 37.5px;
      -webkit-transform-origin: left top;
      -moz-transform-origin: left top;
      -ms-transform-origin: left top;
      -o-transform-origin: left top;
      transform-origin: left top;
      border-right: 15px solid #fff;
      border-top: 15px solid #fff;
      border-radius: 2.5px !important;
      content: '';
      left: 35px;
      top: 80px;
      position: absolute;
    }

    @-webkit-keyframes checkmark {
      0% {
        height: 0;
        width: 0;
        opacity: 1;
        }
        20% {
            height: 0;
            width: 37.5px;
            opacity: 1;
        }
        40% {
            height: 75px;
            width: 37.5px;
            opacity: 1;
        }
        100% {
            height: 75px;
            width: 37.5px;
            opacity: 1;
        }
    }
    @-moz-keyframes checkmark {
      0% {
        height: 0;
        width: 0;
        opacity: 1;
        }
        20% {
            height: 0;
            width: 37.5px;
            opacity: 1;
        }
        40% {
            height: 75px;
            width: 37.5px;
            opacity: 1;
        }
        100% {
            height: 75px;
            width: 37.5px;
            opacity: 1;
        }
    }
    @keyframes checkmark {
      0% {
        height: 0;
        width: 0;
        opacity: 1;
        }
        20% {
            height: 0;
            width: 37.5px;
            opacity: 1;
        }
        40% {
            height: 75px;
            width: 37.5px;
            opacity: 1;
        }
        100% {
            height: 75px;
            width: 37.5px;
            opacity: 1;
        }
    }

    .modal-confirm {        
        color: #434e65;
        width: 525px;
    }
    .modal-confirm .modal-content {
        padding: 20px;
        font-size: 16px;
        border-radius: 5px;
        border: none;
    }
    .modal-confirm .modal-header {
        background: #e85e6c;
        border-bottom: none;   
        position: relative;
        text-align: center;
        margin: -20px -20px 0;
        border-radius: 5px 5px 0 0;
        padding: 35px;
    }
    .modal-confirm .close {
        position: absolute;
        top: 15px;
        right: 15px;
        color: #fff;
        text-shadow: none;
        opacity: 0.5;
    }
    .modal-confirm .close:hover {
        opacity: 0.8;
    }
</style>
<div id="success-modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <a class="close" href="#" data-dismiss="modal">&times;</a>
            <div class="page-body">
                <div class="head">  
                    <h3 id="success-message"></h3>
                </div>
            <h1 style="text-align:center;">
                <div class="checkmark-circle">
                  <div class="background"></div>
                  <div class="checkmark draw"></div>
                </div>
            </h1>
          </div>
        </div>
    </div>
</div>

<div id="error-modal" class="modal fade">
    <div class="modal-dialog modal-confirm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
                <i class="fa fa-bell text-white fa-shake" style="font-size: 75px;"></i>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body text-center">
                <h3 id="error-message" class="text-danger"></h3>
            </div>
        </div>
    </div>
</div>