<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <!-- Custom Styles   -->
    <style type="text/css">
        .col-xl,
        .col-xl-auto, .col-xl-12, .col-xl-11, .col-xl-10, .col-xl-9, .col-xl-8, .col-xl-7, .col-xl-6, .col-xl-5, .col-xl-4, .col-xl-3, .col-xl-2, .col-xl-1, .col-lg,
        .col-lg-auto, .col-lg-12, .col-lg-11, .col-lg-10, .col-lg-9, .col-lg-8, .col-lg-7, .col-lg-6, .col-lg-5, .col-lg-4, .col-lg-3, .col-lg-2, .col-lg-1, .col-md,
        .col-md-auto, .col-md-12, .col-md-11, .col-md-10, .col-md-9, .col-md-8, .col-md-7, .col-md-6, .col-md-5, .col-md-4, .col-md-3, .col-md-2, .col-md-1, .col-sm,
        .col-sm-auto, .col-sm-12, .col-sm-11, .col-sm-10, .col-sm-9, .col-sm-8, .col-sm-7, .col-sm-6, .col-sm-5, .col-sm-4, .col-sm-3, .col-sm-2, .col-sm-1, .col,
        .col-auto, .col-12, .col-11, .col-10, .col-9, .col-8, .col-7, .col-6, .col-5, .col-4, .col-3, .col-2, .col-1 {
            position: relative;
            width: 100%;
            padding-right: 15px;
            padding-left: 15px;
        }

        .col {
            flex-basis: 0;
            flex-grow: 1;
            max-width: 100%;
        }

        .row-cols-1 > * {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .row-cols-2 > * {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .row-cols-3 > * {
            flex: 0 0 33.3333333333%;
            max-width: 33.3333333333%;
        }

        .row-cols-4 > * {
            flex: 0 0 25%;
            max-width: 25%;
        }

        .row-cols-5 > * {
            flex: 0 0 20%;
            max-width: 20%;
        }

        .row-cols-6 > * {
            flex: 0 0 16.6666666667%;
            max-width: 16.6666666667%;
        }

        .col-auto {
            flex: 0 0 auto;
            width: auto;
            max-width: 100%;
        }

        .col-1 {
            flex: 0 0 8.3333333333%;
            max-width: 8.3333333333%;
        }

        .col-2 {
            flex: 0 0 16.6666666667%;
            max-width: 16.6666666667%;
        }

        .col-3 {
            flex: 0 0 25%;
            max-width: 25%;
        }

        .col-4 {
            flex: 0 0 33.3333333333%;
            max-width: 33.3333333333%;
        }

        .col-5 {
            flex: 0 0 41.6666666667%;
            max-width: 41.6666666667%;
        }

        .col-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .col-7 {
            flex: 0 0 58.3333333333%;
            max-width: 58.3333333333%;
        }

        .col-8 {
            flex: 0 0 66.6666666667%;
            max-width: 66.6666666667%;
        }

        .col-9 {
            flex: 0 0 75%;
            max-width: 75%;
        }

        .col-10 {
            flex: 0 0 83.3333333333%;
            max-width: 83.3333333333%;
        }

        .col-11 {
            flex: 0 0 91.6666666667%;
            max-width: 91.6666666667%;
        }

        .col-12 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .card {
            position: relative;
            display: flex;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: .25rem
        }

        .card > hr {
            margin-right: 0;
            margin-left: 0
        }

        .card > .list-group {
            border-top: inherit;
            border-bottom: inherit
        }

        .card > .list-group:first-child {
            border-top-width: 0;
            border-top-left-radius: calc(.25rem - 1px);
            border-top-right-radius: calc(.25rem - 1px)
        }

        .card > .list-group:last-child {
            border-bottom-width: 0;
            border-bottom-right-radius: calc(.25rem - 1px);
            border-bottom-left-radius: calc(.25rem - 1px)
        }

        .card > .card-header + .list-group, .card > .list-group + .card-footer {
            border-top: 0
        }

        .card-body {
            flex: 1 1 auto;
            min-height: 1px;
            padding: 1.25rem
        }

        .card-title {
            margin-bottom: .75rem
        }

        .card-subtitle {
            margin-top: -.375rem;
            margin-bottom: 0
        }

        .card-text:last-child {
            margin-bottom: 0
        }

        .card-link:hover {
            text-decoration: none
        }

        .card-link + .card-link {
            margin-left: 1.25rem
        }

        .card-header {
            padding: .75rem 1.25rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, .03);
            border-bottom: 1px solid rgba(0, 0, 0, .125)
        }

        .card-header:first-child {
            border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0
        }

        .card-footer {
            padding: .75rem 1.25rem;
            background-color: rgba(0, 0, 0, .03);
            border-top: 1px solid rgba(0, 0, 0, .125)
        }

        .card-footer:last-child {
            border-radius: 0 0 calc(.25rem - 1px) calc(.25rem - 1px)
        }

        .card-header-tabs {
            margin-right: -.625rem;
            margin-bottom: -.75rem;
            margin-left: -.625rem;
            border-bottom: 0
        }

        .card-header-pills {
            margin-right: -.625rem;
            margin-left: -.625rem
        }

        .card-img-overlay {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            padding: 1.25rem;
            border-radius: calc(.25rem - 1px)
        }

        .card-img, .card-img-bottom, .card-img-top {
            flex-shrink: 0;
            width: 100%
        }

        .card-img, .card-img-top {
            border-top-left-radius: calc(.25rem - 1px);
            border-top-right-radius: calc(.25rem - 1px)
        }

        .card-img, .card-img-bottom {
            border-bottom-right-radius: calc(.25rem - 1px);
            border-bottom-left-radius: calc(.25rem - 1px)
        }

        .card-deck .card {
            margin-bottom: 15px
        }

        @media (min-width: 576px) {
            .card-deck {
                display: flex;
                flex-flow: row wrap;
                margin-right: -15px;
                margin-left: -15px
            }

            .card-deck .card {
                flex: 1 0 0%;
                margin-right: 15px;
                margin-bottom: 0;
                margin-left: 15px
            }
        }

        .card-group > .card {
            margin-bottom: 15px
        }

        @media (min-width: 576px) {
            .card-group {
                display: flex;
                flex-flow: row wrap
            }

            .card-group > .card {
                flex: 1 0 0%;
                margin-bottom: 0
            }

            .card-group > .card + .card {
                margin-left: 0;
                border-left: 0
            }

            .card-group > .card:not(:last-child) {
                border-top-right-radius: 0;
                border-bottom-right-radius: 0
            }

            .card-group > .card:not(:last-child) .card-header, .card-group > .card:not(:last-child) .card-img-top {
                border-top-right-radius: 0
            }

            .card-group > .card:not(:last-child) .card-footer, .card-group > .card:not(:last-child) .card-img-bottom {
                border-bottom-right-radius: 0
            }

            .card-group > .card:not(:first-child) {
                border-top-left-radius: 0;
                border-bottom-left-radius: 0
            }

            .card-group > .card:not(:first-child) .card-header, .card-group > .card:not(:first-child) .card-img-top {
                border-top-left-radius: 0
            }

            .card-group > .card:not(:first-child) .card-footer, .card-group > .card:not(:first-child) .card-img-bottom {
                border-bottom-left-radius: 0
            }
        }

        .card-columns .card {
            margin-bottom: .75rem
        }

        @media (min-width: 576px) {
            .card-columns {
                -moz-column-count: 3;
                column-count: 3;
                -moz-column-gap: 1.25rem;
                column-gap: 1.25rem;
                orphans: 1;
                widows: 1
            }

            .card-columns .card {
                display: inline-block;
                width: 100%
            }
        }

        body {
            width: 100vw;
            height: 100vh
        }

        .title {
            margin-bottom: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center
        }

        .title span.value {
            font-size: 18px;
            font-weight: 400
        }

        .range-slider-holder {
            position: relative;
            display: flex;
            justify-content: space-between
        }

        .range-slider-tooltip {
            position: absolute;
            bottom: -51px;
            margin: 0;
            padding: 2px 16px;
            background: #122c35;
            border-radius: 5px;
            color: #fff;
            font-size: 2rem;
            font-weight: 600
        }

        .range-slider-tooltip:before {
            content: '';
            display: block;
            position: absolute;
            top: -16px;
            left: 0;
            right: 0;
            margin: 0 auto;
            width: 0;
            height: 0;
            border-style: solid;
            border-width: 0 16px 16px 16px;
            border-color: transparent transparent #122c35 transparent
        }

        .range-slider {
            width: 100%
        }

        .range-slider-holder input[type=range] {
            -webkit-appearance: none;
            margin: 10px 0;
            width: 100%
        }

        .range-slider-holder input[type=range]:focus {
            outline: 0
        }

        #vin-search {
            position: fixed;
            top: 40%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 330px;
            max-width: 330px
        }

        .card-tmp {
            max-width: 150px
        }

        .range-slider-holder input[type=range]::-webkit-slider-runnable-track {
            width: 100%;
            height: 5px;
            cursor: pointer;
            background: #42b983;
            border-radius: 32px
        }

        .range-slider-holder input[type=range]::-webkit-slider-thumb {
            height: 25px;
            width: 25px;
            border-radius: 50%;
            background: #42b983;
            cursor: pointer;
            -webkit-appearance: none;
            margin-top: -10px
        }

        .range-slider-holder input[type=range]:active::-webkit-slider-runnable-track {
            background: #18ee8c
        }

        .range-slider-holder input[type=range]::-ms-track {
            width: 100%;
            height: 8.4px;
            cursor: pointer;
            background: 0 0;
            border-color: transparent;
            border-width: 16px 0;
            color: transparent
        }

        .range-slider-holder input[type=range]::-ms-fill-lower {
            background: #ade5fc;
            border: .2px solid #122c35;
            border-radius: 50%
        }

        .range-slider-holder input[type=range]::-ms-fill-upper {
            background: #ddd;
            border: .2px solid #122c35;
            border-radius: 50%
        }

        .range-slider-holder input[type=range]::-ms-thumb {
            border: 3px solid #122c35;
            height: 36px;
            width: 16px;
            border-radius: 50%;
            background: #fff;
            cursor: pointer
        }

        .range-slider-holder input[type=range]:focus::-ms-fill-lower {
            background: #ade5fc
        }

        .range-slider-holder input[type=range]:focus::-ms-fill-upper {
            background: #ade5fc
        }

        .rv-input {
            width: 60px !important;
            font-size: 18px !important;
            font-weight: 600 !important;
            color: #000 !important;
            text-align: center !important;
            padding: 0 !important
        }

        input::-webkit-inner-spin-button, input::-webkit-outer-spin-button {
            -webkit-appearance: none !important;
            margin: 0 !important
        }

        input[type=number] {
            -moz-appearance: textfield !important
        }

        #loading {
            position: fixed;
            z-index: 999;
            height: 2em;
            width: 2em;
            overflow: show !important;
            margin: auto;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0
        }

        #loading img {
            position: fixed;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%);
            filter: brightness(0) invert(1)
        }

        #loading:before {
            content: '';
            display: block;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8));
            background: -webkit-radial-gradient(rgba(20, 20, 20, .8), rgba(0, 0, 0, .8))
        }

        #loading:not(:required) {
            font: 0/0 a;
            color: transparent;
            text-shadow: none;
            background: rgba(0, 0, 0, .5);
            border: 0;
            height: 100%;
            width: 100%
        }

        .card-container {
            -webkit-perspective: 500px;
            perspective: 500px
        }

        .rotate-card {
            -webkit-transform: rotateY(180deg);
            transform: rotateY(180deg)
        }

        .card {
            -webkit-transition: -webkit-transform .7s;
            transition: transform .7s;
            -webkit-transform-style: flat;
            transform-style: flat
        }

        .card:not.rotate-card .back, .card:not.rotate-card .front {
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden
        }

        .back {
            -webkit-transform: rotateY(180deg);
            transform: rotateY(180deg)
        }

        .cards-container {
            display: -webkit-flex;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-flex-direction: row;
            -webkit-box-orient: horizontal;
            -webkit-box-direction: normal;
            -ms-flex-direction: row;
            flex-direction: row;
            -webkit-box-pack: center;
            -webkit-justify-content: center;
            -ms-flex-pack: center;
            justify-content: center
        }

        @media (max-width: 990px) {
            #calc_widget .card {
                width: 100%
            }

            #calc_widget {
                padding: 20px
            }
        }

        .d-flex {
            display: flex !important;
        }

        .justify-content-between {
            justify-content: space-between !important
        }

        .ttb {
            justify-content: space-between !important
            height: 40px;
        }

        .align-items-center {
            align-items: center !important
        }

        .mb-3 {
            margin-bottom: 1rem !important
        }

        h1, h2, h3, h4, h5, h6 {
            font-size: 18px;
        }
    </style>
    <!-- Custom Styles   -->

