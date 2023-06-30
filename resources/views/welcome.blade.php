<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>DigiDealerDemo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content="DigiDealer Demo">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css"
          integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('user_assets/css/style.css?v=3')}}">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://cdn.jsdelivr.net/css-toggle-switch/latest/toggle-switch.css" rel="stylesheet"/>
    <style>
        h4, .h4 {
            font-size: 1.125rem;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
</head>
<body>
<div id="app" class="w-100  d-flex justify-content-center align-items-center pt-2">
    <div id="calc_widget" class="input-group d-flex">
        <div class="m-auto">
            <div class="d-flex justify-content-between" v-if="page === 'requestResult'">
                <button class="btn btn-outline-success d-block mb-2"
                        @click="rotatePresent" v-text="isPresent ? 'Back To Quote' : 'Present'">

                </button>
                <button class="btn btn-outline-success d-block mb-2" @click="newVin">
                    Check Another VIN
                </button>
            </div>
            <div id="vin-search" class="card shadow-lg bg-white rounded" v-show="page == 'vincode'">
                <div class="mt-3 text-center">
                    <strong class="h4">
                        Calculate for
                    </strong>
                </div>
                <div class="d-flex justify-content-center col-12">
                    <div class="switch-toggle switch-candy mt-2 w-100">
                        <input id="Finance" name="view" v-model="calculationType" value="Finance" type="radio">
                        <label for="Finance">Finance</label>

                        <input id="Lease" name="view" v-model="calculationType" value="Lease" type="radio">
                        <label for="Lease">Lease</label>
                        <a></a>
                    </div>
                </div>
                <div class="card-body mt-3">
                    <div class="form-group text-center">
                        <label for="vin" class="h3">Enter the VIN number</label>
                        <input type="text" @keyup="vinInput" id="vin" v-model="vin" class="form-control" min="17"
                               max="17">
                    </div>
                    <div class="form-group mt-3">
                        <button type="button" class="btn btn-outline-success w-100" @click.stop.prevent="submit">
                            Search
                        </button>
                    </div>

                </div>
                <div class="card-footer text-center">
                    <span class="h3">Create Quick Quote</span>
                    <button type="button" class="btn btn-outline-primary w-100 mt-2"
                            @click.stop.prevent="goToQuickQuote">
                        Quick Quote
                    </button>
                </div>
            </div>
            <div class="card" id="loading" v-show="page == 'waiting'">
                <div class="card-body">
                    <h5>Loading ...</h5>
                    <div>
                        <img src="https://c.tenor.com/40NNfhcajzoAAAAi/car-wheel.gif" alt="" class="d-block mx-auto">
                    </div>
                </div>
            </div>
            @include('widgets.quote.leaseQuoteWidget')
            @include('widgets.quote.financeQuoteWidget')
            @include('widgets.quote.quick_quote.quickQuoteWidget')
            <div class="d-flex row" v-if="page == 'send'">
                <div class="d-flex justify-content-between" style="">
                    <button class="btn btn-outline-success d-block mb-2" @click="quotePage">
                        Back To Quote
                    </button>
                    <button class="btn btn-outline-success d-block mb-2" @click="newVin">
                        Check Another VIN
                    </button>
                </div>
                <!--   First Card -->
                <div class="col-12 m-auto text-center">
                    <form @submit="sendEmail">
                        <div class="form-group">
                            <input type="text" id="mails" name="mails" class="form-control"
                                   placeholder="Input E-mail" required v-model="mails">
                        </div>
                        <div class="form-group">
                            <input class="btn btn-outline-success" type="submit" value="Send to Email">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('user_assets/js/calculate.js?v=6')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</html>
