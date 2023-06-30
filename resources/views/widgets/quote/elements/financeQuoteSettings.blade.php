<div :class="['row front', isPresent ? 'd-none' : 'd-flex']">
    <div class="col-12 col-md-4 mb-5">
        <img class="card-img border shadow-sm" :src="image" alt="Card image cap">
    </div>
    <div class="col-12 col-md-8">
        <div class="d-flex justify-content-between align-items-center  mb-3">
            <h4 class="card-title">Model</h4>
            <h5 class='text-right' v-text="model + ' (' + year + ')'"></h5>
        </div>
        <div class="d-flex justify-content-between align-items-center  mb-3">
            <h4 class="card-title">MSRP</h4>
            <h5 class='text-right' v-text="'$' + msrp"></h5>
        </div>
        <div class="d-flex justify-content-between align-items-center  mb-3">
            <h4 class="card-title card-tmp">Total Monthly Payment</h4>
            <h5 class='text-right' v-text="'$' + PMT"></h5>
        </div>
        <div class="d-flex justify-content-between align-items-center  mb-3">
            <h4 class="card-title">APR</h4>
            <input class="form-control percent value rv-input" type="text"
                   v-model.number="APR" inputmode="numeric"
                   maxlength="6">
        </div>
        <div class="d-flex justify-content-between align-items-center  mb-3">
            <h4 class="card-title">Roll Taxes Into<br>The Monthly Payment</h4>
            <div class="custom-control custom-checkbox">
                <input type="checkbox" class="form-control custom-control-input" id="rollTaxesIntoTheMonthlyPayment"
                       v-model.bool="rollTaxesIntoTheMonthlyPayment">
                <label class="custom-control-label" for="rollTaxesIntoTheMonthlyPayment" v-text=""></label>
            </div>
        </div>
        <div class="d-flex mb-3">
            <div class="row m-auto text-center">
                <div class="col-12">
                    <h5 class="m-0 mt-1 mb-2">Lease Term</h5>
                </div>
                <div class="d-flex flex-wrap col-12 justify-content-center p-0">
                    <div class="d-flex m-1"
                         v-for="(termItem, index) in termArray" :key="index">
                        <input type="radio" class="btn-check" v-model="term"
                               name="termRadio" :id="'termRadio' + index"
                               :value="termItem" autocomplete="off">
                        <label class="btn btn-outline-success"
                               :for="'termRadio' + index"
                               v-html="termItem  + '<br>Months<br>$'+ financeCalculation(termItem,false)">
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="title">
                <h5 class="m-0 mt-1">Down Payment</h5>
                <input class="form-control value rv-input" v-model.number="downPayment"
                       type="number"
                       inputmode="numeric" min="0" :max="msrp">
            </div>
            <div class="range-slider-holder">
                <input type="range" min="0" :max="msrp" id="distance"
                       class="range-slider" v-model.number="downPayment">
            </div>
        </div>
        <div class="d-flex m-auto text-center p-3">
            <button type="button" class="btn btn-outline-success m-auto p-3" @click="sendPage">Submit Quote
            </button>
        </div>
    </div>
</div>