<body>
<div class="cards-container">
    <!--   First Card -->
    <div class="card-container">
        <div class="card">
            <div class="row front d-flex">
                <div class="col-12 col-md-6" style="padding: 0;">
                    <img class="card-img-top"
                         src="{{$data['image']}}"
                         alt="Card image cap" style="width: 450px;height: 100%;object-fit: cover;">
                </div>
                <div class="col-12 col-md-6">
                    <table class="mail_table">
                        <tr>
                            <td align="center" style="width:50%;" class="description-row">
                                <h2 align="center" style="text-align:center;">MODEL</h2>
                            </td>
                            <td align="center">
                                <h2 align="center" style="text-align:center;">
                                    {{$data['model']}}
                                </h2>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" style="width:50%;" class="description-row">
                                <h2 align="center" style="text-align:center;">MSRP</h2>
                            </td>
                            <td align="center">
                                <h2 align="center" style="text-align:center;">
                                    {{$data['msrp']}}$
                                </h2>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" style="width:50%;" class="description-row">
                                <h2 align="center" style="text-align:center;">TERM</h2>
                            </td>
                            <td align="center">
                                <h2 align="center" style="text-align:center;">
                                    {{$data['term']}}
                                </h2>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" style="width:50%;" class="description-row">
                                <h2 align="center" style="text-align:center;">MILES</h2>
                            </td>
                            <td align="center">
                                <h2 align="center" style="text-align:center;">
                                    {{$data['miles']}}
                                </h2>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" style="width:50%;" class="description-row">
                                <h2 align="center" style="text-align:center;">MONTHLY PAYMENT</h2>
                            </td>
                            <td align="center">
                                <h2 align="center" style="text-align:center;">
                                    {{$data['monthlyPayment']}}$
                                </h2>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
